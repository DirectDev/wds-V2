<?php

namespace Front\FrontBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MusicTypeFrontFilterType extends AbstractType
{
     /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'entity', array(
                    'class' => 'FrontFrontBundle:MusicType',
                    'property' => 'title',
                    'multiple' => true,
                    'expanded' => true,
                    'by_reference' => true,
                ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Front\FrontBundle\Entity\MusicType'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'front_front_bundle_musictypefrontfilter';
    }
}
