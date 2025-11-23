<?php

declare(strict_types=1);

namespace vantorio\skywars\session;

use pocketmine\player\Player;
use vantorio\skywars\game\Game;

class Session
{
    private ?Game $game;

    private bool $isSpectator = false;

    public function __construct(private Player $player) {}

    public function getPlayer(): Player
    {
        return $this->player;
    }

    public function isInGame(): bool
    {
        return $this->game !== null;
    }

    public function setGame(?Game $game): void
    {
        $this->game = $game;
    }

    public function getGame(): ?Game
    {
        return $this->game;
    }

    public function isSpectator(): bool
    {
        return $this->isSpectator;
    }

    public function setSpectator(bool $isSpectator = true): void
    {
        $this->isSpectator = $isSpectator;
    }

    public function clearInventory(): void
    {
        $this->player->getCursorInventory()->clearAll();
        $this->player->getOffHandInventory()->clearAll();
        $this->player->getArmorInventory()->clearAll();
        $this->player->getInventory()->clearAll();
    }
}
