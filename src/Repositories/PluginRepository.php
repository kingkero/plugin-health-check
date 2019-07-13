<?php

namespace KERO\PluginHealthCheck\Repositories;

use Illuminate\Support\Collection;
use KERO\PluginHealthCheck\Models\Plugin;

class PluginRepository
{
    /**
     * Get all installed plugins.
     *
     * @return Collection of \KERO\PluginHealthCheck\Models\Plugin objects
     */
    public function getAllPlugins(): Collection
    {
        return \collect(\get_plugins())->map(function ($data, $file) {
            return new Plugin($data, $file);
        });
    }

    /**
     * Get all installed plugins that are activated.
     *
     * @return Collection of \KERO\PluginHealthCheck\Models\Plugin objects
     */
    public function getActivePlugins(): Collection
    {
        $activePlugins = \collect(\get_option('active_plugins'));

        return $this->getAllPlugins()->filter(function ($plugin) use ($activePlugins) {
            return $activePlugins->contains($plugin->getFile());
        });
    }
}
