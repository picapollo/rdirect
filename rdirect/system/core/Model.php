<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2011, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * CodeIgniter Model Class
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/libraries/config.html
 */
class CI_Model {

	 /**
	  * @var CI_Config
	  */
	 private $config;
	 /**
	  * @var CI_DB_active_record
	  */
	 private $db;
	 /**
	  * @var CI_Email
	  */
	 private $email;
	 /**
	  * @var CI_Form_validation
	  */
	 private $form_validation;
	 /**
	  * @var CI_Input
	  */
	 private $input;
	 /**
	  * @var CI_Loader
	  */
	 private $load;
	 /**
	  * @var CI_Router
	  */
	 private $router;
	 /**
	  * @var CI_Session
	  */
	 private $session;
	 /**
	  * @var CI_Table
	  */
	 private $table;
	 /**
	  * @var CI_Unit_test
	  */
	 private $unit;
	 /**
	  * @var CI_URI
	  */
	 private $uri;
	 /**
	  * @var CI_Pagination
	  */
	 private $pagination;

	/**
	 * Constructor
	 *
	 * @access public
	 */
	function __construct()
	{
		log_message('debug', "Model Class Initialized");
	}

	/**
	 * __get
	 *
	 * Allows models to access CI's loaded classes using the same
	 * syntax as controllers.
	 *
	 * @access private
	 */
	function __get($key)
	{
		$CI =& get_instance();
		return $CI->$key;
	}
}
// END Model Class

/* End of file Model.php */
/* Location: ./system/core/Model.php */