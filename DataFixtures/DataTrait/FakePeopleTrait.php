<?php

namespace Lthrt\ContactBundle\DataFixtures\DataTrait;

//
// Zips Trait.
//


trait FakePeopleTrait
{
    private $people;

    public function getPeople()
    {
        if (!$this->people) {
            $file                   = __DIR__ . "/../Data/fakePeople.csv";
            $csv                    = fopen($file, 'r');
            $this->people['header'] = array_flip(fgetcsv($csv));
            while ($dataRow = fgetcsv($csv)) {
                if (
                    isset($dataRow[$this->people['header']['last']])
                    && isset($dataRow[$this->people['header']['first']])
                    && isset($dataRow[$this->people['header']['dob']])
                ) {
                    $last = $dataRow[$this->people['header']['last']];
                    $first = $dataRow[$this->people['header']['first']];
                    $dob = $dataRow[$this->people['header']['dob']];

                    $this->people[$last][$first] = new \DateTime($dob);
                }

            }
        }

        return $this->people;
    }
}
