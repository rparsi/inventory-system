<?php

namespace Rahi\ApiBundle\EventListener;

use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FormEvent;
use Rahi\ApiBundle\Entity\Account\User;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class RegistrationListener implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [FOSUserEvents::REGISTRATION_SUCCESS => 'onRegistrationSuccess'];
    }

    public function onRegistrationSuccess(FormEvent $formEvent)
    {
        /** @var User $user */
        $user = $formEvent->getForm()->getData();
        if ($user->getId()) {
            return;
        }
        $user->setDefaultValues();
    }
}
