<?php

namespace Front\FrontBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityRepository;
use Front\FrontBundle\Entity\Event;
use User\UserBundle\Entity\User;

class EventFilterType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('search', 'text', array(
                    'required' => false,
                    'attr' => array('placeholder' => "Texte",)
                ))
                ->add('musictype', 'hidden', array(
                    'required' => false,
                ))
                ->add('eventtype', 'hidden', array(
                    'required' => false,
                ))

        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array());
    }

    /**
     * @return string
     */
    public function getName() {
        return 'event_filter';
    }

}
