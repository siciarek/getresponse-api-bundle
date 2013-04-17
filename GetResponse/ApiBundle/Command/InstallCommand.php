<?php
namespace GetResponse\ApiBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\ArrayInput;

function file_get_contents_ssl($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_REFERER, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}

class InstallCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName('gr:install')
            ->setDescription("Installs GetResponse Api Proxy Class");
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $config = $this->getContainer()->getParameter("getresponse.config");

        $target = __DIR__ . "/../Api/jsonRPCClient.php";

        $content = file_get_contents_ssl($config["source"]);

        file_put_contents($target, $content);

        if(is_file($target) and is_readable($target) and filesize($target) > 512) {
            $output->writeln("Current version of GetResponse Api Class installed successfully!");
        }
        else
        {
            $output->writeln("Current version of GetResponse Api Class can not be installed!");
        }
    }
}
