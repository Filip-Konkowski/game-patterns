<?php
/**
 * Created by Filip Konkowski.
 */

namespace App\Test;


use App\Test\Mock\BruteMock;
use App\Test\Mock\GrapplerMock;
use App\Test\Mock\SkillsMock\CounterAttackMock;
use App\Test\Mock\SkillsMock\LuckyStrikeMock;
use App\Test\Mock\SkillsMock\StunningBlowMock;
use App\Test\Mock\SwordsmanMock;
use PHPUnit\Framework\TestCase;

class SkillsTest extends TestCase
{
    public function testCounterAttack()
    {
        $grappler = new GrapplerMock();
        $grappler->setLuck(100);
        $swordsman = new SwordsmanMock();
        
        $counterAttackSkill = new CounterAttackMock();
        
        $grappler->setSkills([$counterAttackSkill]);
        $grappler->setTargetEnemy($swordsman);
        $swordsman->setTargetEnemy($grappler);
        $healthBeforeSkillUse = $swordsman->getHealth();
        $grappler->damage(1);
        $healthAfterSkillUse = $swordsman->getHealth();
        
        $damageOfSwordsman = $healthBeforeSkillUse - $healthAfterSkillUse;
        $this->assertEquals(10, $damageOfSwordsman);
    }
    
    public function testLuckyStrike()
    {
        $swordsman = new SwordsmanMock();
        $swordsman->setLuck(100);
        $swordsman->setStrength(2);
        $brute = new BruteMock();
        $brute->setDefense(0);
        $brute->setLuck(0);
        
        $luckyStrikeSkill = new LuckyStrikeMock();
        $luckyStrikeSkill->setSkillAlwaysWorks();
        
        $swordsman->setSkills([$luckyStrikeSkill]);
        $swordsman->setTargetEnemy($brute);
        $brute->setTargetEnemy($swordsman);
        
        $healthBeforeSkillUse = $brute->getHealth();
        $hitPoints = $swordsman->attack();
        $brute->damage($hitPoints);
        $healthAfterSkillUse = $brute->getHealth();
        
        $damageOfBrute = $healthBeforeSkillUse - $healthAfterSkillUse;
        $this->assertEquals(4, $hitPoints);
        $this->assertEquals(4, $damageOfBrute);
    }
    
    public function testStunningBlow()
    {
        $brute = new BruteMock();
        $brute->setLuck(100);
        $brute->setStrength(2);
        $grappler = new GrapplerMock();
        $grappler->setDefense(0);
        $grappler->setLuck(0);
    
        $stunningBlowMock = new StunningBlowMock();
        $stunningBlowMock->setSkillAlwaysWorks();
    
        $brute->setSkills([$stunningBlowMock]);
        $brute->setTargetEnemy($grappler);
        $grappler->setTargetEnemy($brute);
        
        $hitPoints = $brute->attack();
        $grappler->damage($hitPoints);
        
        $this->assertTrue($grappler->checkStunned());
    }
}