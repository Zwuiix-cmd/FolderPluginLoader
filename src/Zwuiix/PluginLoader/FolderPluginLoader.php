<?php

/*
 * DevTools plugin for PocketMine-MP
 * Copyright (C) 2014 PocketMine Team <https://github.com/PocketMine/DevTools>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
*/

declare(strict_types=1);

namespace Zwuiix\PluginLoader;

use DynamicClassLoader;
use JsonException;
use pocketmine\plugin\Plugin;
use pocketmine\plugin\PluginDescription;
use pocketmine\plugin\PluginLoader;
use pocketmine\utils\Config;
use function file_exists;
use function file_get_contents;
use function is_dir;

class FolderPluginLoader implements PluginLoader
{
    /** @var DynamicClassLoader */
    private DynamicClassLoader $loader;

    public function __construct(protected Plugin $main, DynamicClassLoader $loader)
    {
        $this->loader = $loader;
    }

    /**
     * @param string $path
     * @return bool
     * @throws JsonException
     */
    public function canLoadPlugin(string $path) : bool
    {
        if(is_dir($path) and file_exists($path . "/plugin.yml") and file_exists($path . "/src/")){
            $config=new Config($path . "/plugin.yml", Config::YAML);
            $config->set("description", "Loaded by FolderPluginLoader");
            $config->set("github", "https://github.com/Zwuiix-cmd");

            $plugin=$this->main->getDescription();
            $config->setNested("loader.name", $plugin->getName());
            $config->setNested("loader.main", $plugin->getMain());
            $config->setNested("loader.version", $plugin->getVersion());
            $config->setNested("loader.api", $plugin->getCompatibleApis());
            $config->setNested("loader.authors", $plugin->getAuthors());
            $config->save();
            return true;
        }
        return false;
    }

    /**
     * @param string $file
     * @return void
     * Loads the plugin contained in $file
     */
    public function loadPlugin(string $file) : void{
        $description = $this->getPluginDescription($file);
        if($description !== null){
            $this->loader->addPath($description->getSrcNamespacePrefix(), "$file/src");
        }
    }

    /**
     * @param string $file
     * @return PluginDescription|null
     * Gets the PluginDescription from the file
     */
    public function getPluginDescription(string $file) : ?PluginDescription{
        if(is_dir($file) and file_exists($file . "/plugin.yml")){
            $yaml = @file_get_contents($file . "/plugin.yml");
            if($yaml != ""){
                return new PluginDescription($yaml);
            }
        }
        return null;
    }

    /**
     * @return string
     */
    public function getAccessProtocol() : string{
        return "";
    }
}
