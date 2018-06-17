<?php
/**
 * Created by Filip Konkowski.
 */

namespace App\Test\Mock\SkillsMock;


use App\Entity\Skills\StunningBlow;

class StunningBlowMock extends StunningBlow
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