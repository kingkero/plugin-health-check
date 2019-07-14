<?php

namespace KERO\PluginHealthCheck\HealthTests;

use KERO\PluginHealthCheck\Plugin;
use stdClass;

class PluginHealthTest
{
    /** @var string TEST slug of the test this feature adds */
    public const TEST = 'plugin_updates';

    /**
     * Add the test for plugins updates as async.
     *
     * @param array $tests
     * @return array
     */
    public static function add(array $tests): array
    {
        $tests['async'][Plugin::PREFIX . self::TEST] = [
            'label' => __('Plugin updates available', 'plugin-health-check'),
            'test'  => Plugin::PREFIX . self::TEST,
        ];
        return $tests;
    }

    /**
     * Actually test for plugins updates and echo the result.
     *
     * @return void
     */
    public static function test(): void
    {
        check_ajax_referer('health-check-site-status');
        echo 'foo';
        die;
    }
}
