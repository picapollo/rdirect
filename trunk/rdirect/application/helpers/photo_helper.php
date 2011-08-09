<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('insert_user_photo'))
{
    function insert_user_photo($uid, $size, $default=0)
    {
		if($default) // No photo
		{
			return IMG_DIR.'/default_profile/'.$size.'.png';
		}
		else
		{
			return UPLOADS_DIR.'/users/'.$uid.'/'.$size.'.png';
		}
    }   
}

if( ! function_exists('insert_room_photo'))
{
	function insert_room_photo($pid, $size)
	{
		if( ! $pid) // No photo
		{
			return IMG_DIR.'/page3/v3/room_default_no_photos.png';
		}
		else
		{
			return UPLOADS_DIR.'/rooms/'.$pid.'/'.$size.'.jpg';
		}
	}
}
