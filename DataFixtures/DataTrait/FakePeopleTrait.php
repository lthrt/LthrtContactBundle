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
            var_dump(__LINE__);
            while ($dataRow = fgetcsv($csv)) {
            var_dump(__LINE__);
            if (
                isset($this->people['header']['last'])
                && isset($this->people['header']['first'])
                && isset($this->people['header']['dob'])
                ) {
                    $this->people[
                        $dataRow[
                            $this->people['header']['last']
                        ]
                        .'__'
                        .$dataRow[
                            $this->people['header']['first']
                        ]
                    ] = $dataRow[$this->people['header']['dob']];
                }
            }
        }
        var_dump(__LINE__);

        return $this->people;
    }
}
