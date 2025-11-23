<?php

declare(strict_types=1);

namespace vantorio\skywars\game;

use pocketmine\utils\SingletonTrait;
use vantorio\skywars\SkyWars;

final class GameCollection
{
    use SingletonTrait;

    /** @var Game[] */
    private array $games = [];

    public function start(): void {
        array_map(function (Game $game): void {
            SkyWars::getInstance()->getScheduler()->scheduleRepeatingTask($game, 1);
        }, $this->games);
    }

    public function getGames(): array
    {
        return $this->games;
    }
}