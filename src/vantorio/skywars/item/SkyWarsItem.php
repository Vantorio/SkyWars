<?php

declare(strict_types=1);

namespace vantorio\skywars\item;

use pocketmine\item\Item;
use pocketmine\item\ItemIdentifier;

abstract class SkyWarsItem extends Item
{
    protected function __construct(ItemIdentifier $itemIdentifier)
    {
        parent::__construct($itemIdentifier);
    }
}
