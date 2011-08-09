<?php

class Currency
{
	private function get_google_currency($a,$from,$to)
	{
		$google_url = "http://www.google.com/ig/calculator?hl=en&q=$a$from=?$to";
		$ch = curl_init ();
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_URL, $google_url);
		curl_setopt($ch, CURLOPT_USERAGENT , "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1)");
		$response = curl_exec($ch);
		curl_close($ch);
		return $response;
	}

	function convert($amount,$from,$to)
	{
		$response = $this->get_google_currency($amount,$from,$to);
		$data = explode('"', $response);
		$data = explode(' ', $data[3]);
		$var = preg_replace("/[^0-9^.]/", "", $data['0']);
		return $var;
	}
}

