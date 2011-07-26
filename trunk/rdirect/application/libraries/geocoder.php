<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require 'geocoder/GGeocoderParserLib.v1.php';

class Geocoder extends simple_ggeocoder_json_parser{
	function __construct($language='en',$sensor ='false'){
		parent::__construct($language, $sensor);
	}
	
	function set_language($new_lang)
	{
		$this->language = $new_lang;
	}
	
	function geocode_by_address($address)
	{
		$this->load($address, '', $this->language, 'false');

		if($this->obj->status !=='OK'){
			return FALSE;
		}
		$res = array();
		foreach($this->obj->results[0]->address_components as $k=>$i){
			if(in_array('street_address', $i->types) || in_array('postal_code', $i->types) || in_array('zip_code', $i->types))
				continue;	
			$res[] = $i->long_name; 
		}
		return implode(', ', $res);
	}
	
	function geocode_by_latlng($latlng)
	{
		$this->load('', $latlng, $this->language, 'false');
		
		if($this->obj->status !=='OK'){
			return FALSE;
		}
		
		$res = array();
		foreach($this->obj->results[0]->address_components as $k=>$i){
			if(in_array('street_address', $i->types) || in_array('postal_code', $i->types) || in_array('zip_code', $i->types))
				continue;	
			$res[] = $i->long_name; 
		}
		return implode(', ', $res);
	}
}

// End of geocoder.php