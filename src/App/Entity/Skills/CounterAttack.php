<?php
/**
 * Created by Filip Konkowski.
 */

namespace App\Entity\Skills;


use App\Entity\Soldier;
use App\Entity\SpecialSkill;

class CounterAttack implements SpecialSkill
{
    protected $skillDamage = 10;
    
    /**
     * @param Soldier $enemySoldier
     */
    public function useSkill(Soldier $enemySoldier)
    {
        $enemySoldier->setHealth($enemySoldier->getHealth() - $this->skillDamage);
    }
    
    /**
     * @param boolean $luckSuccessful
     * @return boolean
     */
    public function checkSkillUsage($luckSuccessful)
    {
        return $luckSuccessful;
    }
}