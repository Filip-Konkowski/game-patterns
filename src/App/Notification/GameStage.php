<?php

namespace App\Notification;

use App\Entity\Soldier;
use SplObserver;
use Tightenco\Collect\Support\Collection;

class GameStage implements \SplSubject
{
    const WINNING_PLAYER = 'winning';
    const LOOSING_PLAYER = 'loosing';

    /** @var Collection */
    protected $gameHistory;

    /**
     * @var Collection of \SplObserver
     */
    protected $messages;


    public function __construct()
    {
        $this->gameHistory = new Collection();
        $this->messages = new Collection();
    }

    /**
     * @param Soldier[] $players
     */
    public function setGameLastStage(array $players): void
    {
        usort($players, function($player1, $player2) {
            return $player1->getHealth() <= $player2->getHealth();
        });

        $currentStageOfGame = new Collection([
            self::WINNING_PLAYER => $players[0],
            self::LOOSING_PLAYER => $players[1]
        ]);
        $this->gameHistory->push($currentStageOfGame);

    }

    /**
     * @return Collection
     */
    public function getGameStage(): Collection
    {
        return $this->gameHistory;
    }

    /**
     * @return Collection
     */
    public function gameCurrentStage(): Collection
    {
        return $this->gameHistory->last();
    }

    /**
     * @inheritdoc
     */
    public function attach(SplObserver $observer)
    {
        $key = spl_object_hash($observer);
        $this->messages->put($key, $observer);
    }

    /**
     * @inheritdoc
     */
    public function detach(SplObserver $observer)
    {
        $this->messages->forget(spl_object_hash($observer));
    }

    /**
     * @inheritdoc
     */
    public function notify()
    {
        $this->messages->each(function(\SplObserver $message){
            $message->update($this);
        });
    }
}
