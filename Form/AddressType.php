<?php

namespace Lthrt\ContactBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AddressType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('line', null, ['required' => false])
            ->add('line2', null, ['required' => false])
            ->add('zip', null, ['required' => false])
            ->add('addressType')
            ->add('city')
            ->add('state');
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'Lthrt\ContactBundle\Entity\Address',
        ]);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'lthrt_contactbundle_address';
    }
}
