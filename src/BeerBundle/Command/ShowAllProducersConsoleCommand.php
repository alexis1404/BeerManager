<?php

namespace BeerBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ShowAllProducersConsoleCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('beer:showAllProducers')
            ->setDescription('Show all producers (suddenly :))')
            ->setHelp('');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $allProducers = $this->getContainer()->get('producer_manager')->getAllProducers();

        foreach($allProducers as $value){
            $output->writeln('<info>'. $value->getName() . ' ID: '. $value->getId() . '</info>');
        }
    }
}