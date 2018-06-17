<?php
/**
 * Created by Filip Konkowski.
 */

namespace App;


use App\Entity\Soldier;

class Combat
{
    
    /**
     * @var Soldier
     */
    private $soldier1;
    /**
     * @var Soldier
     */
    private $soldier2;
    
    /**
     * @var Soldier[]
     */
    private $fightOrder = [];
    
    /**
     * @var CombatReport $combatReport
     */
    private $report;
    
    public function __construct(Soldier $soldier1, Soldier $soldier2 )
    {
        $this->soldier1 = $soldier1;
        $this->soldier2 = $soldier2;
        $this->report = new CombatReport($soldier1, $soldier2);
    }
    
    public function startFight()
    {
        $determinedOrderSoldiers = $this->determineFightOrder();
        
        $fasterSoldier = current($determinedOrderSoldiers);
        $slowerSoldier = next($determinedOrderSoldiers);
        
        for($turn = 1; $turn <= 30; $turn++) {
            
            $fasterSoldier->setTargetEnemy($slowerSoldier);
            $slowerSoldier->setTargetEnemy($fasterSoldier);
            
            $hitPointsFromFaster = $fasterSoldier->attack($slowerSoldier);
            $defenceResult = $slowerSoldier->damage($hitPointsFromFaster);
            $this->attackReport($fasterSoldier, $slowerSoldier, $hitPointsFromFaster, $defenceResult);
            
            if(!$this->checkSoldierAlive($slowerSoldier)) {
                $this->report->reportWinner($fasterSoldier);
                return;
            }
            
            $hitPointsFromSlower = $slowerSoldier->attack($fasterSoldier);
            $defenceResult =  $fasterSoldier->damage($hitPointsFromSlower);
            $this->attackReport($slowerSoldier, $fasterSoldier, $hitPointsFromSlower, $defenceResult);
            if(!$this->checkSoldierAlive($fasterSoldier)) {
                $this->report->reportWinner($slowerSoldier);
                return;
            }
        }
        
        $this->report->draw();
    }
    
    public function getCombatReport()
    {
        return $this->report;
    }
    
    /**
     * @return Soldier[]
     */
    private function determineFightOrder()
    {
        if ($this->soldier1->getSpeed() > $this->soldier2->getSpeed()) {
            return $this->fightOrder = [$this->soldier1, $this->soldier2];
        }
        elseif ($this->soldier1->getSpeed() === $this->soldier2->getSpeed() && $this->soldier1->getDefense() < $this->soldier2->getDefense()) {
            return $this->fightOrder = [$this->soldier1, $this->soldier2];
        } else {
            return $this->fightOrder = [$this->soldier2, $this->soldier1];
        }
    }
    
    private function checkSoldierAlive(Soldier $soldier)
    {
        if($soldier->getHealth() <= 0) {
            return false;
        }
        return true;
    }
    
    private function attackReport(Soldier $attacker, Soldier $defender, $hitPoints, $defenceResult)
    {
        if($defenceResult) {
            $this->report->soldierAttack($attacker, $defender, $hitPoints);
        } else {
            $this->report->soldierDodge($attacker, $defender);
        }
    }
}