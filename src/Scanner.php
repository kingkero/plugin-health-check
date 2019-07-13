<?php

namespace KERO\PluginHealthCheck;

use Illuminate\Support\Collection;
use KERO\PluginHealthCheck\Models\Plugin;
use KERO\PluginHealthCheck\Models\Theme;

class Scanner
{
    /** @var string DIR_BLACKLIST list of directories to skip when scanning */
    protected const DIR_BLACKLIST = [
        '.',
        '..',
    ];

    /**
     * Return a 2 dimensional array of active and other plugins.
     *
     * @return Collection list of active and other installed plugins
     */
    public function getPlugins(): Collection
    {
        $activePlugins = \collect(\get_option('active_plugins'));

        return \collect(\get_plugins())->mapToGroups(function ($data, $file) use ($activePlugins) {
            $key = $activePlugins->contains($file)
                ? 'active'
                : 'other';
            return [$key => new Plugin($data, $file)];
        });
    }

    /**
     * Return a 2dimensional array of the active and other themes.
     *
     * @return Collection list of active and other installed themes
     */
    public function getThemes(): Collection
    {
        $active = \wp_get_theme();

        return \collect(\search_theme_directories())->map(function ($data, $slug) {
            return new Theme($data, $slug);
        })->mapToGroups(function ($theme) use ($active) {
            $key = $theme->getName() === $active->get('Name')
                ? 'active'
                : 'other';
            return [$key => $theme];
        });
    }
}
