<?php
/**
 * Created by Filip Konkowski.
 */

namespace App;


use App\Entity\Soldier;

class CombatReport
{
    private $title;
    
    private $messages = [];
    
    private $finalResult;
    /**
     * @var Soldier
     */
    private $winner;
    
    public function __construct(Soldier $soldier1, Soldier $soldier2)
    {
        $this->setTitle($soldier1, $soldier2);
    }
    
    public function addMessage($text)
    {
        $this->messages[] = $text;
    }
    
    public function setTitle(Soldier $soldier1, Soldier $soldier2)
    {
        $this->title = 'Combat between ' . $soldier1->getName() .' (' . $soldier1->getType(). ')' . ' and ' . $soldier2->getName() . ' (' . $soldier2->getType(). ')' ;
    }
    
    public function soldierAttack(Soldier $soldierAttacker, Soldier $soldierDefender, $hitPoints)
    {
        $message = 'Soldier ' . $soldierAttacker->getName() . ' (' . $soldierAttacker->getType(). ')' . ' attack ' . $soldierDefender->getName() . ' (' . $soldierDefender->getType(). ')' . ' taking ' . $hitPoints . ' damage';
        $this->addMessage($message);
    }
    
    public function soldierDodge(Soldier $soldierAttacker, Soldier $soldierDefender)
    {
        $message = 'Soldier ' . $soldierAttacker->getName() .' (' . $soldierAttacker->getType(). ')' . ' attack, but ' . $soldierDefender->getName() . ' (' . $soldierDefender->getType(). ')' .
                    ' was able to dodge. No hit points was taken by ' . $soldierDefender->getName();
        $this->addMessage($message);
    }
    
    public function reportWinner(Soldier $winner)
    {
        $this->finalResult = 'The winner is ' . $winner->getName() ." of type " . $winner->getType() . "\n" . 'Remaining health ' . $winner->getHealth();
        $this->setWinner($winner);
    }
    
    public function draw()
    {
        $this->finalResult = 'The combat finished with draw';
    }
    
    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }
    
    /**
     * @return array
     */
    public function getMessages()
    {
        return $this->messages;
    }
    
    /**
     * @return string
     */
    public function getFinalResult()
    {
        return $this->finalResult;
    }
    
    /**
     * @return Soldier
     */
    public function getWinner()
    {
        return $this->winner;
    }
    
    /**
     * @param Soldier $winner
     */
    public function setWinner($winner)
    {
        $this->winner = $winner;
    }
    
    
}