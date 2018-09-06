<?php
/*
* Marathon Plugin Tempalte Variables
* 'craft/plugins/marathon/variables/MarathonVariable.php'
*/

namespace Craft;

class MarathonVariable
{
	//Asset Path Variable
	public function assetPath(){
		$server = craft()->request->serverName;

		if($server == 'mcm.craft.dev')
		{
			return 'http://mcm.craft.dev/assets/';
		} else if($server == 'mcm.nclud.com') {
			return 'http://mcm.nclud.com/assets/';
		} else {
		        return '/assets/';    # fail gracefully with a root-relative URL
	        }
	}

	//Entry Module Builder
	public function getEntryData($block, $mode, $count)
	{
		$return = craft()->marathon_module->getEntryData($block, $mode, $count);
		return $return;
	}

	
	/*******************/
	/* EVENT VARIABLES */
	/*******************/

	public function getNavItems($current_entry){
		$return = craft()->marathon_eventNav->getNavItems($current_entry);
		return $return;
	}

	public function getTopParent($current_entry){
		$return = craft()->marathon_eventNav->getTopParent($current_entry);
		return $return;
	}

	/****************/
	/* AD VARIABLES */
	/****************/

	public function getAds($current_entry){
		$return = craft()->marathon_ad->getAds($current_entry);
		return $return;
	}

	/********************/
	/* SEARCH VARIABLES */
	/********************/

	public function getSearchEntryData($entry){
		$return = craft()->marathon_entry->getSearchEntryData($entry);
		return $return;
	}

	/**********************/
	/* TEMPLATE VARIABLES */
	/**********************/

	public function getPageTitle($current_entry)
	{
		$return = craft()->marathon_utility->getPageTitle($current_entry);
		return $return;
	}

	public function getCustomPageTitle($titles)
	{
		$return = craft()->marathon_utility->getCustomPageTitle($titles);
		return $return;
	}

	public function getMainNavItems($header_or_footer){
		$return = craft()->marathon_mainNav->getNavItems($header_or_footer);
		return $return;
	}


}