<?php

namespace Front\FrontBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EventDateType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder
                ->add('startdate', 'date', array(
                    'widget' => 'single_text',
                    'input' => 'datetime',
                    'format' => 'yyyy-MM-dd', // bug avec les heures
                    'attr' => array('class' => 'datepicker')
                ))
                ->add('starttime', 'time', array(
                    'input' => 'datetime',
                    'widget' => 'choice',
                    'with_seconds' => false
                ))
                ->add('stopdate', 'date', array(
                    'widget' => 'single_text',
                    'input' => 'datetime',
                    'required' => false,
                    'format' => 'yyyy-MM-dd', // bug avec les heures
                    'attr' => array('class' => 'datepicker')
                ))
                ->add('stoptime', 'time', array(
                    'input' => 'datetime',
                    'widget' => 'choice',
                    'with_seconds' => false,
                    'required' => false,
                ))

        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Front\FrontBundle\Entity\EventDate'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'ffed';
    }

}
