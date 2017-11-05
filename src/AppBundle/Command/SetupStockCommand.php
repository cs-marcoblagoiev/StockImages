<?php

namespace AppBundle\Command;

use AppBundle\Entity\Stock;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

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
        $io = new SymfonyStyle($input, $output);

        $stockImages = glob($this->rootDir . '/../web/images/*.*');
        $imageCount = count($stockImages);

        $io->title('Importing Images');
        $io->progressStart($imageCount);

        $fileNames = [];

        foreach ($stockImages as $image){

            [
                'basename' => $filename,
                'filename' => $slug,
            ] = pathinfo($image);

            [
                0 => $width,
                1 => $height,
            ] = getimagesize($image);

            $img = (new Stock())
                ->setFilename($filename)
                ->setSlug($slug)
                ->setWidth($width)
                ->setHeight($height)
            ;

            $this->em->persist($img);

            $io->progressAdvance();

            $fileNames[] = [$filename];
        }

        $this->em->flush();

        $io->progressFinish();

        $table = new Table($output);
        $table
            ->setHeaders(['Filename'])
            ->setRows($fileNames);

        $table->render();

        $io->success(sprintf('Added %d images', $imageCount));
    }

}
