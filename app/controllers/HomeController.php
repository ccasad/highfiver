<?php

class HomeController extends BaseController {

	/**
   * The layout that should be used for responses.
   */
  protected $layout = 'layouts.master';
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
	 * Display the welcome page
	 *
	 * @return Response
	 */
	public function showWelcome()
	{
		// route to home.blade.php template view and pass it the baseurl
		$this->layout->content = View::make('home')
															->with('baseurl', $this->baseUrl);
	}

}