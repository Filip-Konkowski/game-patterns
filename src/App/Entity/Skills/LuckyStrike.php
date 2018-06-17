<?php
/**
 * Created by Filip Konkowski.
 */

namespace App\Entity\Skills;


use App\Entity\Soldier;
use App\Entity\SpecialSkill;

class LuckyStrike implements SpecialSkill
{
    /**
     * @var int
     */
    protected $lottery;
    /**
     * @var int
     */
    protected $skillChance = 5;
    
    /**
     * @param Soldier $allySoldier
     * @return int
     */
    public function useSkill(Soldier $allySoldier)
    {
        return $allySoldier->getStrength() * 2;
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