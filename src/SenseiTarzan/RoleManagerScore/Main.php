<?php

namespace SenseiTarzan\RoleManagerScore;

use pocketmine\plugin\PluginBase;
use SenseiTarzan\ExtraEvent\Component\EventLoader;
use SenseiTarzan\RoleManagerScore\Listeners\EventListener;
use SenseiTarzan\RoleManagerScore\Listeners\TagResolveListener;

class Main extends PluginBase
{

    protected function onEnable(): void
    {
        EventLoader::loadEventWithClass($this, EventListener::class);
        EventLoader::loadEventWithClass($this, TagResolveListener::class);
    }
}