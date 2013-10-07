<?php

class PlayerRepository
{

	private $baseUrl = 'http://www.varvee.com/';

	/*
	The purpose of this method is to get the information about a specific player
	*/
	public function getPlayer($id) 
	{
		$player = new Player();

		$url = $this->baseUrl . 'team/player/27/' . $id;
		
		$html = Utilities::getPageContents($url);

		$htmlDoc = new DomDocument();
		libxml_use_internal_errors(true);
		$htmlDoc->loadHTML($html);
		
		if ($htmlDoc) 
		{
			$xpath = new DOMXPath($htmlDoc);
		
			if ($xpath) 
			{
				$profileNode = $xpath->query('.//div[@class=\'profile-wrapper\']');

				if ($profileNode->item(0)) 
				{
					$playerNameNode = $xpath->query('.//div[@class=\'profile-name\']', $profileNode->item(0));
					if ($playerNameNode->item(0)) 
					{
						$player->name = $playerNameNode->item(0)->nodeValue;
					}
		
					$playerImageNode = $xpath->query('.//div[@class=\'profile-image\']/a/img/@src', $profileNode->item(0));
					if ($playerImageNode->item(0)) 
					{
						$player->image = $this->baseUrl . $playerImageNode->item(0)->nodeValue;
					}
			
					$playerSchoolNode = $xpath->query('.//div[@class=\'detail school\']/a', $profileNode->item(0));
					if ($playerSchoolNode->item(0)) 
					{
						$player->school = $playerSchoolNode->item(0)->nodeValue;
					}
			
					$tables = $htmlDoc->getElementsByTagName('table');

					$totalStats = array();
			
					if ($tables->item(0) && $tables->length == 1) 
					{
			
						$rows = $xpath->query('.//tbody/tr', $tables->item(0));

						if ($rows) 
						{
							if ($rows->length > 3) 
							{
								// need to start at index 2 because the first two rows are header info
								for ($i = 2; $i < $rows->length; $i++) 
								{
									$stats = new PlayerStats();
					
									if ($rows->item($i)) 
									{
										$cells = $xpath->query('.//td', $rows->item($i));
			
										if ($cells->item(0)) 
										{
											$anchors = $xpath->query('.//a', $cells->item(0));
											if ($anchors->item(0)) 
											{
												$stats->gameDate = $anchors->item(0)->nodeValue;
											}
										}
										
										if ($cells->item(1)) 
										{
											$stats->opponent = $cells->item(1)->nodeValue;
										}

										if ($cells->item(2)) 
										{
											$anchors = $xpath->query('.//a', $cells->item(2));
											if ($anchors->item(0)) 
											{
												$gameResults = $anchors->item(0)->nodeValue;
												if ($gameResults && strlen($gameResults)) 
												{
													$gameResultsParts = explode('-', $gameResults);
													if ($gameResultsParts && count($gameResultsParts) == 2) 
													{
														$stats->teamWinLoss = substr($gameResultsParts[0], 0, 1);
														$score1 = substr($gameResultsParts[0], 1);
														$score2 = $gameResultsParts[1];
														$stats->teamScore = ($stats->teamWinLoss == 'W') ? $score1 : $score2;
													}
												}
											}
										}
									}
						
									if ($cells->item(3)) 
									{
										$stats->playerScore = $cells->item(3)->nodeValue;
									}
					
									$stats->gameNumber = $i - 1;

									$totalStats[] = $stats;

								}
							}
						}
			
					} 
					else 
					{
						// TEST CASE ... should be only 1 table
						die('we are expecting one table but are not getting that');
					}
			
					$player->stats = $totalStats;
			
				} 
				else 
				{
					// TEST CASE - profile wrapper should exist
					die('cant find the profile wrapper');
				}
			}
		}

		return $player;

	}

	/*
	The purpose of this method is to get all the top players
	*/
	public function getTopPlayers($numberReturned=5, $year='2013')
	{
		// TEST CASE should be for 2013 and 2014 since one brings back data and the other doesn't
		$url = $this->baseUrl . 'team/individual_leaderboard/54/27//school-year:' . $year . '/flag:1/activeTable:7ddcf6228db4ee2edfe138c2b283968d#7ddcf6228db4ee2edfe138c2b283968d';

		$html = Utilities::getPageContents($url);

		$htmlDoc = new DomDocument();
		libxml_use_internal_errors(true);
		$htmlDoc->loadHTML($html);
		
		if ($htmlDoc) 
		{
			$xpath = new DOMXPath($htmlDoc);

			$tables = $htmlDoc->getElementsByTagName('table');

			$players = array();
		
			if ($tables->item(0) && $tables->length == 1) 
			{
		
				$rows = $xpath->query('.//tbody/tr', $tables->item(0));

				if ($rows) 
				{
					if ($rows->length > 3) 
					{
						$counter = 0;
						// need to start at index 2 because the first two rows are header infor
						for ($i = 2; $i < $rows->length; $i++) 
						{
							$player = new Player();

							if ($rows->item($i)) 
							{
								$cells = $xpath->query('.//td', $rows->item($i));
			
								if ($cells->item(3)) 
								{
									$anchors = $xpath->query('.//a', $cells->item(3));
									if ($anchors->item(0)) 
									{
										$player->name = $anchors->item(0)->nodeValue;
										$href = $anchors->item(0)->getAttribute('href');
										if ($href && strlen($href)) 
										{
											$hrefParts = explode('/', $href);
											if ($hrefParts && count($hrefParts) == 5) 
											{
												$player->id = $hrefParts[4];
											}
										}
									}
								}
								
								if ($cells->item(6)) 
								{
									$player->totalPoints = $cells->item(6)->nodeValue;
								}
								
								if ($cells->item(7)) 
								{
									$player->pointsPerGame = $cells->item(7)->nodeValue;
								}
								
								$players[] = $player;
								$counter++;

								if ($counter >= $numberReturned) 
								{
									break;
								}
							}
						}
					} 
					else 
					{
						if (stristr($rows->item(2)->nodeValue, 'No results found')) 
						{
							print 'NO DATA FOUND';
						}
					}
				}
			} 
			else 
			{
				// TEST CASE ... should be only 1 table
				die('we are expecting one table but are not getting that');
			}
		}
		
		return $players;
	}

}