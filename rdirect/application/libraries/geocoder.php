<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require 'geocoder/GGeocoderParserLib.v1.php';

class Geocoder extends simple_ggeocoder_json_parser{
	
	protected $exclude = array(
		'sublocality_level_3', 'sublocality_level_4', 'sublocality_level_5', 'street_address', 'street_number', 'postal_code'
	);
	
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
			foreach($this->exclude as $ex)
			{
				if(in_array($ex, $i->types))
				{
					unset($ex);
					break;
				}
			}
			if(isset($ex)) $res[] = $i->long_name; 
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
			foreach($this->exclude as $ex)
			{
				if(in_array($ex, $i->types))
				{
					unset($i);
					break;
				}
			}
			if(isset($i)) $res[] = $i->long_name; 
		}
		return implode(', ', $res);
	}
}

// End of geocoder.php