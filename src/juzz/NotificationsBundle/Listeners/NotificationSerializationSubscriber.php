<?php

namespace juzz\NotificationsBundle\Listeners;

use juzz\NotificationsBundle\Entity\Notificaciones AS Notification;
use JMS\Serializer\Annotation\PostSerialize;
use JMS\Serializer\EventDispatcher\EventSubscriberInterface;
use JMS\Serializer\EventDispatcher\ObjectEvent;
use JMS\Serializer\EventDispatcher\Event;

/**
* class NotificationSerializationSubscriber.
*/
class NotificationSerializationSubscriber implements EventSubscriberInterface
{
	
	private $em;
	private $serializer;

	public function __construct($em,$serializer){
		$this->em = $em;
		$this->serializer = $serializer;
	}


	public static function getSubscribedEvents()
	{
		return [
			[
				'event' => 'serializer.post_serialize',
				'class' => 'juzz\NotificationsBundle\Entity\Notificaciones',
				'method' => 'onPostSerialize'
			]
		];
	}

	/**
	 * @param AfterSerializeEvent
	 */

	public function onPostSerialize(Event $event)
	{
		$notification = $event->getObject();
		$objetive = $notification->getObjetive();
		switch ($notification->getType()) {
			case 'NEW_COMMENT':
			case 'REPLY_TO_COMMENT':
				$objetive = $this->em->getRepository("juzzCommentsBundle:Comentarios")->find($objetive);
				break;
			
			default:
				break;
		}
		$visitor = $event->getVisitor();
		//$this->serializer->serialize($objetive,'json');
		$visitor->addData('objetive',1);
	}
}