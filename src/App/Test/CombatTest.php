<?php
/**
 * Created by Filip Konkowski.
 */


namespace App\Test;

use App\Combat;
use App\Test\Mock\BruteMock;
use App\Test\Mock\GrapplerMock;
use App\Test\Mock\SkillsMock\LuckyStrikeMock;
use App\Test\Mock\SkillsMock\StunningBlowMock;
use App\Test\Mock\SwordsmanMock;
use PHPUnit\Framework\TestCase;

require __DIR__.'/../../../vendor/autoload.php';

class CombatTest extends TestCase
{
    public function testCombatWinningSwordsman()
    {
        $swordsman = new SwordsmanMock();
        $swordsman->setSpeed(100);
        $swordsman->setStrength(100);
        $brute = new BruteMock();
        $brute->setSpeed(1);
        $brute->setHealth(1);
        $brute->setLuck(0);
        $combat = new Combat($swordsman, $brute);
        $combat->startFight();
        $report = $combat->getCombatReport();
        $expectedWinner = $swordsman;
        $this->assertEquals($expectedWinner, $report->getWinner());
        $this->assertEquals('The winner is ' . $expectedWinner->getName() ." of type " . $expectedWinner->getType() . "\n" . 'Remaining health ' . $expectedWinner->getHealth(), $report->getFinalResult());
    }
    
    public function testCombatWinningGrapple()
    {
        $swordsman = new GrapplerMock();
        $swordsman->setSpeed(100);
        $swordsman->setStrength(100);
        $brute = new BruteMock();
        $brute->setSpeed(1);
        $brute->setHealth(1);
        $brute->setLuck(0);
        $combat = new Combat($swordsman, $brute);
        $combat->startFight();
        $report = $combat->getCombatReport();
        $expectedWinner = $swordsman;
        $this->assertEquals($expectedWinner, $report->getWinner());
        $this->assertEquals('The winner is ' . $expectedWinner->getName() ." of type " . $expectedWinner->getType() . "\n" . 'Remaining health ' . $expectedWinner->getHealth(), $report->getFinalResult());
    }
    
    public function testCombatWinningBrute()
    {
        $swordsman = new BruteMock();
        $swordsman->setSpeed(100);
        $swordsman->setStrength(100);
        $brute = new SwordsmanMock();
        $brute->setSpeed(1);
        $brute->setHealth(1);
        $brute->setLuck(0);
        $combat = new Combat($swordsman, $brute);
        $combat->startFight();
        $report = $combat->getCombatReport();
        $expectedWinner = $swordsman;
        $this->assertEquals($expectedWinner, $report->getWinner());
        $this->assertEquals('The winner is ' . $expectedWinner->getName() ." of type " . $expectedWinner->getType() . "\n" . 'Remaining health ' . $expectedWinner->getHealth(), $report->getFinalResult());
    }
    
    public function testDraw()
    {
        $bruteMock = new BruteMock();
        $bruteMock->setStrength(1);
        $bruteMock->setHealth(100);
        $bruteMock->setLuck(100);
        $swordsmanMock = new SwordsmanMock();
        $swordsmanMock->setStrength(1);
        $swordsmanMock->setHealth(100);
        $swordsmanMock->setLuck(100);
        $combat = new Combat($bruteMock, $swordsmanMock);
        $combat->startFight();
        $report = $combat->getCombatReport();
        $expectedWinner = null;
        $this->assertEquals($expectedWinner, $report->getWinner());
        $this->assertEquals('The combat finished with draw', $report->getFinalResult());
    }
    
    public function testAttacks()
    {
        $bruteMock = new BruteMock();
        $bruteMock->setStrength(2);
        $bruteMock->setHealth(100);
        $bruteMock->setLuck(0);
        $bruteMock->setDefense(1);
        $stunningBlowMock = new StunningBlowMock();
        $stunningBlowMock->setSkillNeverWorks();
        $bruteMock->setSkills([$stunningBlowMock]);
        
        $swordsmanMock = new SwordsmanMock();
        $swordsmanMock->setStrength(2);
        $swordsmanMock->setHealth(100);
        $swordsmanMock->setLuck(0);
        $swordsmanMock->setDefense(1);
        $luckyStrikeSkill = new LuckyStrikeMock();
        $luckyStrikeSkill->setSkillNeverWorks();
        $swordsmanMock->setSkills([$luckyStrikeSkill]);
        
        $bruteMock->setTargetEnemy($swordsmanMock);
        $swordsmanMock->setTargetEnemy($bruteMock);
        for($i = 1; $i <= 90; $i++) {
            $hitpoints = $bruteMock->attack();
            $swordsmanMock->damage($hitpoints);
        }
        
        $this->assertEquals(10, $swordsmanMock->getHealth());
    
        for($i = 1; $i <= 20; $i++) {
            $hitpoints = $swordsmanMock->attack();
            $bruteMock->damage($hitpoints);
        }
    
        $this->assertEquals(80, $bruteMock->getHealth());
        
    }
}