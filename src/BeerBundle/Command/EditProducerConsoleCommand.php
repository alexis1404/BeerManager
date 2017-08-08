<?php

namespace BeerBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

class EditProducerConsoleCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('beer:editProducer')
            ->setDescription('Edit beer-producer')
            ->setHelp('Edit producer');
    }
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln([
            'Start edit producer:',
            '============',
            '',
        ]);

        $helper = $this->getHelper('question');

        $question = new Question('Input producer ID: ');

        $producerId = $helper->ask($input, $output, $question);

        $question = new Question('Input producer new name: ');

        $newProducerName = $helper->ask($input, $output, $question);

        $resultEditing = $this->getContainer()->get('producer_manager')->editProducer($producerId, $newProducerName);

        if(!$resultEditing){
            $output->writeln('<error>Producer not found!</error>');
            exit();
        }
        if(!$resultEditing['success']){
            $output->writeln('<error>Error editing!</error>');
            $output->writeln('<info>' . $resultEditing['errorsLog'] .'</info>');
        }else{
            $output->writeln('<info>Producer successfully changed.</info>');
        }
    }

}