<?php

declare(strict_types=1);

namespace vantorio\skywars\item;

use pocketmine\item\Item;
use pocketmine\item\ItemIdentifier;
use pocketmine\item\ItemUseResult;
use pocketmine\math\Vector3;
use pocketmine\network\mcpe\protocol\PlaySoundPacket;
use pocketmine\player\Player;

abstract class SkyWarsItem extends Item
{
    protected function __construct(ItemIdentifier $itemIdentifier)
    {
        parent::__construct($itemIdentifier);
    }

    public function onClickAir(Player $player, Vector3 $directionVector, array &$returnedItems): ItemUseResult
    {
        $playerPosition = $player->getPosition();
        $soundPacket = PlaySoundPacket::create(
            "random.pop",
            $playerPosition->getX(),
            $playerPosition->getY(),
            $playerPosition->getZ(),
            1.0,
            1.0
        );
        $player->getNetworkSession()->sendDataPacket($soundPacket);
        return parent::onClickAir($player, $directionVector, $returnedItems);
    }
}
