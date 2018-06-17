<?php
/**
 * Created by Filip Konkowski.
 */

namespace App\Entity\Skills;


use App\Entity\Soldier;
use App\Entity\SpecialSkill;

class StunningBlow implements SpecialSkill
{
    /**
     * @var int
     */
    protected $lottery;
    /**
     * @var int
     */
    protected $skillChance = 2;
    
    /**
     * @param Soldier $enemySoldier
     */
    public function useSkill(Soldier $enemySoldier)
    {
        $enemySoldier->setStunned(true);
    }
    
    /**
     * @param mixed $additionalParameters
     * @return bool
     */
    public function checkSkillUsage($additionalParameters)
    {
        $this->lottery = random_int(1, 100);
        if($this->lottery <= $this->skillChance) {
            return true;
        }
        return false;
    }
    

}