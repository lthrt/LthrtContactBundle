<?php

namespace Lthrt\ContactBundle\Form\Combo;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Lthrt\ContactBundle\Form\Combo\Listener\CountyStateCountySubscriber;

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
        $counties = $this->options['state']
                    ? $this->countyRep->findByStateAbbr($this->options['state']->getAbbr())
                    : $this->countyRep->findNames();

        $counties = $counties->getQuery()->getResult();
        // Doctrine returns an array of array for select
        // so transform to choice list
        $counties = array_map(function($county){return $county['name'];},$counties);

        $builder
        ->add('county', 'county',
            [
                'data'              => $this->options['county']?$this->options['county']->getName():'',
                'choices'           => $counties,
            ]
        )
        ->add('state', 'state',
            [
                'data'          => $this->options['state'],
                'query_builder' => $this->options['county']
                                    ? $this->stateRep->findByCounty($options['county']->getName())
                                    : $this->stateRep->findAll(),
            ]
        )
        ;
        $builder->get('county')->addEventSubscriber(new CountyStateCountySubscriber($this->countyRep));
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
