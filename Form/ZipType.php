<?php

namespace Lthrt\ContactBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ZipType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('zip')
            ->add('active')
            ->add('created')
            ->add('updated')
            ->add('city')
            ->add('county')
            ->add('state')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function configureOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Lthrt\ContactBundle\Entity\Zip'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'lthrt_contactbundle_zip';
    }
}
