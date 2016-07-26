<?php

namespace User\UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use User\UserBundle\Entity\User;
use Front\FrontBundle\DataFixtures\ORM\FixturesDataTrait;

class LoadLoveData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface {

    use FixturesDataTrait;

    /**
     * @var ContainerInterface
     */
    private $container;

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
        
        if ($this->container->get('kernel')->getEnvironment() == 'prod')
            return;

        $count_users = count($this->array_user);
        foreach ($this->array_user as $value) {

            $User = $this->getReference('user-' . filter_var($value, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH));

            $count = rand(0, 20);
            if (rand(0, 3))
                for ($i = 0; $i < $count; $i++) {
                    $second_user_reference = $this->array_user[rand(0, count($this->array_user) - 1)];
                    $secondUser = $this->getReference('user-' . filter_var($second_user_reference, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH));
                    if ($second_user_reference != $value && !$User->getLovesMe()->contains($secondUser))
                        $User->addLovesMe($secondUser);
                }

            $manager->persist($User);
        }
        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder() {
        return 26;
    }

}
