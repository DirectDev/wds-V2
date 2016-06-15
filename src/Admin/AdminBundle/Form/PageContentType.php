<?php

namespace Admin\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PageContentType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('position')
            ->add('page', 'entity', array(
                'class' => 'AdminAdminBundle:Page',
                'property' => 'name',
                'multiple' => false,
                'expanded' => false,
                'by_reference' => true,
            ))
            ->add('translations', 'a2lix_translations', array(
                'fields' => array(
                    'content' => array('attr' => array('class' => 'ckeditor form-control'))
                )
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Admin\AdminBundle\Entity\PageContent'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'aab_pagecontent';
    }
}
