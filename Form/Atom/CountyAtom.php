<?php

namespace Lthrt\ContactBundle\Form\Atom;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CountyAtom extends AbstractType
{
    private $em;
    private $tokenStorage;

    public function __construct($em, $tokenStorage)
    {
        $this->em           = $em;
        $this->tokenStorage = $tokenStorage;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
    }

    /**
     * @param object $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            [
                'class'        => 'LthrtContactBundle:County',
                'label'        => 'County',
                'placeholder'  => '',
                'choice_label' => 'name',
            ]
        );
    }

    public function getParent()
    {
        return 'entity';
    }

    /**
     * @return unknown
     */
    public function getName()
    {
        return 'county';
    }
}
