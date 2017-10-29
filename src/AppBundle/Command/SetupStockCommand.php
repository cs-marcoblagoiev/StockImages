<?php

namespace AppBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SetupStockCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('app:setup-stock')
            ->setDescription('Grabs all the local stock images and creates a Stock entity for each one.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Command result.');
    }

}
