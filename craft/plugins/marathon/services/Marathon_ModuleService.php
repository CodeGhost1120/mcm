<?php

namespace Craft;

class Marathon_ModuleService extends BaseApplicationComponent
{

	

	//Service to get entry content for a module block
	public function getEntryData($block, $mode, $count)
	{

		$cache_key = md5('entry_module'.$block->id.$count);
		$cache = craft()->cache->get($cache_key);
		$cache = false;
		if(! $cache)
		{
			$blurb_text = '';
			$blurb_link = '';
			$blurb_link_text = '';
			$blurb_title = '';
			$image = null;

		
			$blurb_text = $this->getBlurbText($block, $count);
			$blurb_link = $this->getBlurbLink($block, $count);
			$blurb_link_text = $this->getBlurbLinkText($block, $count);
			$blurb_title = $this->getBlurbTitle($block, $count);
			$image = $this->getBlockImage($block, $count);

			$data = array(
				'blurb_text' => $blurb_text,
				'blurb_link' => $blurb_link,
				'blurb_link_text' => $blurb_link_text,
				'blurb_title' => $blurb_title,
				'image' => $image
			);

			craft()->cache->set($cache_key, $data, 3600);
			return $data;
		} else {
			return $cache;
		}
	}

	private function getBlurbText($block, $count)
	{
		$field = "linkedEntryBlurb_$count";

		if($block->$field != '')
		{
			$blurb_text = $block->$field;
		} else {
			//If no override, use linked entry, if it exists
			$field = "linkedEntry_$count";
			$linked_entry = $block->$field;
			if(count($linked_entry))
			{
				$blurb_text = $linked_entry[0]->entryBlurb;
			} else {
				$blurb_text = '';
			}
		}

		return $blurb_text;
	}

	private function getBlurbLink($block, $count)
	{
		$field = "linkedEntryLink_$count";

		if($block->$field != '')
		{
			$blurb_link = $block->$field;
		} else {
			//If no override, use linked entry, if it exists
			$field = "linkedEntry_$count";
			$linked_entry = $block->$field;
			if(count($linked_entry))
			{
				$blurb_link = $linked_entry[0]->url;
			} else {
				$blurb_link = '#';
			}
		}

		return $blurb_link;
	}

	private function getBlurbLinkText($block, $count)
	{
		$field = "linkedEntryLinkText_$count";

		if($block->$field != '')
		{
			$blurb_link_text = $block->$field;
		} else {
			$blurb_link_text = 'Read more';
		}

		return $blurb_link_text;
	}

	private function getBlurbTitle($block, $count)
	{
		$field = "linkedEntryTitle_$count";
		$blurb_link_title = '';
		if(isset($block->$field))
		{
			if($block->$field != '')
			{
				$blurb_link_title = $block->$field;
			} else {
				$field = "linkedEntry_$count";
				$linked_entry = $block->$field;
				if(count($linked_entry))
				{
					$blurb_link_title = $linked_entry[0]->title;
				} else {
					$blurb_link_title = '';
				}
			}
		}

		

		return $blurb_link_title;
	}

	private function getBlockImage($block, $count)
	{
		$field = "linkedEntryImage_$count";
		$image = null;
		if(isset($block->$field)){
			if(count($block->$field))
			{
				$image = $block->$field;
				$image = $image[0];
			} else {
				$field = "linkedEntry_$count";
				$linked_entry = $block->$field;
				if(count($linked_entry))
				{
					$image = $linked_entry[0]->featureImage;
					if(count($image))
					{
						$image = $image[0];
					} else {
						$image = null;
					}
				} else {
					$image = null;
				}
			}
		}
		

		return $image;
	}

}