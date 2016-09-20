<?php

namespace Front\FrontBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class VideoType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $locales = array('en');
        if (isset($options['attr']['locale']))
            $locales[] = $options['attr']['locale'];

        $builder
                ->add('translations', 'a2lix_translations', array(
                    'locales' => $locales,
                    'fields' => array(
                        'title' => array('attr' => array('required' => true)),
                    )
                ))
                ->add('url')
                ->add('move')
                ->add('tags', 'entity', array(
                    'class' => 'FrontFrontBundle:Tag',
                    'property' => 'title',
                    'multiple' => true,
                    'expanded' => true,
                    'by_reference' => false,
                    'required' => false,
                    'label_attr' => array('class' => 'checkbox-inline')
                ))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Front\FrontBundle\Entity\Video'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'ffv';
    }

}
