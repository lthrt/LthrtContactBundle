<?php
namespace Lthrt\ContactBundle\DataFixtures;

use Lthrt\ContactBundle\DataFixtures\DataTrait\DataTypesTrait;

class DataTypesLoader
{
    use DataTypesTrait;

    // because of length, source array at end of class

    private $em;

    public function __construct($em)
    {
        $this->em = $em;
    }

    public function loadDataTypes($overwrite = false)
    {
        foreach (['address', 'contact', 'demographic'] as $types) {
            $dataType           = $types . "Type";
            $dataTypes          = $dataType . "s";
            $upperDataType      = ucfirst($dataType);
            $namespacedDataType = 'Lthrt\\ContactBundle\\Entity\\' . $upperDataType;
            foreach ($this->$dataType as $type) {
                $rep = $this->em->getRepository('LthrtContactBundle:' . $upperDataType);
                if ($rep->findByName($type)) {
                    if ($overwrite) {
                        $result['updatedTypes'][$upperDataType . "/" . $type] = $type;
                    } else {
                        $result['existingTypes'][$upperDataType . "/" . $type] = $type;
                    }
                } else {
                    $result['newTypes'][$upperDataType . "/" . $type] = $type;

                    $entity       = new $namespacedDataType();
                    $entity->name = $type;
                    $this->em->persist($entity);
                }
            }
        }

        $this->em->flush();

        return $result;
    }
}
