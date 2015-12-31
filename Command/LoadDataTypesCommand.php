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
use Lthrt\ContactBundle\DataFixtures\DataTypesLoader;

/**
 * Generate entity classes from mapping information.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 * @author Jonathan H. Wage <jonwage@gmail.com>
 * @author  lthrt <lighthart.coder@gmail.com>
 *
 * Modified by lthrt to be more in line with his purposes
 */
class LoadDataTypesCommand extends ContainerAwareCommand
{
    /**
     * {@inheritDoc}
     */
    protected function configure()
    {
        $this
            ->setName('lthrt:load:datatypes')
            ->setAliases(['lthrt:lo:dt'])
            ->setDescription('Loads datatypes into database, skipping those already present')
            ->addOption('overwrite', null, InputOption::VALUE_NONE, 'Overwrite even if abbreviation exists')
            ->addOption('em', null, InputOption::VALUE_REQUIRED, 'entity manager')
            ->setHelp(<<<EOT
The <info>lthrt:load:datatypes</info> Loads Loads datatypes into database if they are not already present.
For demographic, address and contact types.

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
        $loader    = new DataTypesLoader($manager);
        $result    = $loader->loadDataTypes($overwrite);
        if (isset($result['newTypes']) && count($result['newTypes'])) {
            $inserted = implode(",\n ", array_keys($result['newTypes']));
            $output->writeln("New types\n <info>".$inserted. "</info> \nadded.");
            $output->writeln("");
        }
        if (isset($result['updatedTypes']) && count($result['updatedTypes'])) {
            $updated = implode(",\n ", array_keys($result['updatedTypes']));
            $output->writeln("Existing types\n <info>".$updated. "</info> \nupdated.");
        }
        if (isset($result['existingTypes']) && count($result['existingTypes'])) {
            $existing = implode(",\n ", array_keys($result['existingTypes']));
            $output->writeln("Existing types\n <info>".$existing. "</info> \nignored.");
        }
    }
}
