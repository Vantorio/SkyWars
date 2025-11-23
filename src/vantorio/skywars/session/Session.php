<?php

declare(strict_types=1);

namespace vantorio\skywars\session;

use pocketmine\player\Player;

class Session
{
    public function __construct(private Player $player) {}

    public function getPlayer(): Player
    {
        return $this->player;
    }

    public function clearInventory(): void
    {
        $this->player->getCursorInventory()->clearAll();
        $this->player->getOffHandInventory()->clearAll();
        $this->player->getArmorInventory()->clearAll();
        $this->player->getInventory()->clearAll();
    }
}
