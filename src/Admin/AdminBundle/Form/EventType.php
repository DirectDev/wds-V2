<?php

namespace Admin\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EventType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('name')
                ->add('eventTypes')
                ->add('user')
                ->add('publishedBy')
                ->add('organizedBy')
                ->add('published')
                ->add('musicTypes', 'entity', array(
                    'class' => 'FrontFrontBundle:MusicType',
                    'property' => 'name',
                    'multiple' => true,
                    'expanded' => true,
                    'by_reference' => true,
                ))
                ->add('translations', 'a2lix_translations', array(
                    'fields' => array(
                        'title' => array('attr' => array()),
                        'description' => array('attr' => array('class' => 'ckeditor form-control'))
                    )
                ))
                ->add('facebookId')
                ->add('facebookLink')
                ->add('googleLink')
                ->add('twitterLink')
                ->add('linkedinLink')
                ->add('flickrLink')
                ->add('tumblrLink')
                ->add('instagramLink')
                ->add('vimeoLink')
                ->add('youtubeLink')
                ->add('baiduLink')
                ->add('xingLink')
                ->add('facebookPictureUrl')
                ->add('footer')


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
        return 'admin_adminbundle_event';
    }

}
