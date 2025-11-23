<?php

declare(strict_types=1);

namespace vantorio\skywars;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\SingletonTrait;
use vantorio\skywars\listener\GlobalListener;
use vantorio\skywars\listener\SkyWarsListener;

class SkyWars extends PluginBase
{
    use SingletonTrait;

    public function onEnable(): void
    {
        self::setInstance($this);

        new GlobalListener($this);
        new SkyWarsListener($this);
    }
}
