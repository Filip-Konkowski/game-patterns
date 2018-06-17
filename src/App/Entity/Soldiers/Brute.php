<?php
/**
 * Created by Filip Konkowski.
 */

namespace App\Entity\Soldiers;

use App\Entity\Skills\StunningBlow;
use App\Entity\Soldier;
use App\Entity\SpecialSkill;

class Brute implements \App\Entity\Soldier
{
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $type;
    /**
     * @var int
     */
    protected $health;
    /**
     * @var int
     */
    protected $strength;
    /**
     * @var int
     */
    protected $defense;
    /**
     * @var int
     */
    protected $speed;
    /**
     * @var float|int
     */
    protected $luck;
    /**
     * @var SpecialSkill[]
     */
    private $specialSkill = [];
    /**
     * @var bool
     */
    protected $stunned = false;
    /**
     * @var Soldier $targetEnemy
     */
    private $targetEnemy;
    
    public function __construct()
    {
        $this->type = 'brute';
        $this->health = random_int(90, 100);
        $this->strength = random_int(65, 75);
        $this->defense = random_int(40, 50);
        $this->speed = random_int(40, 65);
        $this->luck = random_int(30, 35) / 100;
        $this->specialSkill = [new StunningBlow()];
    }
    
    /**
     * @inheritdoc
     */
    public function getType()
    {
        return $this->type;
    }
    
    /**
     * @inheritdoc
     */
    public function getStrength()
    {
        return $this->strength;
    }
    
    /**
     * @inheritdoc
     */
    public function getHealth()
    {
        return $this->health;
    }
    
    /**
     * @inheritdoc
     */
    public function getDefense()
    {
        return $this->defense;
    }
    
    /**
     * @inheritdoc
     */
    public function getSpeed()
    {
        return $this->speed;
    }
    
    /**
     * @inheritdoc
     */
    public function getLuck()
    {
        return $this->luck;
    }
    /**
     * @inheritdoc
     */
    public function setHealth($newHealth)
    {
        return $this->health = $newHealth;
    }
    
    /**
     * @inheritdoc
     */
    public function getSpecialSkill()
    {
        return $this->specialSkill;
    }
    
    /**
     * @inheritdoc
     */
    public function attack()
    {
        if($this->checkStunned()) {
            $this->setStunned(false);
            return 0;
        }
    
        foreach($this->getSpecialSkill() as $skill) {
            if($skill instanceof StunningBlow && $skill->checkSkillUsage(false)) {
               $skill->useSkill($this->getTargetEnemy());
            }
            
        }
        
        $hitPoints = $this->getStrength() - $this->getTargetEnemy()->getDefense();
        return $hitPoints;
    }
    
    /**
     * @inheritdoc
     */
    public function damage($damage)
    {
        $randomNumber = random_int(0, 100) / 100;
        if ($randomNumber < $this->getLuck()) {
            return false;
        }
        $this->setHealth($this->health - $damage);
        return true;
    }
    
    /**
     * @inheritdoc
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * @inheritdoc
     */
    public function setName($name)
    {
        $this->name = $name;
    }
    
    /**
     * @inheritdoc
     */
    public function setStunned($stun)
    {
        $this->stunned = $stun;
    }
    
    /**
     * @inheritdoc
     */
    public function checkStunned()
    {
        return $this->stunned;
    }
    
    /**
     * @inheritdoc
     */
    public function setTargetEnemy(Soldier $enemySoldier)
    {
        $this->targetEnemy = $enemySoldier;
    }
    
    /**
     * @inheritdoc
     */
    public function getTargetEnemy()
    {
        return $this->targetEnemy;
    }
    
    /**
     * @inheritdoc
     */
    public function setSkills($skills)
    {
        $this->specialSkill = $skills;
    }
}