<?php
namespace Mesd\OrmedBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

abstract class DependentFixtureAbstract extends AbstractFixture implements OrderedFixtureInterface
{
    public function getOrder()
    {
        return $this::getDependentOrder();
    }

    public static function getDependentOrder()
    {
        return 1;
    }
}
