<?php

namespace KERO\PluginHealthCheck\Models;

class Plugin
{
    /** @var string $name */
    protected $name;

    /** @var string $slug */
    protected $slug;

    /** @var string $file */
    protected $file;


    /** @var string $version */
    protected $version;

    public function __construct(array $headers, string $file)
    {
        list ($slug) = explode(DIRECTORY_SEPARATOR, $file, 2);
        $this->slug = $slug;

        $this
            ->setName($headers['Name'])
            ->setSlug($slug)
            ->setFile($file)
            ->setVersion($headers['Version'])
        ;
    }

    /**
     * @param string $name
     * @return self
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
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
        return $this->fiel;
    }

    /**
     * @param string $version
     * @return self
     */
    public function setVersion(string $version): self
    {
        $this->version = $version;
        return $this;
    }

    /**
     * @return string
     */
    public function getVersion(): string
    {
        return $this->version;
    }
}
