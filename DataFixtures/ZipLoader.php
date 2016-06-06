<?php
namespace Lthrt\ContactBundle\DataFixtures;

use Lthrt\ContactBundle\DataFixtures\DataTrait\StatesTrait;
use Lthrt\ContactBundle\DataFixtures\DataTrait\ZipsTrait;
use Lthrt\ContactBundle\Entity\City;
use Lthrt\ContactBundle\Entity\County;
use Lthrt\ContactBundle\Entity\Zip;

class ZipLoader extends StatesLoader
{
    use ZipsTrait;
    use StatesTrait;

    private $output;

    // because of length, source array at end of class

    public function __construct($em)
    {
        parent::__construct($em);
        $this->em = $em;

        // initialize via file load
        // after this method or field return result without reparsing csv
        $this->getZips();

        // initialize via file load
        // after this method or field return result without reparsing csv
        $this->getStates();
    }

    public function loadZips($overwrite = false)
    {
        $this->em->getConnection()->getConfiguration()->setSQLLogger(null);

        $dbStates = $this->em->getRepository('LthrtContactBundle:State')
            ->createQueryBuilder('state', 'state.abbr')
            ->getQuery()->getResult();

        if (0 == count($dbStates)) {
            return ['noStates' => true];
        }

        $result['cities']   = 0;
        $result['zips']     = 0;
        $result['counties'] = 0;

        $importZips = $this->zips;

        $dbCities = $this->em->getRepository('LthrtContactBundle:City')
            ->createQueryBuilder('city')->join('city.state', 'state')
            ->addSelect('state')->getQuery()->getResult();

        $dbCounties = $this->em->getRepository('LthrtContactBundle:County')
            ->createQueryBuilder('county')->getQuery()->getResult();

        $dbZips = $this->em->getRepository('LthrtContactBundle:Zip')
            ->createQueryBuilder('zip', 'zip.zip')->getQuery()->getResult();

        $cities   = [];
        $counties = [];

        array_walk(
            $dbCities,
            function ($c) use (&$cities) {
                $cities[$c->name . "__" . $c->state->abbr] = $c;
            }
        );
        unset($dbCities);

        array_walk(
            $dbCounties,
            function ($c) use (&$counties) {
                $counties[$c->name . "__" . $c->state->first()->abbr] = $c;
            }
        );
        unset($dbCounties);

        foreach ($importZips as $key => $zipRef) {
            if ('header' == $key) {
                continue;
            }

            if (!$zipRef['county']) {
                continue;
            }

            if (isset($dbStates[$zipRef['state']])) {
                $state = $dbStates[$zipRef['state']];
            } else {
                // if zip has miscoded state reference,
                // don't add new
                continue;
            }

            if (isset($cities[$zipRef['city'] . '__' . $zipRef['state']])) {
                $city = $cities[$zipRef['city'] . '__' . $zipRef['state']];
            } else {
                $city                                          = new City();
                $city->name                                    = $zipRef['city'];
                $cities[$city->name . '__' . $zipRef['state']]     = $city;
                ++$result['cities'];
            }

            if (isset($counties[$zipRef['county'] . '__' . $zipRef['state']])) {
                $county = $counties[$zipRef['county'] . '__' . $zipRef['state']];
            } else {
                $county = new County();
                if ($zipRef['county']) {
                    $county->name = $zipRef['county'];
                } else {
                    $county->name = strtoupper($zipRef['city']) . '_' . strtoupper($zipRef['state']) . '_' . $key;
                }
                $counties[$county->name . '__' . $zipRef['state']] = $county;
                ++$result['counties'];
            }

            if (isset($dbZips[$key])) {
                $zip = $dbZips[$key];
            } else {
                $zip               = new Zip();
                $zip->zip          = $key;
                $dbZips[$zip->zip] = $zip;
                ++$result['zips'];
            }

            $zip->addCounty($counties[$county->name . '__' . $state->abbr]);
            $zip->addCity($cities[$city->name . '__' . $state->abbr]);
            $zip->addState($state);
            $zip->updatedBy = "DataFixtures";

            $city->state = $state;
            $city->addCounty($county);
            $city->updatedBy = "DataFixtures";

            $county->addState($state);
            $county->addCity($city);
            $county->updatedBy = "DataFixtures";

            $this->em->persist($county);
            $this->em->persist($city);
            $this->em->persist($zip);
            $this->em->flush($county);
            $this->em->flush($city);
            $this->em->flush($zip);
        }

        return $result;
    }
}
