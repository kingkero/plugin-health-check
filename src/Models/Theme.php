<?php

namespace KERO\PluginHealthCheck\Models;

class Theme extends AbstractDependency
{
    /** @var \WP_Theme $theme */
    protected $theme;

    public function __construct(array $data, string $slug)
    {
        $theme = new \WP_Theme($slug, $data['theme_root']);

        $this
            ->setTheme($theme)
            ->setName($theme->get('Name'))
            ->setSlug($slug)
            ->setVersion($theme->get('Version'))
        ;
    }

    public function setTheme(\WP_Theme $theme): self
    {
        $this->theme = $theme;
        return $this;
    }

    public function getTheme(): \WP_Theme
    {
        return $this->theme;
    }
}
