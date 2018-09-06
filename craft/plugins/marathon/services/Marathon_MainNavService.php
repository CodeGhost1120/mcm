<?php

namespace Craft;

class Marathon_MainNavService extends BaseApplicationComponent
{

	public function getNavItems($type)
	{

		//Chache saved 14 DB Queries

		$cache_key = md5($type);
		$cache = craft()->cache->get($cache_key);
		$cache = false;
		if(! $cache)
		{
			$nav_items = craft()->globals->getSetByHandle($type);

			$nav_items = $nav_items->navigationItems;

			$items = array();

			foreach($nav_items as $item)
			{
				$url = '';
				
				if(isset($item->itemDestination[0]))
				{
					$url = $item->itemDestination[0]->url;
				}

				$items[] = array(
					'title' => $item->itemTitle,
					'url' => $url
				);
			}

			//Cache for one week
			craft()->cache->set($cache_key, $items, 604800);

			return $items;
		} else {
			return $cache;
		}
	}

}	