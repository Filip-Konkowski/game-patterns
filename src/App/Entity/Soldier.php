<?php

namespace App\Entity;

interface Soldier
{
    /**
     * @return string
     */
    public function getName();
    
    /**
     * @return string
     */
    public function getType();
    
    /**
     * @param string $name
     */
    public function setName($name);
    
    /**
     * @return integer
     */
    public function getStrength();
    
    /**
     * @return integer
     */
    public function getHealth();
    /**
     * @return integer
     */
    public function getDefense();
    /**
     * @return integer
     */
    public function getSpeed();
    /**
     * @return integer
     */
    public function getLuck();
    
    /**
     * @param integer $newHealth
     * @return integer
     */
    public function setHealth($newHealth);
    
    /**
     * @return \App\Entity\SpecialSkill[]
     */
    public function getSpecialSkill();
    
    /**
     * @return integer
     */
    public function attack();
    
    /**
     * @param integer $damage
     */
    public function damage($damage);
    
    /**
     * @param boolean $stun
     */
    public function setStunned($stun);
    
    /**
     * @return boolean
     */
    public function checkStunned();
    
    /**
     * @param Soldier $enemySoldier
     * @return mixed
     */
    public function setTargetEnemy(Soldier $enemySoldier);
    
    /**
     * @return Soldier
     */
    public function getTargetEnemy();
    
    /**
     * @param SpecialSkill[] $skills
     */
    public function setSkills($skills);
}