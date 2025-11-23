<?php

declare(strict_types=1);

namespace vantorio\skywars\game\status;

use pocketmine\player\Player;
use vantorio\skywars\game\Game;

abstract class Status
{
    protected Game $game;

    public function onInit(Game $game): void
    {
        $this->game = $game;
        $this->onSwitch();
    }

    abstract protected function onSwitch(): void;
    abstract protected function onUpdate(int $tick): void;
    abstract protected function onJoin(Player $player): void;
    abstract protected function onLeave(Player $player): void;

    public function getGame(): Game
    {
        return $this->game;
    }
}