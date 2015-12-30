<?php

namespace Lthrt\ContactBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CountyStateType extends AbstractType
{

    private $options;
    private $stateRep;
    private $countyRep;


    public function __construct($em, $options) {
        $this->options = array_merge(
            [
                'county' => null,
                'state'  => null,
            ],
            $options
        );
        $this->stateRep = $em->getRepository('LthrtContactBundle:State');
        $this->countyRep = $em->getRepository('LthrtContactBundle:County');
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('county', 'county',
            [
                'data' => $this->options['county'],
                'query_builder' => $this->options['state']
                                    ? $this->countyRep->findByState($optiopns['state'])
                                    : $this->countyRep->findAll(),
            ]
        )
        ->add('state', 'state',
            [
                'data'          => $this->options['state'],
                'query_builder' => $this->options['county']
                                    ? $this->stateRep->findByCounty($options['county'])
                                    : $this->stateRep->findAll(),
            ]
        )
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
        ]);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'lthrt_contactbundle_countystate';
    }
}
