<?php

namespace BeerBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

class CreateNewProducerConsoleCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('beer:createNewProducer')
            ->setDescription('Create new beer-producer')
            ->setHelp('It creates a produced with the specified parameters (unique name)');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln([
            'Start create producer:',
            '============',
            '',
        ]);

        $helper = $this->getHelper('question');

        $question = new Question('New producer name: ');

        $producerName = $helper->ask($input, $output, $question);

        $createResult = $this->getContainer()->get('producer_manager')->createNewProducer($producerName);

        if(!$createResult['success']){
            $output->writeln('<error>Producer not created! Check your entries!</error>');
            $output->write($createResult['errorsLog']);
        }else{
            $output->writeln('<info>Producer successfully created.</info>');
        }
    }
}