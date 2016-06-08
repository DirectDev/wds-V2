<?php

namespace User\UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use User\UserBundle\Entity\User;
use Front\FrontBundle\DataFixtures\ORM\FixturesDataTrait;

class LoadUserData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface {

    use FixturesDataTrait;

    /**
     * @var ContainerInterface
     */
    private $container;
    private $password = 1234;

    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null) {
        $this->container = $container;
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager) {
        $this->loadDancers($manager);
        $this->loadTeachers($manager);
        $this->loadArtits($manager);
        $this->loadBars($manager);
        $this->loadEmptyUser($manager);
        $this->loadFacebookUser($manager);
    }

    private function addMusicType(User $User) {
        $count = rand(0, count($this->array_musictype) - 1);
        for ($i = 0; $i < $count; $i++) {
            if (rand(0, 1))
                $User->addMusicType($this->getReference('musictype-' . $this->array_musictype[$i]));
        }
    }

    public function loadDancers(ObjectManager $manager) {

        foreach ($this->array_user_dancer as $value) {
            $User = new User();
            $User->setEnabled(true);
            $User->setUsername($value);
            $User->setPassword($this->password);
            $User->setEmail($value . '@yopmail.com');
            $User->addRole('ROLE_USER');
            $encoder = $this->container
                    ->get('security.encoder_factory')
                    ->getEncoder($User);
            $User->setPassword($encoder->encodePassword($this->password, $User->getSalt()));

            $this->setDetails($User, $value);

            $User->addUserType($this->getReference('usertype-dancer'));
            $this->addMusicType($User);
            $manager->persist($User);
            $User->mergeNewTranslations();
            $this->addReference('user-' . filter_var($value, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH), $User);
        }
        $manager->flush();
    }

    public function loadTeachers(ObjectManager $manager) {


        foreach ($this->array_user_teacher as $value) {
            $User = new User();
            $User->setEnabled(true);
            $User->setUsername($value);
            $User->setPassword($this->password);
            $User->setEmail(rand(0, 1000) . rand(0, 1000) . '@yopmail.com');
            $User->addRole('ROLE_USER');
            $encoder = $this->container
                    ->get('security.encoder_factory')
                    ->getEncoder($User);
            $User->setPassword($encoder->encodePassword($this->password, $User->getSalt()));

            $this->setDetails($User, $value);

            $User->addUserType($this->getReference('usertype-teacher'));
            $this->addMusicType($User);
            $manager->persist($User);
            $User->mergeNewTranslations();

            $this->addReference('user-' . filter_var($value, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH), $User);
        }
        $manager->flush();
    }

    public function loadArtits(ObjectManager $manager) {


        foreach ($this->array_user_artist as $value) {
            $User = new User();
            $User->setEnabled(true);
            $User->setUsername($value);
            $User->setPassword($this->password);
            $User->setEmail(rand(0, 1000) . rand(0, 1000) . '@yopmail.com');
            $User->addRole('ROLE_USER');
            $encoder = $this->container
                    ->get('security.encoder_factory')
                    ->getEncoder($User);
            $User->setPassword($encoder->encodePassword($this->password, $User->getSalt()));

            $this->setDetails($User, $value);

            $User->addUserType($this->getReference('usertype-artist'));
            $this->addMusicType($User);
            $manager->persist($User);
            $User->mergeNewTranslations();

            $this->addReference('user-' . filter_var($value, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH), $User);
        }
        $manager->flush();
    }

    public function loadBars(ObjectManager $manager) {

        foreach ($this->array_user_bar as $value) {
            $User = new User();
            $User->setEnabled(true);
            $User->setUsername($value);
            $User->setPassword($this->password);
            $User->setEmail(rand(0, 1000) . rand(0, 1000) . '@yopmail.com');
            $User->addRole('ROLE_USER');
            $encoder = $this->container
                    ->get('security.encoder_factory')
                    ->getEncoder($User);
            $User->setPassword($encoder->encodePassword($this->password, $User->getSalt()));

            $this->setDetails($User, $value);

            $User->addUserType($this->getReference('usertype-bar'));
            $this->addMusicType($User);
            $manager->persist($User);
            $User->mergeNewTranslations();

            $this->addReference('user-' . filter_var($value, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH), $User);
        }
        $manager->flush();
    }

    public function loadEmptyUser(ObjectManager $manager) {

        $value = 'empty-user';
        $User = new User();
        $User->setEnabled(true);
        $User->setUsername($value);
        $User->setPassword($this->password);
        $User->setEmail($value . '@yopmail.com');
        $User->addRole('ROLE_USER');
        $encoder = $this->container
                ->get('security.encoder_factory')
                ->getEncoder($User);
        $User->setPassword($encoder->encodePassword($this->password, $User->getSalt()));

        $manager->persist($User);

        $this->addReference('user-' . filter_var($value, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH), $User);
        $manager->flush();
    }
    
    public function loadFacebookUser(ObjectManager $manager) {

        $value = 'facebook-user';
        $User = new User();
        $User->setEnabled(true);
        $User->setUsername($value);
        $User->setPassword($this->password);
        $User->setEmail($value . '@yopmail.com');
        $User->addRole('ROLE_USER');
        $encoder = $this->container
                ->get('security.encoder_factory')
                ->getEncoder($User);
        $User->setPassword($encoder->encodePassword($this->password, $User->getSalt()));

        $manager->persist($User);

        $this->addReference('user-' . filter_var($value, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH), $User);
        $manager->flush();
    }

    private function setDetails(User $User, $value = null) {
        $locale = $this->array_locale[rand(0, 1)];
        if (rand(0, 1))
            $User->translate($locale)->setBaseline($this->array_baseline[rand(0, 19)]);
        if (rand(0, 1))
            $User->translate($locale)->setDescription($this->array_description[rand(0, 19)]);

        if (rand(0, 1))
            $User->setFacebookLink('http://link-to-' . $value);
        if (rand(0, 1))
            $User->setTwitterLink('http://link-to-' . $value);
        if (rand(0, 1))
            $User->setLinkedinLink('http://link-to-' . $value);
        if (rand(0, 1))
            $User->setGoogleLink('http://link-to-' . $value);
        if (rand(0, 1))
            $User->setFlickrLink('http://link-to-' . $value);
        if (rand(0, 1))
            $User->setTumblrLink('http://link-to-' . $value);
        if (rand(0, 1))
            $User->setInstagramLink('http://link-to-' . $value);
        if (rand(0, 1))
            $User->setYoutubeLink('http://link-to-' . $value);
        if (rand(0, 1))
            $User->setVimeoLink('http://link-to-' . $value);


        if (rand(0, 4))
            $User->setDisplayCounter(rand(100, 10000));
        if (rand(0, 4))
            $User->setFooter(true);
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder() {
        return 20;
    }

}
