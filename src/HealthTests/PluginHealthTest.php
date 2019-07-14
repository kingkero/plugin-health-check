<?php

namespace KERO\PluginHealthCheck\HealthTests;

use KERO\PluginHealthCheck\Plugin;
use stdClass;

class PluginHealthTest
{
    public static function add(array $tests): array
    {
        $tests['async']['caching_plugin'] = [
            'label' => __('My Caching Test'),
            'test'  => 'testPlugins',
        ];
        return $tests;
    }

    public static function test(): stdClass
    {
        return (object) [
            'status' => 'recommended',
            'message' => 'foo',
        ];

        $result = array(
            'label'       => __('Caching is enabled'),
            'status'      => 'recommended',
            'badge'       => array(
                'label' => __('Performance'),
                'color' => 'orange',
            ),
            'description' => sprintf(
                '<p>%s</p>',
                __('Caching can help load your site more quickly for visitors.')
            ),
            'actions'     => '',
            'test'        => 'caching_plugin',
        );

        /* if ( ! myplugin_caching_is_enabled() ) {
            $result['status'] = 'recommended';
            $result['label'] = __( 'Caching is not enabled' );
            $result['description'] = sprintf(
                '<p>%s</p>',
                __( 'Caching is not currently enabled on your site. Caching can help load your site more quickly for visitors.' )
            );
            $result['actions'] .= sprintf(
                '<p><a href="%s">%s</a></p>',
                esc_url( admin_url( 'admin.php?page=cachingplugin&action=enable-caching' ) ),
                __( 'Enable Caching' )
            );
        } */

        return $result;
    }
}
