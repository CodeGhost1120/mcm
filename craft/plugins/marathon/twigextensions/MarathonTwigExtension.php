<?php

/*
* Marathon Plugin - Twig Extensions
* 'marathon/twigextensions/MarathonTwigExtension.php'
*/

namespace Craft;

use Twig_Extension;
use Twig_Filter_Method;

class MarathonTwigExtension extends Twig_Extension
{
	public function getName()
	{
		return 'marathon';
	}

	public function getFilters()
	{
		return array(
			'make_id' => new Twig_Filter_Method($this, 'make_id'),
			'days_until' => new Twig_Filter_Method($this, 'days_until')
		);
	}

	public function make_id($string)
	{	
		//First, remove any quotes
		$pattern = '/[\'\"]/';
		$replacement = '';
		$string = preg_replace($pattern, $replacement, $string);

		//Next, replace all non alpha-numeric characters with a dash
		$pattern = '/[^a-zA-Z0-9]+/';
		$replacement = '-';
		$string = preg_replace($pattern, $replacement, $string);

		//Next, if the last char is a dash because of a trailing non-alpha numeric, remove it
		$pattern = '/-$/';
		$replacement = '';
		$string = preg_replace($pattern, $replacement, $string);

		//Finally, lowercase all letters
		$string = strtolower($string);

		return $string;
	}

	public function days_until($date)
	{
		$now = time();
		$time_until = $date - $now;
		return floor($time_until/60/60/24);
	}
}