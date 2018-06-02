<?php

namespace App\Traits;

trait Sanitize
{
	public function sanitize_string($string)
	{
		$string = preg_replace('/ +/', ' ', preg_replace('/[^A-Za-z0-9 _,\/-]/', ' ', urldecode(html_entity_decode(strip_tags($string)))));
		return $string;
	}

	public function sanitize_number($number)
	{
		$number = preg_replace("/([^0-9\\.])/i", "", $number);
		return $number;
	}

	public function sanitize_textarea($text)
	{
		$tags = '<ul><li><h1><h2><h3><h4><h5><h6><ol><span><p><strong><br><hr>';
		$text = strip_tags($text, $tags);

		return $text;
	}

	public function sanitize_url($url)
	{
		$url = preg_replace('/ +/', ' ', preg_replace('/[^A-Za-z0-9 -=.?&:\/]/', ' ', urldecode(html_entity_decode(strip_tags($url)))));
		/*if(!filter_var($url, FILTER_VALIDATE_URL))
		{
			$url = "/internal/errors/url/1";
		}
		*/
		if(!substr($url, 0, 7) === "http://" || !substr($url, 0, 8) === "https://")
		{
			$url = "http://".$url;
		}
		return $url;
	}
}