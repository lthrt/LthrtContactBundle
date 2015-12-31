<?php

namespace Lthrt\ContactBundle\Form\Combo\ComboTrait;


trait AddStateTrait
{
    private function addState($formOrBuilder)
    {
        $formOrBuilder->add('state', 'state',
            [
                'data'          => $this->options['state'],
                'query_builder' => $this->options['county']
                                    ? $this->stateRep->findByCounty($this->options['county'])
                                    : (
                                        $this->options['city']
                                        ? $this->stateRep->findByCity($this->options['city'])
                                        : $this->stateRep->findAll()
                                    ),
            ]
        );
    }
}
