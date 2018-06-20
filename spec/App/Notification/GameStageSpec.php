<?php

namespace spec\App\Notification;

use App\Entity\Soldier;
use App\Test\Mock\BruteMock;
use App\Test\Mock\GrapplerMock;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GameStageSpec extends ObjectBehavior
{
    const WINNING_PLAYER = 'winning';
    const LOOSING_PLAYER = 'loosing';

    /**
     * @var Soldier
     */
    public  $player1;

    /**
     * @var Soldier
     */
    public $player2;


    function let()
    {
        $this->player1 = new BruteMock();
        $this->player2 = new GrapplerMock();
    }


    function it_should_gather_information_about_players_stage()
    {
        $this->setGameLastStage([$this->player1, $this->player2]);
        $this->setGameLastStage([$this->player1, $this->player2]);

        $this->getGameStage()->count()->shouldBe(2);
    }

    function it_should_have_stage_of_players()
    {
        $this->player1->setHealth(1);
        $this->player2->setHealth(4);
        $this->setGameLastStage([$this->player1, $this->player2]);

        $this->getGameStage()->first()[$this::WINNING_PLAYER]->shouldBeAnInstanceOf(GrapplerMock::class);
    }

    function it_can_give_current_stage_of_players()
    {
        $this->player1->setHealth(100);
        $this->player2->setHealth(44);
        $this->setGameLastStage([$this->player1, $this->player2]);


        $this->player1->setHealth(10);
        $this->player2->setHealth(44);
        $this->setGameLastStage([$this->player1, $this->player2]);

        $this->gameCurrentStage()[$this::WINNING_PLAYER]->shouldBeAnInstanceOf(GrapplerMock::class);
    }

}
