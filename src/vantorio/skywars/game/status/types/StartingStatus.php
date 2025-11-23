<?php

declare(strict_types=1);

namespace vantorio\skywars\game\status\types;

use pocketmine\player\Player;
use vantorio\skywars\game\status\Status;

class StartingStatus extends Status
{
    private int $time;

    public function onSwitch(): void
    {
        // TODO: Implement onSwitch() method.
    }

    public function onUpdate(int $tick): void
    {
        if ($tick % 20 === 0) {
            $this->time++;
        }
    }

    public function onJoin(Player $player): void
    {
        // TODO: Implement onJoin() method.
    }

    public function onLeave(Player $player): void
    {
        // TODO: Implement onLeave() method.
    }
}