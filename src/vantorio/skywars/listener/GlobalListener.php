<?php

declare(strict_types=1);

namespace vantorio\skywars\listener;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\Server;
use vantorio\skywars\session\SessionFactory;
use vantorio\skywars\SkyWars;

final class GlobalListener implements Listener
{
    private Server $server;

    public function __construct(private SkyWars $plugin)
    {
        $this->server = $this->plugin->getServer();

        $this->server->getPluginManager()->registerEvents($this, $this->plugin);
    }

    public function onPlayerJoin(PlayerJoinEvent $event): void
    {
        $player = $event->getPlayer();
        $session = SessionFactory::getInstance()->add($player);

        if (is_null($session)) {
            return;
        }

        // TODO: init skywars player data
    }

    public function onPlayerQuit(PlayerQuitEvent $event): void
    {
        $player = $event->getPlayer();
        SessionFactory::getInstance()->remove($player);
    }
}
