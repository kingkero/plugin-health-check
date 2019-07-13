<?php

namespace KERO\PluginHealthCheck;

use Illuminate\Support\Collection;

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
     * @return Collection list of subdirectories except those blacklisted
     */
    public function searchDirectories(string $start): Collection
    {
        if (!is_dir($start)) {
            return \collect([]);
        }

        return \collect(scandir($start))->filter(function ($subdir) use ($start) {
            return !in_array($subdir, self::DIR_BLACKLIST)
                && is_dir($start . DIRECTORY_SEPARATOR . $subdir);
        });
    }

    /**
     * Return a 2 dimensional array of active and other plugins.
     *
     * @return Collection list of active and other installed plugins
     */
    public function getPlugins(): Collection
    {
        $activePlugins = \collect(\get_option('active_plugins'))->map(function ($path) {
            return explode(DIRECTORY_SEPARATOR, $path, 2)[0];
        });

        return self::searchDirectories(\WP_PLUGIN_DIR)->mapToGroups(function ($slug) use ($activePlugins) {
            $key = $activePlugins->contains($slug)
                ? 'active'
                : 'other';
            return [$key => $slug];
        });
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
