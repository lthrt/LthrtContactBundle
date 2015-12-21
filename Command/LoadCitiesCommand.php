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
use Lthrt\ContactBundle\DataFixtures\CitiesLoader;

/**
 * Generate entity classes from mapping information.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 * @author Jonathan H. Wage <jonwage@gmail.com>
 * @author  lthrt <lighthart.coder@gmail.com>
 *
 * Modified by lthrt to be more in line with his purposes
 */
class LoadCitiesCommand extends ContainerAwareCommand
{
    /**
     * {@inheritDoc}
     */
    protected function configure()
    {
        $this
            ->setName('lthrt:load:cities')
            ->setAliases(['lthrt:lo:ci'])
            ->setDescription('Loads cities into database, skipping cities already present')
            ->addOption('overwrite', null, InputOption::VALUE_NONE, 'Overwrite even if city exists')
            ->addOption('em', null, InputOption::VALUE_REQUIRED, 'entity manager')
            ->setHelp(<<<EOT
The <info>lthrt:load:cities</info> Loads states into a database if they are not already present.
States are 'present' in database if their abbreviation already exists.  Then cities are loaded.


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
        $loader    = new CitiesLoader($manager);
        $result    = $loader->load($overwrite);
        if (0 === $result['states']) {
            $output->writeln("<info>No states added.</info>");
        } else {
            $output->writeln("<info>".$result['states']. " added.</info>");
        }
        $output->writeln("<info>".$result['cities']. " cities added.</info>");
    }
}
