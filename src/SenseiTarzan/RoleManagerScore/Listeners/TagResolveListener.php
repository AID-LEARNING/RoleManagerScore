<?php

namespace SenseiTarzan\RoleManagerScore\Listeners;

use Ifera\ScoreHud\event\TagsResolveEvent;
use SenseiTarzan\ExtraEvent\Class\EventAttribute;
use SenseiTarzan\RoleManager\Component\RolePlayerManager;

class TagResolveListener
{
    #[EventAttribute]
    public function onTagResolve(TagsResolveEvent $event): void{
        $player = $event->getPlayer();
        $tag = $event->getTag();
        $tags = explode('.', $tag->getName(), 2);
        

        if(count($tags) < 2 || $tags[0] !== 'rmscore' || !$player->isConnected()){
            return;
        }
        $rolePlayer = RolePlayerManager::getInstance()->getPlayer($player);

        if ($rolePlayer === null) return;
        $tag->setValue(match ($tags[1]) {
            "role" => $rolePlayer->getRoleName(),
            "prefix" => $rolePlayer->getPrefix(),
            "suffix" => $rolePlayer->getSuffix(),
            default => ""
        });
    }



}