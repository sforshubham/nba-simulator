<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
	public static $notStartStatus = '0';
	public static $onGoingStatus = '1';
	public static $completedStatus = '2';
	public static $cancelledStatus = '3';

    public function f_team()
    {
        return $this->belongsTo('\App\Team', 'first_team');
    }

    public function s_team()
    {
        return $this->belongsTo('\App\Team', 'second_team');
    }
}
