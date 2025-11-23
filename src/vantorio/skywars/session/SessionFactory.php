<?php

declare(strict_types=1);

namespace vantorio\skywars\session;

use pocketmine\utils\SingletonTrait;

class SessionFactory
{
    use SingletonTrait;

    /** @var Session[] */
    private array $sessions = [];

    public function add(Player $player): Session
    {
        $session = new Session($player);
        $this->sessions[$player->getUniqueId()->toString()] = $session;
        return $session;
    }

    public function get(Player $player): ?Session
    {
        return $this->sessions[$player->getUniqueId()->toString()] ?? null;
    }

    public function remove(Player $player): void
    {
        unset($this->sessions[$player->getUniqueId()->toString()]);
    }
}
