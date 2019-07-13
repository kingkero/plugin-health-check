<?php

namespace KERO\PluginHealthCheck\Models;

class WPPlugin
{
    private $headers = [];
    private $slug;
    private $file;

    /**
     * Create a new WPPlugin instance.
     *
     * @param array $headers the plugin headers
     * @param string $file relative path to the main plugin file
     */
    public function __construct(array $headers, string $file)
    {
        list ($slug) = explode(DIRECTORY_SEPARATOR, $file, 2);

        $this
            ->setHeaders($headers)
            ->setSlug($slug)
            ->setFile($file)
        ;
    }

    /**
     * @param array $headers
     * @return self
     */
    public function setHeaders(array $headers): self
    {
        $this->headers = $headers;
        return $this;
    }

    /**
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * @param string $slug
     * @return self
     */
    public function setSlug(string $slug): self
    {
        $this->slug = $slug;
        return $this;
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @param string $file
     * @return self
     */
    public function setFile(string $file): self
    {
        $this->file = $file;
        return $this;
    }

    /**
     * @return string
     */
    public function getFile(): string
    {
        return $this->file;
    }
}
