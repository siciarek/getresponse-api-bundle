<?php
namespace GetResponse\ApiBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\ArrayInput;

class UpdateCommand extends ContainerAwareCommand
{

    protected function configure()
    {
        $this->setName('gr:update')
            ->setDescription("Updates GetResponse Api Proxy Class");
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $command = $this->getApplication()->find('gr:install');
        $arguments = array("");

        $input = new ArrayInput($arguments);
        $command->run($input, $output);
    }
}
