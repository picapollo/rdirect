<?php

/**
 * remove question marks from functions site_url() and redirect()
 */
class MY_Config extends CI_Config {
	function __construct()
	{
		parent::__construct();
	}

	public function site_url($uri = '')
	{
		//Copy the method from the parent class here:
		if($uri == '')
		{
			if($this -> item('base_url') == '')
			{
				return $this -> item('index_page');
			}
			else
			{
				return $this -> slash_item('base_url') . $this -> item('index_page');
			}
		}

		if($this -> item('enable_query_strings') == FALSE)
		{
			if(is_array($uri))
			{
				$uri = implode('/', $uri);
			}

			$index = $this -> item('index_page') == '' ? '' : $this -> slash_item('index_page');
			$suffix = ($this -> item('url_suffix') == FALSE) ? '' : $this -> item('url_suffix');
			return $this -> slash_item('base_url') . $index . trim($uri, '/') . $suffix;
		}
		else
		{
			if(is_array($uri))
			{
				$i = 0;
				$str = '';
				foreach($uri as $key => $val)
				{
					$prefix = ($i == 0) ? '' : '&';
					$str .= $prefix . $key . '=' . $val;
					$i++;
				}
				$uri = $str;
			}
			if($this -> item('base_url') == '')
			{
				//You need to remove the "?" from here if your $config['base_url']==''
				//return $this->item('index_page').'?'.$uri;
				return $this -> item('index_page') . $uri;
			}
			else
			{
				//Or remove it here if your $config['base_url'] != ''
				//return $this->slash_item('base_url').$this->item('index_page').'?'.$uri;
				return $this -> slash_item('base_url') . $this -> item('index_page') . $uri;
			}
		}
	}

}

// End of MY_config.php
