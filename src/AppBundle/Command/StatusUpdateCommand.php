<?php
namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;



class StatusUpdateCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('app:updateStatuses')
            ->setDescription('Update statuses of Bonus Cards')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $statusUpdater = $this->getContainer()->get('app.statusUpdater');
        $res = $statusUpdater->update();

        $output->writeln($res);
    }
}