<?php

namespace Craft;

class Marathon_AdService extends BaseApplicationComponent
{
	/**
	 * Get Ads By Category
	 * @param  array $categories
	 * @return array of Entries
	 */
	private function getAdsByCategory($categories)
	{
		$criteria = craft()->elements->getCriteria(ElementType::Entry);
		$criteria->section = 'adBuys';

		//Set up Relations
		$relations = array('and');
		foreach($categories as $category)
		{
			$relations[] = array(
				'field' => 'adCategories',
				'targetElement' => $categories
			);
		}
		
		$criteria->relatedTo = $relations;
		$ads = $criteria->find();

	}

	//Returns ads requested from a certain module block
	
	public function getAds($block)
	{
		$cache_key = md5('adSection_'.$block->id);
		$cache = craft()->cache->get($cache_key);

		if(! $cache)
		{
			$ads = array();

			foreach($block->advertisementEntries as $entry)
			{
				$url = '';
				if(count($entry->entry))
				{
					$url = $entry->entry[0]->url;
				} else {
					$url = $entry->adUrl;
				}

				$small_ad = '';
				if(isset($entry->smallAd[0]))
				{
					$small_ad = $entry->smallAd[0]->url;
				} 

				$medium_ad = '';
				if(isset($entry->mediumAd[0]))
				{
					$medium_ad = $entry->mediumAd[0]->url;
				} 

				$large_ad = '';
				if(isset($entry->largeAd[0]))
				{
					$large_ad = $entry->largeAd[0]->url;
				} 

				$ads[] = array(
					'url' => $url,
					'smallAd' => $small_ad,
					'mediumAd' => $medium_ad,
					'largeAd' => $large_ad
				);
			}

			craft()->cache->set($cache_key, $ads, 3600);
			return $ads;
		} else {
			return $cache;
		}
	}

}