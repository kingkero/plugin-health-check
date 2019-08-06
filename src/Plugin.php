<?php

namespace KERO\PluginHealthCheck;

use KERO\PluginHealthCheck\HealthTests\{PluginHealthTest, ThemeHealthTest};

class Plugin
{
    /** @var string VERSION contains the current version nuber */
    const VERSION = '0.0.4';

    /** @var string PREFIX contains the prefix for data store keys */
    const PREFIX = 'phc_';

    /** @var string PREFIX contains the prefix transformed in ajax callbacks */
    const PREFIX_AJAX = 'phc-';

    /**
    * Initialize the plugin.
    *
    * This method is directly called, so all regular hooks are available.
    *
    * @return void
    */
    public static function init(): void
    {
        var_dump(\get_plugins());
        wp_die();
        \add_filter('site_status_tests', [PluginHealthTest::class, 'add']);
        \add_action(
            'wp_ajax_health-check-' . self::PREFIX_AJAX . PluginHealthTest::TEST,
            [
                PluginHealthTest::class,
                'run',
            ]
        );

        \add_filter('site_status_tests', [ThemeHealthTest::class, 'add']);
        \add_action(
            'wp_ajax_health-check-' . self::PREFIX_AJAX . ThemeHealthTest::TEST,
            [
                ThemeHealthTest::class,
                'run',
            ]
        );
    }
}
