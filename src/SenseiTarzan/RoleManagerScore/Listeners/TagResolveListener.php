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

        if(count($tags) < 2 || $tags[0] !== 'rmscore'){
            return;
        }

        $tag->setValue(match ($tags[1]) {
            "role" => RolePlayerManager::getInstance()->getPlayer($player)->getRoleName(),
            "prefix" => RolePlayerManager::getInstance()->getPlayer($player)->getPrefix(),
            "suffix" => RolePlayerManager::getInstance()->getPlayer($player)->getSuffix()
        });
    }



}