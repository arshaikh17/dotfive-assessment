<?php

namespace App\Traits;

use Illuminate\Support\Facades\Validator;
use App\Http\Requests;

trait Verify 
{
	public function verify_string($string)
	{
		$check = false;
		if(preg_replace('/ +/', ' ', preg_replace('/[^A-Za-z0-9 ]/', ' ', urldecode(html_entity_decode(strip_tags($string))))))
		{
			$check = true;
		}

		return $check;
	}

	public function verify_checkbox($checkbox)
	{
		$var = 0;
		if($checkbox)
		{
			$var = 1;
		}
		else
		{
			$var = 0;
		}

		return $var;
	}

	public function verify_password($password)
	{
		$pattern = "/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[~^%@#&$*+=_-])[^\s$`,.\/\\;:'|]{8,50}$/";
		$status = false;
		if(preg_match($pattern, $password))
		{
			$status = true;
		}
		return $status;
	}

	public function verify_image($request, $field_name)
	{
		$check = true;
		$data = $request->all();
		//dd($data[$field_name]);
		$verify = Validator::make((array)$data, [
        	$field_name => 'required|image|mimes:jpeg,png,jpg|max:2048',
    	]);

    	if($verify->fails())
    	{
    		$check = false;
    	}

    	return $check;
	}

	public function verify_images($request, $field_name)
	{
		$check = true;
		$data = $request->all();
		//dd((array)$data);
		
		$verify = Validator::make((array)$data, [
        	$field_name.".*" => 'required|image|mimes:jpeg,png,jpg|max:2048',
    	]);

    	if($verify->fails())
    	{
    		$check = false;
    	}

    	return $check;
	}

	public function verify_email($email)
	{
		$check = false; 
		if(filter_var($email, FILTER_VALIDATE_EMAIL))
		{
			$check = true;
		}

		return $check;
	}
}