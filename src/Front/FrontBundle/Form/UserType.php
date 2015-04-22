<?php

namespace Front\FrontBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class UserType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $locales = array('en');
        if(isset($options['attr']['locale']))
                $locales[] = $options['attr']['locale'];
        
        $builder
                ->add('username')
                ->add('translations', 'a2lix_translations', array(
                'locales' => $locales,      
                'fields' => array(
                    'description_short' => array('attr' => array('class' => 'ckeditor form-control')),
                    'description' => array('attr' => array('class' => 'ckeditor form-control')),
                    'baseline' => array(),
                )))
                ->add('userTypes', 'entity', array(
                    'class' => 'UserUserBundle:UserType',
                    'property' => 'title',
                    'multiple' => true,
                    'expanded' => true,
                    'by_reference' => true,
                ))
                ->add('musicTypes', 'entity', array(
                    'class' => 'FrontFrontBundle:MusicType',
                    'property' => 'title',
                    'multiple' => true,
                    'expanded' => true,
                    'by_reference' => true,
                ))
                ->add('facebook_link')
                ->add('google_link')
                ->add('twitter_link')
                ->add('linkedin_link')
                ->add('flickr_link')
                ->add('tumblr_link')
                ->add('vimeo_link')
                ->add('instagram_link')
                ;
                
//                ->add('addresses', 'collection', array(
//                    'type' => new AddressType(),
//                    'by_reference' => false,
//                    'allow_add' => true,
//                    'allow_delete' => true,
//                    'required' => false,
//                    'label' => /** @Ignore */ false
//                        )
//        );
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'User\UserBundle\Entity\User'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'front_frontbundle_user';
    }

}
