<?php

namespace KERO\PluginHealthCheck\HealthTests;

use KERO\PluginHealthCheck\Plugin;

class ThemeHealthTest
{
    /** @var string TEST slug of the test this feature adds */
    const TEST = 'theme_updates';

    /**
     * Add the test for theme updates as async call.
     *
     * @param array $tests
     * @return array
     */
    public static function add(array $tests): array
    {
        $tests['async'][Plugin::PREFIX . self::TEST] = [
            'label' => __('Theme updates available', 'plugin-health-check'),
            'test'  => Plugin::PREFIX . self::TEST,
        ];
        return $tests;
    }

    /**
     * Callback for the ajax call.
     *
     * @return void
     */
    public static function run(): void
    {
        check_ajax_referer('health-check-site-status');

        if (!\current_user_can('update_themes')) {
            \wp_send_json_error();
        }

        $response = self::testThemes();
        wp_send_json_success($response);
        die();
    }

    /**
     * Check if theme updates are available.
     *
     * @return array
     */
    private static function testThemes(): array
    {
        $defaultMessage = __(
            'Keeping your themes up to date improves security and may add other benefits.',
            'plugin-health-check'
        );

        $result = [
            'label' => __('All themes are up to date', 'plugin-health-check'),
            'status' => 'good',
            'badge' => [
                'label' => __('Security'),
                'color' => 'gray',
            ],
            'description' => sprintf(
                '<p>%s</p>',
                $defaultMessage
            ),
            'actions' => '',
            'test' => Plugin::PREFIX . self::TEST,
        ];

        if (!function_exists('get_theme_updates')) {
            require_once(\ABSPATH . 'wp-admin/includes/update.php');
        }

        $updates = \get_theme_updates();
        if (!empty($updates)) {
            $amount = count($updates);

            $result['label'] = sprintf(
                /* translators: %s: number of themes with updates available */
                _n(
                    'There is %s theme update available',
                    'There are %s theme updates available',
                    $amount,
                    'plugin-health-check'
                ),
                \number_format_i18n($amount)
            );

            $result['status'] = 'recommended';

            $result['badge']['color'] = 'orange';

            $result['description'] = sprintf(
                '<p>%s %s</p><ul>%s</ul>',
                __(
                    'Not all themes are up to date on your site.',
                    'plugin-health-check'
                ),
                $defaultMessage,
                \collect($updates)->map(function ($data) {
                    return sprintf(
                        /* translators: 1: Name of the theme 2: Current version 3: Version after update */
                        __('<em>%1$s</em> (%2$s &rarr; %3$s)', 'plugin-health-check'),
                        $data->Name,
                        $data->Version,
                        $data->update['new_version']
                    );
                })->reduce(function ($carry, $item) {
                    return $carry . '<li>' . $item . '</li>';
                })
            );

            $result['actions'] .= sprintf(
                '<p><a href="%s">%s</a></p>',
                esc_url(admin_url('update-core.php')),
                __('Go to Updates', 'plugin-health-check')
            );
        }

        return $result;
    }
}
