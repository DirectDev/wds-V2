<?php

namespace Front\FrontBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Front\FrontBundle\Entity\Address;
use Doctrine\ORM\EntityRepository;

class EventDescriptionType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     *  
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $locales = array('en');
        if (isset($options['attr']['locale']))
            $locales[] = $options['attr']['locale'];

        $builder
                ->add('eventTypes', 'entity', array(
                    'class' => 'FrontFrontBundle:EventType',
                    'property' => 'name',
                    'multiple' => true,
                    'expanded' => true,
                    'by_reference' => true,
                ))
                ->add('musicTypes', 'entity', array(
                    'class' => 'FrontFrontBundle:MusicType',
                    'property' => 'name',
                    'multiple' => true,
                    'expanded' => true,
                    'by_reference' => true,
                ))
                ->add('translations', 'a2lix_translations', array(
                    'locales' => $locales,
                    'fields' => array(
                        'title' => array('attr' => array('required' => true)),
                        'description' => array('attr' => array('class' => 'ckeditor form-control'))
                    )
                ))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Front\FrontBundle\Entity\Event'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'front_frontbundle_event_description';
    }

}
