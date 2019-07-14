<?php

namespace KERO\PluginHealthCheck\HealthTests;

use KERO\PluginHealthCheck\Plugin;
use stdClass;

class PluginHealthTest
{
    public const TEST = 'plugin_updates';

    public static function add(array $tests): array
    {
        $tests['async'][Plugin::PREFIX . self::TEST] = [
            'label' => __('Plugin updates available', 'plugin-health-check'),
            'test'  => Plugin::PREFIX . self::TEST,
        ];
        return $tests;
    }

    public static function test()
    {
        check_ajax_referer('health-check-site-status');
        echo 'foo';
        die;
    }
}
