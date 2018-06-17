<?php

namespace App\Notification;

use App\Entity\Soldier;
use Tightenco\Collect\Support\Collection;

class GameStage
{

    /** @var Collection */
    protected $gameHistory;


    public function __construct()
    {
        $this->gameHistory = new Collection();
    }

    /**
     * @param Soldier[] $players
     */
    public function setGameLastStage(array $players): void
    {
        usort($players, function($player1, $player2) {
            return $player1->getHealth() <= $player2->getHealth();
        });

        $this->gameHistory->push($players);

    }

    /**
     * @return Collection
     */
    public function getGameStage(): Collection
    {
        return $this->gameHistory;
    }

    public function gameCurrentStage(): array
    {
        return $this->gameHistory->last();
    }
}
