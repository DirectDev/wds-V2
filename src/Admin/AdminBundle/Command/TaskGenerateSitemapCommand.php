<?php

namespace Admin\AdminBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

class TaskGenerateSitemapCommand extends ContainerAwareCommand {

    protected function configure() {
        $this
                ->setName('task:generateSitemap')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $output->writeln('<comment>Running Task Generate Sitemap...</comment>');

        $sitemapservices = $this->getContainer()->get('sitemap.services');
        $sitemapservices->generate();

        $output->writeln('<comment>Task done!</comment>');
    }

}
