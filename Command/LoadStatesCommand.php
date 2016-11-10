<?php
namespace Lthrt\ContactBundle\Command;

use Lthrt\ContactBundle\DataFixtures\StatesLoader;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Security\Core\Authentication\Token\PreAuthenticatedToken as Token;

class LoadStatesCommand extends ContainerAwareCommand
{
    /**
     * {@inheritDoc}
     */
    protected function configure()
    {
        $this
            ->setName('lthrt:load:states')
            ->setAliases(['lthrt:lo:st'])
            ->setDescription('Loads states into database, skipping states already present')
            ->addOption('overwrite', null, InputOption::VALUE_NONE, 'Overwrite even if abbreviation exists')
            ->addOption('em', null, InputOption::VALUE_REQUIRED, 'entity manager')
            ->setHelp(<<<EOT
The <info>lthrt:load:states</info> Loads states into a database if they are not already present.
States are 'present' in database if their abbreviation already exists


EOT
            );
    }

    /**
     * {@inheritDoc}
     */
    protected function execute(
        InputInterface  $input,
        OutputInterface $output
    ) {
        // For logging
        $token = new Token('Console', 'Console', 'Console');
        $this->getContainer()->get('security.token_storage')->setToken($token);

        $overwrite = $input->getOption('overwrite') ?: false;
        $emName    = $input->getOption('em');
        $manager   = $this->getContainer()->get('doctrine')->getManager($emName);
        $loader    = new StatesLoader($manager);
        $result    = $loader->loadStates($overwrite);
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
