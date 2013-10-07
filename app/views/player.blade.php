
@extends('layouts.master')

@section('title')
@parent
:: {{ $player->name }}
@stop

@section('content')
    <div class="content">

        <div>
            <div class="player-image-container pull-left">
                <img src="{{ $player->image }}" class="player-image" />
            </div>
            <h1>{{ $player->name }}</h1>
            <h4><em>{{ $player->school }}</em></h4>
        </div>

        <div class="pull-right">
            <p><a href="{{ $baseurl }}players">Back to Top 5</a></p>
        </div>

        <table class="table table-striped table-bordered">
        	<thead>
        		<tr class="player-stats-header">
                    <th>2012-2013</th>
        			<th>Opponent</th>
                    <th>Player Score</th>
                    <th>Team Score</th>
                    <th>W/L</th>
        		</tr>
        	</thead>
        	<tbody>
        		@foreach ($player->stats as $stat)
					<tr>
                        <td>Game #{{ $stat->gameNumber }}<br/>{{ $stat->gameDate }}</td>
						<td>{{ $stat->opponent }}</td>
                        <td>{{ $stat->playerScore }}</td>
                        <td>{{ $stat->teamScore }}</td>
                        <td>{{ $stat->teamWinLoss }}</td>
					</tr>
				@endforeach
        	</tbody>
		</table>

        <div id="scoringchart"></div>

    </div>

    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Game', 'Player', 'Team'],
          @foreach ($player->stats as $stat)
            ['#{{ $stat->gameNumber }}',  {{ $stat->playerScore }}, {{ $stat->teamScore }}]
            @if (count($player->stats) !== $stat->gameNumber)
                ,
            @endif
          @endforeach
        ]);

        var options = {
          title: 'Player vs Team Scoring',
          legend: 'bottom'
        };

        var chart = new google.visualization.LineChart(document.getElementById('scoringchart'));
        chart.draw(data, options);
      }
    </script>

@stop
