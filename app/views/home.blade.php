
@extends('layouts.master')

@section('title')
@parent
:: Home
@stop

@section('content')
    
    <div class="content">

      <div class="header">
        <h3 class="text-muted">VNN Weekend Programming Challenge</h3>
      </div>

      <div class="jumbotron">
        <h1>High Fiver</h1>
        <p class="lead">High Fiver keeps track of the leader board of top high school basketball players in Indiana.</p>
        <p><a class="btn btn-lg btn-success" href="{{ $baseurl }}players">Go to High Fiver</a></p>
      </div>

      <div class="row marketing">
        <div class="col-lg-12">
          <h4>Deliverables</h4>
          <p>
            There were two required deliverables for this programming challenge. The first 
            is the <a href="{{ $baseurl }}players">High Fiver</a> app, which you can get to by clicking on the green button above. The 
            app was built in PHP using the Laravel MVC Framework. Unfortunately I was not able to get my php unit tests to work
            so I am missing that part of the non-functional requirements.
          </p>
          <p>
            The second requirement is a description of my strategy for system testing, which is below in the next section.
          </p>
          <p>
            Although not explicitly defined as a requirement I have my code available for <a href="https://github.com/ccasad/highfiver/archive/master.zip">download on GitHub</a>.
          </p>

          <h4>Strategy for System Testing</h4>
          <p>
            My system testing strategy would be to use Selenium IDE, the Firefox plugin, to help determine
            if the Varvee pages I'm scraping content from have changed. If they've changed that means my code
            to build the High Fiver app pages won't ever return results. Using Selenium's verify and assert 
            commands I would capture various parts of the page such as making sure the table exists
            listing all the top players. Similarly, I would capture parts of the player profile page as well
            to verify the players name exists, as well as the players stats table. 
          </p>

          <p><hr/></p>
          
          <h4>Problem Statement</h4>
          <p>
            VNN wants to keep track of the leader board of top basketball players in Indiana. VNN has 
            asked you to create a web app called “High Fiver” that dynamically shows users the top five 
            scorers in Indiana Boys Basketball, and gives users the ability to see game-by-game scoring 
            information about any of those players in a very simple format.
          </p>

          <h4>User Stories</h4>
          <p>
            <ol>
              <li>
                Users should dynamically see the top 5 players in Indiana basketball, ranked based on 
                their scoring average. See <a href="http://www.varvee.com/team/individual_leaderboard/54/27/" target="_blank">http://www.varvee.com/team/individual_leaderboard/54/27/</a>
              </li>
              <li>
                When a user clicks on a player, she should see a breakdown of that player's statistics 
                by game throughout the season. These stats include only: Points, team points, W/L
              </li>
              <li>
                Users should see a graph that shows how many points the player has scored each 
                game, plotted against how many points their team has scored in the same game.
              </li>
            </ol>
          </p>
          <h4>Functional Requirements</h4>
          <p>All info must be screen scraped dynamically from Varvee for every page load on High Fiver.</p>

          <h4>Non-Functional Requirements</h4>
          <p>
          <ol>
            <li>
              Unit tests should be written for Varvee.com parsing logic when getting info
            </li>
            <li>
              Application must be created in a PHP web framework or Ruby on Rails
            </li>
          </ol>
          </p>

        </div>
      </div>

    </div>

@stop
