
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

				<p>
				<form method="GET" action="{{ $baseurl }}players" accept-charset="UTF-8">
					<label for="year">Year: </label>
					<select id="year" name="year" onchange="this.form.submit();">
						@foreach ($years as $key => $value)
							<option value="<?php echo $key; ?>" <?php echo ($year == $key) ? 'selected="selected"' : ''; ?> ><?php echo $value; ?></option>
						@endforeach
					</select>
				</form>
				</p>

        <?php if(isset($players) && is_array($players)) : ?>
	        @if (count($players) > 0)
		        <table id="playerstable" class="table table-striped table-bordered hf-table">
		        	<tbody>
		        		@foreach ($players as $player)
		 							<tr>
		 								<td><a href="{{ $baseurl }}players/{{ $player->id }}?year={{ $year }}">{{ $player->name }}</a></td>
		 							</tr>
								@endforeach
		        	</tbody>
						</table>				    
					@else
					    <div class="alert alert-warning">Well it looks like no results were found.</div>
					@endif
				<?php else : ?>
					<div class="alert alert-danger">Oh no! Something went wrong. Please try again. If the problem continues please contact support@highfive.</div>
				<?php endif; ?>

    </div>
@stop
