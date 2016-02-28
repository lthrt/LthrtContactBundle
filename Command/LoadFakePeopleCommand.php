<?php

namespace Lthrt\ContactBundle\Command;

use Lthrt\ContactBundle\DataFixtures\FakePeopleLoader;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class LoadFakePeopleCommand extends ContainerAwareCommand
{
    /**
     * {@inheritDoc}
     */
    protected function configure()
    {
        $this
            ->setName('lthrt:load:fakePeople')
            ->setAliases(['lthrt:lo:fp'])
            ->setDescription('Loads fake people into database, skipping those already present')
            ->addOption('overwrite', null, InputOption::VALUE_NONE, 'Overwrite even if abbreviation exists')
            ->addOption('em', null, InputOption::VALUE_REQUIRED, 'entity manager')
            ->setHelp(<<<EOT
The <info>lthrt:load:fakePeople</info> Loads fake people into a database if they are not already present.


EOT
            );
    }

    /**
     * {@inheritDoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $overwrite = $input->getOption('overwrite') ?: false;
        $emName    = $input->getOption('em');
        $manager   = $this->getContainer()->get('doctrine')->getManager($emName);
        $loader    = new FakePeopleLoader($manager);
        $result    = $loader->loadFakePeople($overwrite);
        if (isset($result['new']) && count($result['new'])) {
            $inserted = implode(",\n", array_keys($result['new']));
            $output->writeln("<info>" . $inserted . "</info>\nadded.");
            $output->writeln("");
        }
        if (isset($result['updates']) && count($result['updates'])) {
            $updated = implode(",\n", array_keys($result['updates']));
            $output->writeln("<info>" . $updated . "</info>\nupdated.");
            $output->writeln("");
        }
    }
}
