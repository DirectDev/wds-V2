<?php

namespace Admin\AdminBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Front\FrontBundle\Services\FacebookServices;
use User\UserBundle\Entity\User;

class TaskSearchFacebookEventsByCityCommand extends ContainerAwareCommand {
    private $em;

    protected function configure() {
        $this
            ->setName('task:searchFacebookEventsByCity')
            ->setDescription('search facebook events by city')
            ->addArgument(
                'limitation',
                InputArgument::OPTIONAL,
                'taille du lot'
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $output->writeln('<comment>Running Task...</comment>');

        $this->em = $this->getContainer()->get('doctrine')->getManager();

        // travail par lot de 1
        $tailleLot = 1;
        if ($input->getArgument('limitation')) {
            $tailleLot = $input->getArgument('limitation');
        }

        $city = $this->em->getRepository('FrontFrontBundle:City')->findOneBy(array('big' => true), array('lastImportEvents' => 'ASC'));

        if(!$city->getLatitude() or !$city->getLongitude())
            $this->setLatitudeAndLongitude ($city);

        $city->setLastImportEvents(new \DateTime());
        $this->em->persist($city);

        $this->em->flush();
        
        $output->writeln('<comment>City : '.$city->getName().'</comment>');

        $facebookServices = $this->getContainer()->get('admin.facebook.services');
        $facebook_events  = $facebookServices->searchEventsByCity($city->getName());

        if($facebook_events)
            foreach($facebook_events as $name)
                $output->writeln('<comment>event : '.$name.'</comment>');

        $city->setLastImportEvents(new \DateTime());
        $this->em->persist($city);

        $this->em->flush();

        $output->writeln('<comment>Task done!</comment>');
    }

    private function setLatitudeAndLongitude($city = null) {
        if (!$city)
            return;
        try {
            $geocodeAddresses = $this->getContainer()
                    ->get('bazinga_geocoder.geocoder')
                    ->using('google_maps')
                    ->geocode($city->getName());
            if (!count($geocodeAddresses))
                return;

            foreach ($geocodeAddresses as $geocodeAddress) {
                $city->setLatitude($geocodeAddress->getLatitude());
                $city->setLongitude($geocodeAddress->getLongitude());
                return;
            }
        } catch (\Exception $e) {
            throw $e;
        }
    }
}