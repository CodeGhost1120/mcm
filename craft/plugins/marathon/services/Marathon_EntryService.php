<?php

namespace Craft;

class Marathon_EntryService extends BaseApplicationComponent
{

	public function getSearchEntryData($entry)
	{
		$cache_key = md5('entry_data'.$entry->id);
		$cache = craft()->cache->get($cache_key);

		if(! $cache)
		{
			$blurb_text = '';
			$blurb_link = '';
			$blurb_title = '';
			$image = null;

			$date = '';

			if($entry->section->handle == 'blog')
			{
				$date = date('m.d.Y', strtotime($entry->postDate));
			}

			$data = array(
				'blurb' => $entry->entryBlurb,
				'title' => $entry->title,
				'url' => $entry->url,
				'heading' => $this->_getHeading($entry),
				'date' => $date
			);

			craft()->cache->set($cache_key, $data, 86400);
			return $data;
		} else {
			return $cache;
		}
	}

	private function _getHeading($entry)
	{
		$heading = '';
		switch($entry->section->handle)
		{
			case 'events':
				if($entry->level != 1)
				{
					$parent = $this->_getParent($entry);
					$heading = $parent->title;
				} else {
					$heading = $entry->title;
				}
				break;

			case 'pages':
				if($entry->level != 1)
				{
					$parent = $this->_getParent($entry);
					$heading = $parent->title;
				} else {
					$heading = $entry->title;
				}
				break;

			case 'blog':
				$heading = 'Blog';
				break;
		}
		return $heading;
	}

	private function _getParent($entry)
	{
		$criteria = craft()->elements->getCriteria(ElementType::Entry);
		$criteria->section = $entry->section;
		$criteria->level = 1;
		$criteria->limit = 1;
		$entries = $criteria->find();

		if($entries)
		{
			return $entries[0];
		} else {
			return false;
		}
	}
}
