<?php

namespace Craft;

class Marathon_EventNavService extends BaseApplicationComponent
{

	public function getNavItems($current_entry)
	{

		//Set cache
		$cache_key = md5('nav_items_'.$current_entry->id);

		$cache = craft()->cache->get($cache_key);

		if(! $cache)
		{
			$nav_items = null;

			$entires = '';

			//What level is our current page? 
			//If the level is top, get all sub pages
			if($current_entry->level == 1)
			{
				$entries = $this->getSubPages($current_entry);
			} else {
				$parent = $this->getTopParent($current_entry);
				$entries = $this->getSubPages($parent);
			}

			craft()->cache->set($cache_key, $entries, 86400);

			return $entries;
		} else {
			return $cache;
		}
	}

	


	private function getSubPages($current_entry)
	{
		$criteria = craft()->elements->getCriteria(ElementType::Entry);
		$criteria->section = 'events';
		$criteria->descendantOf = $current_entry;
		$criteria->displayInEventNavigation = 1;
		$criteria->level = $current_entry->level + 1;
		$entries = $criteria->find();

		$entries_to_return = array();

		if($current_entry->level > 1)
		{
			$entries_to_return[] = array(
				'title' => $current_entry->title,
				'url' => $current_entry->url,
				'glance' => $current_entry->glance,
				'sub_pages' => false
			);			
		}



		foreach($entries as $entry)
		{
			$entries_to_return[] = $this->entryToArray($entry);
		}

		if(count($entries_to_return)){
			return $entries_to_return;
		} else {
			return false;
		}
	}

	private function entryToArray($entry)
	{
		$array = array(
			'title' => $entry->title,
			'url' => $entry->url,
			'glance' => $entry->glance,
			'sub_pages' => $this->getSubPages($entry)		
		);

		return $array;
	}

	public function getTopParent($entry)
	{
		$criteria = craft()->elements->getCriteria(ElementType::Entry);
		$criteria->level = 1;
		$criteria->ancestorOf = $entry;

		$parent_entry = $criteria->fetch();

		if($parent_entry)
		{
			return $parent_entry[0];
		} else {
			return false;
		}

	}
}