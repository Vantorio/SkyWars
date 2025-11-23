<?php

declare(strict_types=1);

namespace vantorio\skywars\listener;

use pocketmine\event\Listener;
use pocketmine\Server;
use vantorio\skywars\SkyWars;

final class SkyWarsListener implements Listener
{
    private Server $server;

    public function __construct(private SkyWars $plugin)
    {
        $this->server = $this->plugin->getServer();

        $this->server->getPluginManager()->registerEvents($this, $this->plugin);
    }
}
