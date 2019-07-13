<?php

namespace KERO\PluginHealthCheck;

class Plugin
{
    /** @var string VERSION contains the current version nuber */
    public const VERSION = '0.1.0';

    /** @var string PREFIX contains the prefix for data store keys */
    public const PREFIX = 'phc_';

    /**
    * Initialize the plugin.
    *
    * This method is directly called, so all regular hooks are available.
    *
    * @return void
    */
    public static function init(): void
    {
    }
}
