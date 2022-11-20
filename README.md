# FolderPluginLoader

[![Discord](https://img.shields.io/badge/chat-on%20discord-7289da.svg)](https://discord.gg/YfyfH6fdyv)

##### Licence
I specify first of all that the code comes from the **plugin** [DevTools](https://github.com/pmmp/DevTools), I only took a class, their plugin seemed to me too overloaded, I wanted only this class!

### Development Tools for [PocketMine-MP](https://github.com/pmmp/PocketMine-MP)
FolderPluginLoader is a collection of utilities used for developing [PocketMine-MP](https://github.com/pmmp/PocketMine-MP) plugins.

## Features
- Load plugins directly from source code (folder plugins), useful for rapid development

# How to use

```php
<?php

namespace YOUNAMESPACE;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\SingletonTrait;
use Zwuiix\PluginLoader\Load;

# YOUR MAIN FILE
class Main extends PluginBase
{
    use SingletonTrait;
    
    /**
    * @return void
    */
    protected function onLoad() : void
    {
        self::setInstance($this);
        Load::register($this);
    }
}
```

# About
Edited by [Zwuiix-cmd](https://github.com/Zwuiix-cmd) for version [4.10.1](https://github.com/pmmp/PocketMine-MP/releases/tag/4.10.1) of [PocketMine](https://github.com/pmmp/PocketMine-MP).