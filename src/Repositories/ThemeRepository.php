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
     * Get the activated theme.
     *
     * @return Theme the currently activated theme
     */
    public function getActiveTheme(): Theme
    {
        $active = \wp_get_theme();
        return $this->getAllThemes()->filter(function ($theme) use ($active) {
            return $theme->getName() === $active->get('Name');
        })->first();
    }

    /**
     * Get the parent theme of the activated theme.
     *
     * @return Theme|null the parent theme or null
     */
    public function getParentTheme(): ?Theme
    {
        $parentName = $this->getActiveTheme()->getTheme()->parent_theme;
        if (empty($parentName)) {
            return null;
        }

        return $this->getAllThemes()->filter(function ($theme) use ($parentName) {
            return $theme->getName() === $parentName;
        })->first();
    }

    /**
     * Get all installed plugins that are activated.
     *
     * @return Theme the currently activated theme
     */
    public function getActiveThemes(): Collection
    {
        return \collect([
            $this->getActiveTheme(),
            $this->getParentTheme(),
        ])->filter(function ($theme) {
            return $theme !== null;
        });
    }
}
