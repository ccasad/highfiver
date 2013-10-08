
@extends('layouts.master')

@section('title')
@parent
:: Top Players (Indiana 2012-2013)
@stop

@section('content')
    <div class="content">

    		<div class="pull-right">
            <p><a href="{{ $baseurl }}">Home</a></p>
        </div>

        <h1>Top 5 Players</h1>
        <h4><em>Indiana 2012-2013</em></h4>

        @if ($players && is_array($players))
	        @if (count($players) > 0)
		        <table id="playerstable" class="table table-striped table-bordered hf-table">
		        	<tbody>
		        		@foreach ($players as $player)
		 							<tr>
		 								<td><a href="{{ $baseurl }}players/{{ $player->id }}">{{ $player->name }}</a></td>
		 							</tr>
								@endforeach
		        	</tbody>
						</table>				    
					@else
					    <div class="alert alert-warning">Well it looks like no results were found.</div>
					@endif
				@else
					<div class="alert alert-danger">Oh no! Something went wrong. Please try again. If the problem continues please contact support@highfive.</div>
				@endif

    </div>
@stop
