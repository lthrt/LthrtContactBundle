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

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Lthrt\ContactBundle\DataFixtures\ZipLoader;

/**
 * Generate entity classes from mapping information.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 * @author Jonathan H. Wage <jonwage@gmail.com>
 * @author  lthrt <lighthart.coder@gmail.com>
 *
 * Modified by lthrt to be more in line with his purposes
 */
class LoadZipsCommand extends ContainerAwareCommand
{
    /**
     * {@inheritDoc}
     */
    protected function configure()
    {
        $this
            ->setName('lthrt:load:zips')
            ->setAliases(['lthrt:lo:zi'])
            ->setDescription('Loads zips, counties, and cities into database, skipping zips and cities already present')
            ->addOption('overwrite', null, InputOption::VALUE_NONE, 'Overwrite even if city exists')
            ->addOption('em', null, InputOption::VALUE_REQUIRED, 'entity manager')
            ->setHelp(<<<EOT
The <info>lthrt:load:zips</info> Loads zips, counties, and cities database
if they are not already present.  States must be loaded first
(with <comment>lthrt:load:states</comment>)

You really want to use the <comment>--no-debug</comment> flag

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
        $loader    = new ZipLoader($manager);
        $result    = $loader->loadZips($overwrite);

        if (isset($result['noStates'])) {
            $output->writeln("States must be loaded first: <comment>lthrt:load:states</comment>");
        } else {
            $output->writeln("<info>".$result['cities']. "</info> cities added.>");
            $output->writeln("<info>".$result['counties']. "</info> counties added.");
            $output->writeln("<info>".$result['zips']. "</info> zip codes added.");
        }

    }
}
