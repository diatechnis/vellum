<?php

namespace Vellum\Path;

use Vellum\Contracts\Components\ComponentInterface;

class SimpleTemplatePathResolver implements TemplatePathInterface
{
    /** @var string */
    private $extension;
    /** @var string */
    private $base_path;

    public function __construct(string $extension, string $base_path = '')
    {
        $this->extension = $extension;
        $this->base_path = $base_path;
    }

    public function resolve(ComponentInterface $component): string
    {
        $class = \get_class($component);
        $parts = explode('\\', $class);
        $last_segment = \substr_count($class, '\\');

        return $this->base_path . strtolower($parts[$last_segment - 1]) .
            '/' . strtolower($parts[$last_segment]) . $this->extension;
    }
}
