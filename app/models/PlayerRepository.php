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
	
		try 
		{
			// pull the contents from the varvee site
			$html = Utilities::getPageContents($url);

			// load up the DOM
			$htmlDoc = new DomDocument();
			libxml_use_internal_errors(true);
			$htmlDoc->loadHTML($html);
			
			if ($htmlDoc) 
			{
				$xpath = new DOMXPath($htmlDoc);
			
				if ($xpath) 
				{
					// extract the div for the player profile 
					$profileNode = $xpath->query('.//div[@class=\'profile-wrapper\']');

					if ($profileNode->item(0)) 
					{
						// extract the div for the player name and set the name to the player object name prop
						$playerNameNode = $xpath->query('.//div[@class=\'profile-name\']', $profileNode->item(0));
						if ($playerNameNode->item(0)) 
						{
							$player->name = $playerNameNode->item(0)->nodeValue;
						}
			
						// extract the div for the player image and set the image src to the player object image prop
						$playerImageNode = $xpath->query('.//div[@class=\'profile-image\']/a/img/@src', $profileNode->item(0));
						if ($playerImageNode->item(0)) 
						{
							$player->image = $this->baseUrl . $playerImageNode->item(0)->nodeValue;
						}
				
						// extract the div for the player school and set the name to the player object name prop
						$playerSchoolNode = $xpath->query('.//div[@class=\'detail school\']/a', $profileNode->item(0));
						if ($playerSchoolNode->item(0)) 
						{
							$player->school = $playerSchoolNode->item(0)->nodeValue;
						}
				
						// extract the table for the player stats
						$tables = $htmlDoc->getElementsByTagName('table');

						$totalStats = array();
				
						if ($tables->item(0) && $tables->length == 1) 
						{
				
							// extract all the rows of the table
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
											// extract all the cells for the current row
											$cells = $xpath->query('.//td', $rows->item($i));
				
											// extract the game date and set the player stats object gameDate prop
											if ($cells->item(0)) 
											{
												$anchors = $xpath->query('.//a', $cells->item(0));
												if ($anchors->item(0)) 
												{
													$stats->gameDate = $anchors->item(0)->nodeValue;
												}
											}
											
											// extract the game opponent and set the player stats object opponent prop
											if ($cells->item(1)) 
											{
												$stats->opponent = $cells->item(1)->nodeValue;
											}

											// extract the game score and set the player stats object prop for teamWinLoss and teamScore
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

											// extract the player score and set the player stats object playerScore prop
											if ($cells->item(3)) 
											{
												$stats->playerScore = $cells->item(3)->nodeValue;
											}
										}
						
										$stats->gameNumber = $i - 1;

										$totalStats[] = $stats;

									}
								}
							}
				
						} 
						else 
						{
							// the varvee page must have changed no longer just one table therefore set the $player object to null
							$player = null;
						}
				
						$player->stats = $totalStats;
				
					} 
					else 
					{
						// the varvee page must have changed no longer can find profile wrapper therefore set the $player object to null
						$player = null;
					}
				}
			}
		}
		catch(Exception $e)
		{
			// need to log the exception and set the player object to null
			$player = null;
		}

		return $player;

	}

	/*
	The purpose of this method is to get all the top players
	*/
	public function getTopPlayers($numberReturned=5, $year='2013')
	{
		$container = array();
		$players = array();
		$years = array();

		$url = $this->baseUrl . 'team/individual_leaderboard/54/27//school-year:' . $year . '/flag:1/activeTable:7ddcf6228db4ee2edfe138c2b283968d#7ddcf6228db4ee2edfe138c2b283968d';

		try
		{

			// pull the contents from the varvee site
			$html = Utilities::getPageContents($url);

			// load up the DOM
			$htmlDoc = new DomDocument();
			libxml_use_internal_errors(true);
			$htmlDoc->loadHTML($html);
			
			if ($htmlDoc) 
			{
				$xpath = new DOMXPath($htmlDoc);

				// extract the school years from drop down
				$yearDropdown = $htmlDoc->getElementById('school-year');
				$yearDropdownOptions = $xpath->query('.//option', $yearDropdown);
				foreach ($yearDropdownOptions as $option)
				{
					$years[$option->getAttribute('value')] = $option->nodeValue;
				}

				// extract the table with all the players
				$tables = $htmlDoc->getElementsByTagName('table');
			
				if ($tables->item(0) && $tables->length == 1) 
				{
					// extract all the table rows
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
									// extract all the cells for the current row
									$cells = $xpath->query('.//td', $rows->item($i));
				
									// extract the player name and id and set the player object name and id prop
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
									
									// extract the totalPoints and set the player object prop
									if ($cells->item(6)) 
									{
										$player->totalPoints = $cells->item(6)->nodeValue;
									}
									
									// extract the pointsPerGame and set the player object prop
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
								// 'NO DATA FOUND' so a blank array will be sent
							}
						}
					}
				} 
				else 
				{
					// the varvee page must have changed no longer just one table therefore set the $players object to null
					$players = null;
				}
			}
		}
		catch (Exception $e)
		{
			// need to log the exception and set the players object to null
			$players = null;
		}

		$container['years'] = $years;
		$container['players'] = $players;

		return $container;
	}

}