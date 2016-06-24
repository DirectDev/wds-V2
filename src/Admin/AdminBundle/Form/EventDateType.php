<?php

namespace Admin\AdminBundle\Form;

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
                ->add('startdate')
                ->add('starttime')
                ->add('stopdate')
                ->add('stoptime')
                ->add('events', 'entity', array(
                    'class' => 'FrontFrontBundle:Event',
                    'property' => 'title',
                    'multiple' => true,
                    'expanded' => false,
                    'by_reference' => true,
                    'required' => true,
                    'empty_value' => '',
                    'empty_data' => null
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
        return 'aab_eventdate';
    }

}
