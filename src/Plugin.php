<?php

namespace KERO\PluginHealthCheck;

use KERO\PluginHealthCheck\HealthTests\PluginHealthTest;

class Plugin
{
    /** @var string VERSION contains the current version nuber */
    public const VERSION = '0.1.0';

    /** @var string PREFIX contains the prefix for data store keys */
    public const PREFIX = 'phc_';

    /** @var string PREFIX contains the prefix transformed in ajax callbacks */
    public const PREFIX_AJAX = 'phc-';

    /**
    * Initialize the plugin.
    *
    * This method is directly called, so all regular hooks are available.
    *
    * @return void
    */
    public static function init(): void
    {
        \add_filter('site_status_tests', [PluginHealthTest::class, 'add']);
        \add_action(
            'wp_ajax_health-check-' . self::PREFIX_AJAX . PluginHealthTest::TEST,
            [
                PluginHealthTest::class,
                'run',
            ]
        );
    }
}
