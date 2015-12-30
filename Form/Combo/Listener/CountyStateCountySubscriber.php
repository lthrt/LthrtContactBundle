<?php

namespace Lthrt\ContactBundle\Form\Combo\Listener;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class CountyStateCountySubscriber implements EventSubscriberInterface
{
    private $countyRep;

    public function __construct($countyRep) {
        $this->countyRep = $countyRep;
    }

    public static function getSubscribedEvents()
    {
        // Tells the dispatcher that you want to listen on the form.pre_set_data
        // event and that the preSetData method should be called.
        return array(FormEvents::POST_SUBMIT => 'postSubmit');
    }

    public function postSubmitData(FormEvent $event)
    {
        $state = $event->getData();
        $form = $event->getForm();

        $counties = $this->countyRep->findByState($state->getAbbr());

        $form->remove('county');
        $form->add('county', 'county',
            [
                'data'              => $this->options['county']?$this->options['county']->getName():'',
                'choices'           => $counties,
            ]
        )
        ;
    }
}