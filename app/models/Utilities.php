<?php

class Utilities 
{
	public static function getPageContents($url) 
	{
		$content = '';

		if ($url && strlen($url))
		{
		  $options = array( 
		    CURLOPT_RETURNTRANSFER => true,     // return web page 
		    CURLOPT_HEADER         => false,    // don't return headers 
		    CURLOPT_FOLLOWLOCATION => true,     // follow redirects 
		    CURLOPT_ENCODING       => "",       // handle all encodings 
		    CURLOPT_USERAGENT      => 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5', // who am i 
		    CURLOPT_AUTOREFERER    => true,     // set referer on redirect 
		    CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect 
		    CURLOPT_TIMEOUT        => 120,      // timeout on response 
		    CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects 
		  ); 

		  $ch = curl_init($url); 
		  curl_setopt_array($ch, $options); 
		  $content = curl_exec($ch); 
		  $err = curl_errno($ch); 
		  $errmsg = curl_error($ch); 
		  $header = curl_getinfo($ch); 
		  curl_close($ch); 

		  return $content;	
	  }
	}
}