<?php

namespace BeerBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DeleteProducerConsoleCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('beer:deleteProducer')
            ->setDescription('Delete producer')
            ->setHelp('Delete producer. Format: beer:deleteProducer 10 (10 - producer ID)')
            ->addArgument('idProducer', InputArgument::REQUIRED, 'Input ID producer');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $result = $this->getContainer()->get('producer_manager')->deleteProducer($input->getArgument('idProducer'));

        if(!$result){
            $output->writeln('<error>Producer not found!</error>');
        }else{
            $output->writeln('<info>Producer successfully deleted.</info>');
        }
    }
}