<?php

namespace Front\FrontBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityRepository;
use Front\FrontBundle\Entity\Video;

class VideoFilterType extends AbstractType {

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
                ->add('tag', 'text', array(
                    'required' => false,
                    'attr' => array('placeholder' => "tag",)
                ))
                ->add('user', 'text', array(
                    'required' => false,
                    'attr' => array('placeholder' => "user",)
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
        return 'video_filter';
    }

}
