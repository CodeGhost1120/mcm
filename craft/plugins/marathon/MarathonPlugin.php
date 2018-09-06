<?php

namespace Craft;

class MarathonPlugin extends BasePlugin
{

	function getName()
	{
		return Craft::t('Marine Corps Marathon Plugin');
	}

	function getVersion()
	{
		return '1.0';
	}

	function getDeveloper()
	{
		return 'Aaron Berkowitz at nclud';
	}

	function getDeveloperUrl()
	{
		return 'http://www.nclud.com';
	}

	public function addTwigExtension()
	{
	    Craft::import('plugins.marathon.twigextensions.MarathonTwigExtension');
	    return new MarathonTwigExtension();
	}
}