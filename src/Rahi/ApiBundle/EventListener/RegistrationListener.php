<?php

namespace Rahi\ApiBundle\EventListener;

use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FormEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class RegistrationListener implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [FOSUserEvents::REGISTRATION_SUCCESS => 'onRegistrationSuccess'];
    }

    public function onRegistrationSuccess(FormEvent $formEvent)
    {
        $user = $formEvent->getForm()->getData();
        if ($user->getId()) {
            return;
        }
        $user->setDefaultValues();
    }
}
