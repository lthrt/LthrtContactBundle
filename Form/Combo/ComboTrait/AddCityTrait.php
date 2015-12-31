<?php

namespace Lthrt\ContactBundle\Form\Combo\ComboTrait;


trait AddCityTrait
{
    private function addCity($formOrBuilder)
    {
        $cities = $this->options['state']
                    ? $this->cityRep->findByStateAbbr($this->options['state']->getAbbr())
                    : (
                        $this->options['county']
                        ? $this->cityRep->findByCounty($this->options['county'])
                        : $this->cityRep->findNames()
                    );
        $cities = $cities->getQuery()->getResult();
        // Doctrine returns an array of array for select
        // so transform to choice list
        $cities = array_flip(array_map(function ($city) {return $city['name'];}, $cities));
        foreach ($cities as $name => $value) {
            $cities[$name] = $name;
        }

        $formOrBuilder->add('city', 'city',
            [
                'data'              => $this->options['city'] ? $this->options['city'] : '',
                'choices'           => $cities,
                'choices_as_values' => true,
            ]
        );
    }
}
