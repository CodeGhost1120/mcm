<?php

namespace Craft;

class Marathon_EventsService extends BaseApplicationComponent
{
	public function getUpcomingEvents()
	{
		$criteria = craft()->elements->getCriteria(ElementType::Entry);
		$criteria->section = 'events';
		$criteria->level = 0;
		$criteria->eventDate = ">" . date("Y-m-d H:i:s");
		$criteria->order = 'eventDate DESC';
		$criteria->limit = 100;
		$entries = $criteria->find();
		return $entries;
	}
}