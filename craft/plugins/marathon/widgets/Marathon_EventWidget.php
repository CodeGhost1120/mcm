<?php
	
namespace Craft;

class Marathon_EventWidget extends BaseWidget{
	
	public function getName()
	{
		return Craft::t('Upcoming Events');
	}
	
	public function getBodyHtml()
	{
		$events = craft()->marathon_events->getUpcomingEvents();

		return craft()->templates->render('marathon/_widgets/upcoming_events', array(
			'events' => $events
		));
	}
}