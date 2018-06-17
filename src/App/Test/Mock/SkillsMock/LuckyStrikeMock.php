<?php
/**
 * Created by Filip Konkowski.
 */

namespace App\Test\Mock\SkillsMock;


use App\Entity\Skills\LuckyStrike;

class LuckyStrikeMock extends LuckyStrike
{
    public function setSkillAlwaysWorks()
    {
        $this->skillChance = 1000;
    }
    
    public function setSkillNeverWorks()
    {
        $this->skillChance = 0;
    }
    
}