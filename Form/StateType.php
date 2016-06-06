<?php

namespace Lthrt\ContactBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StateType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('abbr')
            ->add('active')
            ->add('created')
            ->add('updated')
            ->add('name')
            ->add('county')
            ->add('zip');
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'Lthrt\ContactBundle\Entity\State',
        ]);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'lthrt_contactbundle_state';
    }
}
