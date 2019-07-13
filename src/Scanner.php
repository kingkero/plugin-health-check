<?php

namespace KERO\PluginHealthCheck;

class Scanner
{
    /** @var string DIR_BLACKLIST list of directories to skip when scanning */
    protected const DIR_BLACKLIST = [
        '.',
        '..',
    ];

    /**
     * Scan a directory for subdirectories.
     *
     * @param string $start base path to start looking for subdirectories
     * @return string[] list of subdirectories
     */
    public function scanDirs(string $start): array
    {
        $result = [];

        if (!is_dir($start)) {
            return $result;
        }

        foreach (scandir($start) as $entry) {
            if (!in_array($entry, self::DIR_BLACKLIST)
                && is_dir($start . DIRECTORY_SEPARATOR . $entry)) {
                $result[] = $entry;
            }
        }

        return $result;
    }

    /**
     * Return a 2 dimensional array of active and other plugins.
     *
     * @return array
     */
    public function getPlugins(): array
    {
        $result = [];

        $result['active'] = \collect(\get_option('active_plugins'))->map(function ($path) {
            list ($slug) = explode(DIRECTORY_SEPARATOR, $path, 2);
            return $slug;
        });

        $result['other'] = \collect(self::scanDirs(WP_PLUGIN_DIR))->filter(function ($slug) use ($result) {
            return !$result['active']->contains($slug);
        });

        return $result;
    }

    /**
     * Return a 2dimensional array of the active and other themes.
     *
     * @return \WP_Theme[]
     */
    public function getThemes(): array
    {
        $result = [];

        $result['active'] = [\wp_get_theme()];

        $result['other'] = [];
        foreach (\search_theme_directories() as $slug => $entry) {
            $theme = new \WP_Theme($slug, $entry['theme_root']);
            if ($theme->get('Name') === $result['active'][0]->get('Name')) {
                continue;
            }
            $result['other'][] = $theme;
        }

        return $result;
    }
}
