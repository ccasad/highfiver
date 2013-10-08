<?php

class PlayersController extends \BaseController {

	/**
   * The layout that should be used for responses.
   */
  protected $layout = 'layouts.master';
	private $playerRepository;
	private $baseUrl = '/highfiver/';


	/**
	 * Constructor.
	 *
	 */
	public function __construct(PlayerRepository $repository)
	{
		$this->playerRepository = $repository;

		if (stristr(Request::url(), 'localhost'))
		{
			$this->baseUrl = '/highfiver/public/';
		}
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

		// set the default year so we see some initial data
		$year = '2013';
		if (strlen(Input::get('year'))) 
		{
			$year = Input::get('year');
		}

		// get the top 5 players array to be displayed in the view
		$container = $this->playerRepository->getTopPlayers(5, $year);

		// route to players.blade.php template view and pass it the players array and baseurl
		$this->layout->content = View::make('players')
															->with('players', $container['players'])
															->with('years', $container['years'])
															->with('year', $year)
															->with('baseurl', $this->baseUrl);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		// get the player object as requested by the player id passed into the method
		$player = $this->playerRepository->getPlayer($id);

		// route to player.blade.php template view and pass it the player object and baseurl
		$this->layout->content = View::make('player')
															->with('player', $player)
															->with('year', Input::get('year'))
															->with('baseurl', $this->baseUrl);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}