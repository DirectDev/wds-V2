<?php

namespace Front\FrontBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityRepository;
use Front\FrontBundle\Entity\Music;

class MusicFilterType extends AbstractType {

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
                ->add('tag', 'hidden', array(
                    'required' => false,
                ))
                ->add('user', 'hidden', array(
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
        return 'music_filter';
    }

}
