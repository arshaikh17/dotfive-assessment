<?php

namespace App\Traits;

trait Helper
{
	public function first_letters($string, $upper)
	{
		$string = trim($string);
		$words = explode(" ", $string);
		$acronym = "";
		
		foreach ($words as $w) 
		{

		  $acronym .= $w[0];
		}

		if($upper == true)
		{
			$acronym = strtoupper($acronym);
		}

		return $acronym;
	}

	public function random_letters($iteration)
	{
		$letters = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
		//$numbers = array();

		$count1 = count($letters);
		//$count2 = count($numbers);

		$string = "";
		for($i = 1; $i <= $iteration; $i++)
		{
			$a = rand(0, $count1-1);

			$string .= $letters[$a];			
		}

		return $string;
	}
}










