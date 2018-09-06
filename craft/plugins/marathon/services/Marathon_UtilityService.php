<?php

namespace Craft;

class Marathon_UtilityService extends BaseApplicationComponent
{

	//Service to return formatted page title
	public function getPageTitle($current_entry)
	{

		$cache_key = md5("getPageTitle_".$current_entry->id);

		$cache = craft()->cache->get($cache_key);
		if(! $cache)
		{

			if ($current_entry->title == 'Home'){
				$str = 'Marine Corps Marathon';
				craft()->cache->set($cache_key, $str, 3600);
				return $str;
			} else {
				$str = $current_entry->title;
			}

			//Check if this is an event page
			//If so, just show the page title and its parent event's title
			if($current_entry->sectionId == 4)
			{
				//Get parent event page, if not already the parent
				if($current_entry->level > 1)
				{
					$criteria = craft()->elements->getCriteria(ElementType::Entry);
					$criteria->ancestorOf = $current_entry;
					$criteria->level = 1;
					$criteria->order ="level desc";
					$parent_entry = $criteria->first();

					$str .= " - ".$parent_entry->title;
				}


			} else {
				//Get Parent Entries
				$criteria = craft()->elements->getCriteria(ElementType::Entry);
				$criteria->ancestorOf = $current_entry;
				$criteria->order ="level desc";
				$parent_entries = $criteria->find();

				foreach($parent_entries as $parent)
				{
					$str .= " - ".$parent->title;
				}

				$str .= " - Marine Corps Marathon";
			}

			craft()->cache->set($cache_key, $str, 3600);
			return $str;


		} else {
			return $cache;
		}
	}

	public function getCustomPageTitle($titles)
	{
		$str = '';
		foreach ($titles as $title)
		{
			$str .= $title . " - ";
		}

		$str .= "Marine Corps Marathon";

		return $str;
	}
}
