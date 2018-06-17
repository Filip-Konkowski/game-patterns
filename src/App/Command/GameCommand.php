<?php

namespace App\Command;

use App\Combat;
use App\Entity\Soldiers\Brute;
use App\Entity\Soldiers\Grappler;
use App\Entity\Soldiers\Swordsman;
use App\WordFrequency;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class GameCommand extends Command
{
    
    protected function configure()
    {
        $this
            ->setName('game:start')
            ->setDescription('Combat between two combatants')
            ->addArgument('firstCombatantName', InputArgument::REQUIRED, "Please write name of first combatant")
            ->addArgument('secondCombatantName', InputArgument::REQUIRED, "Please write name of second combatant");
    }
    
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $names[] = $input->getArgument('firstCombatantName');
        $names[] = $input->getArgument('secondCombatantName');
        
        $chosenSoldiers = [];
        foreach ($names as $name) {
            $combatants = [new Swordsman(), new Brute(), new Grappler()];
            shuffle($combatants);
            $soldier = $combatants[0];
            $soldier->setName($name);
            $chosenSoldiers[] = $soldier;
        }
        
        $combat = new Combat($chosenSoldiers[0], $chosenSoldiers[1]);
        $combat->startFight();
        $report = $combat->getCombatReport();
        $output->writeln($report->getTitle());
        foreach($report->getMessages() as $message) {
            $output->writeln($message);
        }
        
        $output->writeln($report->getFinalResult());
        
        
    }
}