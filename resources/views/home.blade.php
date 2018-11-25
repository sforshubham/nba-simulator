@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="col-md-12">
                        <button id="trigger_nba_week" disabled="disabled">Start NBA Week</button>
                    </div>
                    <div>&nbsp;</div>
                    <div class="col-md-12">
                    @for ($i = 0; $i < count($roster); $i++)
                        <div>&nbsp;</div>
                        <div class="col-md-12">
                            <span class="col-md-5 float-left team-span" style="border: 10px solid {{ $roster[$i]['f_team']['color'] }};">
                                {{ $roster[$i]['f_team']['name'] }}
                                <br>
                                <span id="team_id_{{ $roster[$i]['f_team']['id'] }}" class="score-span">{{ $roster[$i]['score_first_team'] }}</span>
                            </span> 
                            <span class="col-md-2 float-left team-span">
                                <br>
                                VS
                                <br>
                            </span>
                            <span class="col-md-5 float-left team-span" style="border: 10px solid {{ $roster[$i]['s_team']['color'] }};">
                                {{ $roster[$i]['s_team']['name'] }}
                                <br>
                                <span id="team_id_{{ $roster[$i]['s_team']['id'] }}" class="score-span">{{ $roster[$i]['score_second_team'] }}</span>
                            </span>
                        </div>
                        <div>&nbsp;</div>
                        <div>&nbsp;</div>
                        <div>&nbsp;</div>
                    @endfor
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/nba_custom.js') }}" defer></script>
@endsection
