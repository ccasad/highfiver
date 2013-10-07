
@extends('layouts.master')

@section('title')
@parent
:: Top Players (Indiana 2012-2013)
@stop

@section('content')
    <div class="content">

        <h1>Top 5 Players</h1>
        <h4><em>Indiana 2012-2013</em></h4>

        <table class="table table-striped table-bordered">
        	<tbody>
        		@foreach ($players as $player)
 							<tr>
 								<td><a href="{{ $baseurl }}players/{{ $player->id }}">{{ $player->name }}</a></td>
 							</tr>
						@endforeach
        	</tbody>
				</table>

				{{ Form::open(array('action' => 'PlayersController@index')) }}

    </div>
@stop
