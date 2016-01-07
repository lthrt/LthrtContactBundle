<?php

/*
 * This file is part of the Doctrine Bundle
 *
 * The code was originally distributed inside the Symfony framework.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 * (c) Doctrine Project, Benjamin Eberlei <kontakt@beberlei.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Lthrt\ContactBundle\Command;

use Lthrt\ContactBundle\DataFixtures\FakePeopleLoader;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Generate entity classes from mapping information.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 * @author Jonathan H. Wage <jonwage@gmail.com>
 * @author  lthrt <lighthart.coder@gmail.com>
 *
 * Modified by lthrt to be more in line with his purposes
 */
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
        if (isset($result['newStates']) && count($result['newStates'])) {
            $inserted = implode(', ', array_keys($result['newStates']));
            $output->writeln("<info>" . $inserted . "</info> added.");
            $output->writeln("");
        }
        if (isset($result['updatedStates']) && count($result['updatedStates'])) {
            $updated = implode(', ', array_keys($result['updatedStates']));
            $output->writeln("<info>" . $updated . "</info> updated.");
        }
    }
}
