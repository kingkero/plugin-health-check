<?php

namespace KERO\PluginHealthCheck;

use Illuminate\Support\Collection;
use KERO\PluginHealthCheck\Models\Theme;

class Scanner
{
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
