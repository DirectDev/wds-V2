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
                ->add('event', 'entity', array(
                    'class' => 'FrontFrontBundle:Event',
                    'property' => 'name',
                    'multiple' => false,
                    'expanded' => false,
                    'by_reference' => true,
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
        return 'admin_adminbundle_eventdate';
    }

}
