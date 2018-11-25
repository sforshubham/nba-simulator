<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Team;
use App\Match;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @author     Shubham Goel <shubham0091@gmail.com>
     */
    public function index()
    {
        $roster = $this->getDetailedMatchRoster();
        return view('home')->with('roster', $roster);
    }

    /**
     * Get matches roster
     *
     * @return object roster
     * @author     Shubham Goel <shubham0091@gmail.com>
     */
    public function getDetailedMatchRoster()
    {
        $roster = $this->getMatchRosterWithTeam();
        if (empty($roster)) {
            $this->createMatchRoster();
            $roster = $this->getMatchRosterWithTeam();
        }
        return $roster;
    }

    /**
     * Get roster with team models
     *
     * @param      boolean require_team_data Flag to fetch or not to fetch team data
     * @return object roster
     * @author     Shubham Goel <shubham0091@gmail.com>
     */
    public function getMatchRosterWithTeam($require_team_data = true)
    {
        $roster = Match::whereNotIn('status', [Match::$completedStatus, Match::$cancelledStatus]);
        if ($require_team_data) {
            $roster = $roster->with(['f_team', 's_team']);
        }
        $roster = $roster->get()
                ->toArray();
        return $roster;
    }

    /**
     * Create match roster of the teams
     *
     * @return object teams
     * @author     Shubham Goel <shubham0091@gmail.com>
     */
    public function createMatchRoster()
    {
        $insert_roster = [];
        $teams = $this->getTeamsRandomly();
        if (!empty($teams)) {
            for ($i = 0; $i < count($teams) && isset($teams[$i+1]); $i = $i+2) {
                $insert_roster[] = [
                    'first_team' => $teams[$i]->id,
                    'score_first_team' => 0,
                    'second_team' => $teams[$i+1]->id,
                    'score_second_team' => 0,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ];
            }
            Match::whereNotIn('status', [Match::$completedStatus, Match::$cancelledStatus])
            ->update(['status' => Match::$cancelledStatus]);
            $result = Match::insert($insert_roster);
        }

        return $result;
    }

    /**
     * Get teams in random fashion.
     *
     * @return object teams
     * @author     Shubham Goel <shubham0091@gmail.com>
     */
    public function getTeamsRandomly()
    {
        $teams = Team::select('id','name','color')
                ->limit(10)
                ->inRandomOrder()
                ->get();

        return $teams;
    }

    /**
     * Update score board
     *
     * @return object roster
     * @author     Shubham Goel <shubham0091@gmail.com>
     */
    public function updateCurrentMatchScore()
    {
        $return_array = [
            'status' => true,
            'minutes_passed' => '-1',
            'match_play_time' => config('custom.match_play_time'),
            'data' => []
        ];
        $scores = [];
        $roster = $this->getMatchRosterWithTeam(false);
        if (!empty($roster)) {
            foreach ($roster as $match) {
                if ($match['minutes_passed'] < config('custom.match_play_time')) {
                    $match['score_first_team'] += rand(0,1);
                    $match['score_second_team'] += rand(0,1);
                    $match['minutes_passed'] += 1;

                    $scores[$match['first_team']] = $match['score_first_team'];
                    $scores[$match['second_team']] = $match['score_second_team'];

                    Match::where('id', $match['id'])
                    ->update([
                        'score_first_team' => $match['score_first_team'],
                        'score_second_team' => $match['score_second_team'],
                        'minutes_passed' => $match['minutes_passed'],
                        'status' => Match::$onGoingStatus,
                    ]);
                } else {
                    Match::where('id', $match['id'])
                    ->update([
                        'status' => Match::$completedStatus,
                    ]);
                }
            }
            $return_array['minutes_passed'] = $roster[0]['minutes_passed'];
            $return_array['data'] = $scores;
        }
        return response()
            ->json($return_array);
    }


}
