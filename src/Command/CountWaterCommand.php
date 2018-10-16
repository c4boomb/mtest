<?php

namespace App\Command;

use App\Contract\WaterCounterInterface;
use Symfony\Component\Console\{Command\Command, Input\InputArgument, Input\InputInterface, Output\OutputInterface};

/**
 * Class CountWaterCommand
 * @package App\Command
 */
class CountWaterCommand extends Command
{
    /**
     * @var WaterCounterInterface
     */
    private $waterCounter;

    /**
     * GenerateCommand constructor
     *
     * @param WaterCounterInterface $waterCounter
     * @param string $name
     */
    public function __construct(WaterCounterInterface $waterCounter, string $name = '')
    {
        parent::__construct($name);

        $this->waterCounter = $waterCounter;
    }

    /**
     * Set configurations for command
     */
    protected function configure()
    {
        $this->setDescription('Counts water between walls')
            ->addArgument('file', InputArgument::REQUIRED, 'File to read input from')
            ->setHelp("File should contain one line with numbers separated by <comment>comma</comment>  that represent wall height
            <comment>Check exampleInput2.txt</comment>
            ");
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $file = $input->getArgument('file');

        $output->writeln(sprintf(
            '<comment>Reading file (%s)...</comment>',
            $file
        ));

        if (file_exists($file)) {
            $filePointer = fopen($file, 'r');

            $heights = explode(',', fgets($filePointer));
            array_map(function ($item) {
                return (int)$item;
            }, $heights);

            $result = $this->waterCounter->getTotalWater($heights);

            $output->writeln($result);
        }
    }
}