<?php

namespace KERO\PluginHealthCheck\Models;

class WPPlugin
{
    private $headers = [];
    private $slug;
    private $file;

    public function __construct(array $headers, string $file)
    {
        list ($slug) = explode(DIRECTORY_SEPARATOR, $file, 2);

        $this
            ->setHeaders($headers)
            ->setSlug($slug)
            ->setFile($file)
        ;
    }

    public function setHeaders(array $headers): self
    {
        $this->headers = $headers;
        return $this;
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;
        return $this;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function setFile(string $file): self
    {
        $this->file = $file;
        return $this;
    }

    public function getFile(): string
    {
        return $this->file;
    }
}
