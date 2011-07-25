<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require 'geocoder/GGeocoderParserLib.v1.php';

class Geocoder{
	private $language = 'en';
	
	function set_language($new_lang)
	{
		$this->language = $new_lang;
	}
	
	function geocode_by_address($address)
	{
		$gg = get_ggeocoder_json($address,'',$this->language);
		return $gg->results;
	}
	
	function geocode_by_latlng($latlng)
	{
		$gg = get_ggeocoder_json('',$latlng,$this->language);
		return $gg->results;
	}
	
	function geocode($address, $latlng){
		$gg = get_ggeocoder_json($address,$latlng,$this->language);
		return $gg->results;
	}
}

// End of geocoder.php