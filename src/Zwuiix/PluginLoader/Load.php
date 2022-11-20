<?php

namespace Zwuiix\PluginLoader;

use pocketmine\plugin\Plugin;

final class Load
{
    /**
     * @param Plugin $plugin
     * @return void
     */
    public static function register(Plugin $plugin): void
    {
        $plugin->getServer()->getPluginManager()->registerInterface(new FolderPluginLoader($plugin, $plugin->getServer()->getLoader()));
        $plugin->getLogger()->notice("Registered folder plugin loader");
    }
}