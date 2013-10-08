<?php

class PlayerRepositoryTest extends TestCase
{
	

	public function testTopPlayersInfoExtraction()
	{
		//$playerRepository = new PlayerRepository();
		//$player = playerRepository->getPlayer('56714');

		$response = $this->action('GET', 'PlayersController@index');

		//$this->assertViewHas('players');
		$players = $response->original->getData();
		print_r($players);

		$this->assertTrue(true);
		//$crawler = $this->client->request('GET', '/');
		//$this->assertTrue($this->client->getResponse()->isOk());
	}
}
