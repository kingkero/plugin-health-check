<?php

namespace KERO\PluginHealthCheck\Models;

class Plugin extends AbstractDependency
{
    /** @var string $latestVersion */
    protected $latestVersion;

    /**
     * Create a Plugin instance.
     *
     * @param array $headers
     * @param string $file
     */
    public function __construct(array $headers, string $file)
    {
        list ($slug) = explode(DIRECTORY_SEPARATOR, $file, 2);

        $this
            ->setName($headers['Name'])
            ->setSlug($slug)
            ->setFile($file)
            ->setVersion($headers['Version'])
        ;
    }

    /**
     * Get the latest version via the WordPress.org API.
     *
     * Using \plugins_api() to retrieve the plugin data, this function filters
     * the version number by "version_compare", so so the result is only reliable
     * for version numbers in SemVer format or similar.
     *
     * @see https://www.php.net/manual/en/function.version-compare.php
     *
     * @return string|null latest version or null if API returned an error
     */
    public function getLatestVersion(): ?string
    {
        $args = [
            'slug' => $this->getSlug(),
            'fields' => [
                'versions' => true,
                'last_updated' => true,
                'short_description' => false,
                'description' => false,
                'sections' => false,
                'rating' => false,
                'ratings' => false,
                'downloaded' => false,
                'download_link' => false,
                'added' => false,
                'tags' => false,
                'homepage' => false,
                'donate_link' => false,
                'contributors' => false,
                'num_ratings' => false,
                'active_installs' => false,
            ],
        ];
        $apiResponse = \plugins_api('plugin_information', $args);

        if ($apiResponse instanceof \WP_Error) {
            return null;
        }

        unset($apiResponse->versions['trunk']);
        $versions = array_keys($apiResponse->versions);
        usort($versions, 'version_compare');
        return array_pop($versions);
    }

    /**
     * Check if the plugin uses the latest available version.
     *
     * @return boolean
     */
    public function isCurrentVersion(): bool
    {
        $latestVersion = $this->getLatestVersion();

        // to avoid false positives, return true for not found plugins
        //TODO: handle better
        return $latestVersion === null || $this->getLatestVersion() === $this->getVersion();
    }
}
