<?php

namespace Lthrt\ContactBundle\DataFixtures\DataTrait;

//
// Zips Trait.
//


trait DataTypesTrait
{
    private $addressType =
    [
        "work",
        "home",
    ];

    private $contactType =
    [
        "work",
        "home",
        "cell",
        "email",
    ];

    private $demographicType =
    [
        "race",
        "gender",
        "ethnicity",
    ];
}
