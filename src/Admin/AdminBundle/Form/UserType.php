<?php

namespace Admin\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

//use Symfony\Component\Security\Core\SecurityContext;

class UserType extends AbstractType {
//    private $securityContext;
//
//    public function __construct(SecurityContext $securityContext) {
//        $this->securityContext = $securityContext;
//    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('username')
                ->add('email')
                ->add('enabled')
                ->add('translations', 'a2lix_translations', array(
                    'fields' => array(
                        'baseline' => array('attr' => array()),
                        'description' => array('attr' => array('class' => 'ckeditor form-control'))
                    )
                ))
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
                ->add('xingLink');

//        $User = $builder->getData();
//        $User = $this->securityContext->getToken()->getUser();
//        $builder->add('userGroups', 'entity', array(
//            'class' => 'UserUserBundle:UserGroup',
//            'query_builder' => function(EntityRepository $er) {
//                return $er->createQueryBuilder('ug')
//                                ->where('ug.name IN (:userGroupName)')
//                                ->setParameter('userGroupName', array('User', 'Group'));
//            }));
//        if ($this->securityContext->isGranted('ROLE_SUPER_ADMIN'))
//            $builder->add('userGroups', 'entity', array(
//                'class' => 'UserUserBundle:UserGroup',
//                'query_builder' => function(EntityRepository $er) {
//                    return $er->createQueryBuilder('ug')
//                                    ->where('ug.name IN (:userGroupName)')
//                                    ->setParameter('userGroupName', array('User', 'Group', 'Admin'));
//                }));
//        else
//            $builder->add('userGroups', 'entity', array(
//                'multiple' =>true,
//                'expanded' => true,
//                'class' => 'UserUserBundle:UserGroup',
//                'query_builder' => function(EntityRepository $er) {
//                    return $er->createQueryBuilder('ug')
//                                    ->where('ug.name IN (:userGroupName)')
//                                    ->setParameter('userGroupName', array('User', 'Group'));
//                }));
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
        return 'aab_user';
    }

}
