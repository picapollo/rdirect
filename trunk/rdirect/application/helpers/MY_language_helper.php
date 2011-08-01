<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    /**
     * Fetch a single line of text from the language array. Takes variable number
     * of arguments and supports wildcards in the form of '%1', '%2', etc.
     * Overloaded function.
     *
     * @return mixed false if not found or the language string
     */
    function lang()
	{
		$CI =& get_instance();
		return $CI->lang->line(func_get_args());
	}
    
// End of MY_language_helper.php
// Location: application/helpers