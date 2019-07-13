<?php

namespace KERO\PluginHealthCheck\Models;

class Plugin extends AbstractDependency
{
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
}
