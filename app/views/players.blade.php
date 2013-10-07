
@extends('layouts.master')

@section('title')
@parent
:: Top Players
@stop

@section('content')
    <div class="container">
        <p> {{-- print_r($players) --}} </p>

        <h1>Top 5 Players</h1>

        <table class="table table-striped table-bordered">
        	<tbody>
        		@foreach ($players as $player)
 							<tr>
 								<td><a href="/highfiver/public/players/{{ $player->id }}">{{ $player->name }}</a></td>
 							</tr>
						@endforeach
        	</tbody>
				</table>

    </div>
@stop
