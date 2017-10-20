<?php

namespace TestBundle\Form\EventListener;

use Doctrine\ORM\EntityManager;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use TestBundle\Entity\City;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AddUserListener
 *
 * @author ameni
 */
class AddUserListener implements EventSubscriberInterface {

    protected $entityManager;

    public function __construct(EntityManager $entityManager) {

        $this->entityManager = $entityManager;
    }

    public static function getSubscribedEvents() {
        return array(
            FormEvents::POST_SUBMIT => 'onPostSubmit',
        );
    }

    public function onPostSubmit(FormEvent $event) {

        $person = $event->getData();
        $form = $event->getForm();

        // Check whether the user from the initial data has chosen to
        // display his email or not.
        if ($form->isValid()) {
            $city = new City();
            $city->setName($person->getCity());
            $this->entityManager->persist($city);
        }
    }

}
