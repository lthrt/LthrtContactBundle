<?php

namespace Lthrt\ContactBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PersonType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(
        FormBuilderInterface $builder,
        array                $options
    ) {
        $builder
            ->add('firstName')
            ->add('lastName')
            ->add('dob')
            ->add('active')
            ->add('contact')
            ->add('demographic', null,
                [
                    'expanded'      => true,
                    'query_builder' => function (EntityRepository $rep) {
                        return $rep->getOrderedTypes();
                    },
                    'choice_label'  => 'value',
                    'label'         => 'Demographic',
                    'group_by'      => function (
                        $val,
                        $key,
                        $index
                    ) {
                        return $val->getType()->getName();
                    },
                ]
            )
            ->add('address');
    }

/**
 * @param OptionsResolverInterface $resolver
 */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'Lthrt\ContactBundle\Entity\Person',
        ]);
    }

/**
 * @return string
 */
    public function getName()
    {
        return 'lthrt_contactbundle_person';
    }
}
