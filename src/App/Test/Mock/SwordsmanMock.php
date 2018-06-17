<?php
/**
 * Created by Filip Konkowski.
 */

namespace App\Test\Mock;


use App\Entity\Soldiers\Swordsman;

class SwordsmanMock extends Swordsman
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function setStrength($strength)
    {
        $this->strength = $strength;
    }
    
    public function setDefense($defense)
    {
        $this->defense = $defense;
    }
    
    public function setSpeed($speed)
    {
        $this->speed = $speed;
    }
    
    public function setLuck($luck)
    {
        $this->luck = $luck;
    }
}