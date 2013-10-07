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

		if (stristr($_SERVER['HTTP_HOST'], 'localhost'))
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
		$players = $this->playerRepository->getTopPlayers();

		//return print_r($players, true);

		$this->layout->content = View::make('players')
															->with('players', $players)
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
		$player = $this->playerRepository->getPlayer($id);

		//return print_r($player, true);

		$this->layout->content = View::make('player')
															->with('player', $player)
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