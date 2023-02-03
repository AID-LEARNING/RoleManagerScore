<?php

namespace SenseiTarzan\RoleManagerScore\Listeners;

use Ifera\ScoreHud\event\PlayerTagsUpdateEvent;
use Ifera\ScoreHud\scoreboard\ScoreTag;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\player\Player;
use SenseiTarzan\ExtraEvent\Class\EventAttribute;
use SenseiTarzan\RoleManager\Component\RolePlayerManager;
use SenseiTarzan\RoleManager\Event\EventChangePrefix;
use SenseiTarzan\RoleManager\Event\EventChangeRole;
use SenseiTarzan\RoleManager\Event\EventChangeSuffix;

class EventListener
{

    #[EventAttribute]
    public function onJoin(PlayerJoinEvent $event): void
    {
        $player = $event->getPlayer();
       if (!$player->isConnected()){
           return;
       }

       $this->sendUpdate($player);
    }
    #[EventAttribute]
    public function onChangeRole(EventChangeRole $event): void{

        $player = $event->getPlayer();
        if (!$player->isConnected()){
            return;
        }
        $this->sendUpdate($player);
    }
    #[EventAttribute]
    public function onChangePrefix(EventChangePrefix $event): void{

        $player = $event->getPlayer();
        if (!$player->isConnected()){
            return;
        }
        $this->sendUpdate($player);
    }
    #[EventAttribute]
    public function onChangeSuffix(EventChangeSuffix $event): void{

        $player = $event->getPlayer();
        if (!$player->isConnected()){
            return;
        }
        $this->sendUpdate($player);
    }


    #[EventAttribute]
    public function onChat(PlayerChatEvent $event): void{
        $this->sendUpdate($event->getPlayer());
    }

    private function sendUpdate(Player $player): void{

        $rolePlayer = RolePlayerManager::getInstance()->getPlayer($player);

        if ($rolePlayer === null) return;
        (new PlayerTagsUpdateEvent($player, [
            new ScoreTag("rmscore.role", $rolePlayer->getRoleName()),
            new ScoreTag("rmscore.prefix", $rolePlayer->getPrefix()),
            new ScoreTag("rmscore.suffix", $rolePlayer->getSuffix())
        ]))->call();
    }
}