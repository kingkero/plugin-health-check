<?php

namespace KERO\PluginHealthCheck\Repositories;

use Illuminate\Support\Collection;
use KERO\PluginHealthCheck\Models\Theme;

class ThemeRepository
{
    /**
     * Get all installed themes.
     *
     * @return Collection of \KERO\PluginHealthCheck\Models\Theme objects
     */
    public function getAllThemes(): Collection
    {
        return \collect(\search_theme_directories())->map(function ($data, $slug) {
            return new Theme($data, $slug);
        });
    }

    /**
     * Get all installed plugins that are activated.
     *
     * @return Theme the currently activated theme
     */
    public function getActiveTheme(): ?Theme
    {
        $active = \wp_get_theme();
        return $this->getAllThemes()->filter(function ($theme) use ($active) {
            return $theme->getName() === $active->get('Name');
        })->first();
    }
}
