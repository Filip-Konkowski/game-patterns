<?php
/**
 * Created by Filip Konkowski.
 */

namespace App\Entity;


interface SpecialSkill
{
    /**
     * @param Soldier $soldier
     */
    public function useSkill(Soldier $soldier);
    /**
     * @param mixed $additionalParameters
     * @return bool
     */
    public function checkSkillUsage($additionalParameters);
}