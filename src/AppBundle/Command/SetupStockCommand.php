<?php

namespace AppBundle\Command;

use AppBundle\Entity\Stock;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SetupStockCommand extends Command
{
    /**
     * @var EntityManagerInterface
     */
    private $em;
    private $rootDir;

    public function __construct($rootDir, EntityManagerInterface $em)
    {
        parent::__construct();

        $this->rootDir = $rootDir;
        $this->em = $em;
    }


    protected function configure()
    {
        $this
            ->setName('app:setup-stock')
            ->setDescription('Grabs all the local stock images and creates a Stock entity for each one.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $stockImages = glob($this->rootDir . '/../web/images/*.*');

        foreach ($stockImages as $image){

            $img = (new Stock())
                ->setFilename($image)
                ->setSlug($image)
                ->setWidth(1920)
                ->setHeight(1080)
            ;

            $this->em->persist($img);
        }

        $this->em->flush();

        $output->writeln('Command result.');
    }

}
