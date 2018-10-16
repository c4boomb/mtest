<?php

namespace App\Command;

use App\Contract\CombinationsGeneratorInterface;
use Symfony\Component\Console\{Command\Command, Input\InputArgument, Input\InputInterface, Output\OutputInterface};

/**
 * Class GenerateCommand
 * @package App\Command
 */
class GenerateCommand extends Command
{
    /**
     * @var CombinationsGeneratorInterface
     */
    private $combinationsGenerator;

    /**
     * GenerateCommand constructor
     *
     * @param CombinationsGeneratorInterface $combinationsGenerator
     * @param string $name
     */
    public function __construct(CombinationsGeneratorInterface $combinationsGenerator, string $name = '')
    {
        parent::__construct($name);

        $this->combinationsGenerator = $combinationsGenerator;
    }

    /**
     * Configure command
     */
    protected function configure()
    {
        $this->setDescription('Generates all possible combinations for inputed chars')
            ->addArgument('file', InputArgument::REQUIRED, 'File to read input from')
            ->setHelp("File should contain <comment>max combination length on first line</comment> and <comment>all possible items for combinations separated by <info>comma</info> on the second line.</comment>
            <comment>Check exampleInput.txt</comment>
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

            $maxLength = (int)fgets($filePointer);
            $possibleSymbols = explode(',', trim(fgets($filePointer)));

            $result = $this->combinationsGenerator->generate($possibleSymbols, $maxLength);

            $output->writeln(
                implode(', ', $result)
            );
        }
    }
}