<?php

declare(strict_types=1);

namespace vantorio\skywars\game;

use pocketmine\player\Player;
use pocketmine\scheduler\Task;
use vantorio\skywars\game\status\Status;
use vantorio\skywars\game\status\types\EndingStatus;
use vantorio\skywars\game\status\types\RunningStatus;
use vantorio\skywars\game\status\types\StartingStatus;
use vantorio\skywars\game\status\types\WaitingStatus;
use vantorio\skywars\session\SessionCollection;

class Game extends Task
{
    private int $id;
    private int $tick;

    public function onRun(): void
    {
        $this->tick++;
        $this->update();
    }

    private ?Status $status = null;

    /** @var Player[] */
    private array $players = [];
    /** @var Player[] */
    private array $spectators = [];

    public function __construct(int $id)
    {
        $this->id = $id;

        $this->setStatus(new WaitingStatus());
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function update(): void {
        $this->status?->onUpdate($this->tick);
    }

    public function getStatus(): ?Status
    {
        return $this->status ?? null;
    }

    public function setStatus(?Status $status): void
    {
        $this->status = $status;
        $this->status->onInit($this);
    }

    public function isWaiting(): bool
    {
        return $this->status instanceof WaitingStatus;
    }

    public function isStarting(): bool
    {
        return $this->status instanceof StartingStatus;
    }

    public function isRunning(): bool
    {
        return $this->status instanceof RunningStatus;
    }

    public function isEnding(): bool
    {
        return $this->status instanceof EndingStatus;
    }

    public function addPlayer(Player $player): void
    {
        $this->players[$player->getUniqueId()->toString()] = $player;

        $session = SessionCollection::getInstance()->get($player);
        if (is_null($session)) {
            return;
        }

        $session->setGame($this);

        $this->status->onJoin($player);
    }

    public function removePlayer(Player $player): void
    {
        $this->status->onLeave($player);

        $session = SessionCollection::getInstance()->get($player);
        if (is_null($session)) {
            return;
        }

        $session->setGame(null);
        $session->setSpectator(false);

        unset($this->players[$player->getUniqueId()->toString()]);
    }

    public function addSpectator(Player $player): void
    {
        $this->spectators[$player->getUniqueId()->toString()] = $player;

        $session = SessionCollection::getInstance()->get($player);
        if (is_null($session)) {
            return;
        }

        $session->setGame($this);
        $session->setSpectator();

        $this->status->onJoin($player);
    }

    public function removeSpectator(Player $player): void
    {
        $this->status->onLeave($player);

        $session = SessionCollection::getInstance()->get($player);
        if (is_null($session)) {
            return;
        }

        $session->setGame(null);
        $session->setSpectator(false);

        unset($this->spectators[$player->getUniqueId()->toString()]);
    }

    public function broadcastPlayers(callable $callback): void
    {
        array_map(function (Player $player) use($callback): void {
            if (!$player->isOnline()) {
                return;
            }
            $callback($player);
        }, $this->players);
    }

    public function broadcastSpectators(callable $callback): void
    {
        array_map(function (Player $player) use($callback): void {
            if (!$player->isOnline()) {
                return;
            }
            $callback($player);
        }, $this->spectators);
    }
}