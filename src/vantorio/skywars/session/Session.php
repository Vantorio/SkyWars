<?php

declare(strict_types=1);

namespace vantorio\skywars\session;

class Session
{
    public function __construct(private Player $player) {}

    public function getPlayer(): Player
    {
        return $this->player;
    }
}
