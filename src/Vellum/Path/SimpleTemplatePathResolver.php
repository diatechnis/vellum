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

    public function resolve(
        ComponentInterface $component,
        bool $with_base_path = true
    ): string {
        $class = \get_class($component);
        $parts = explode('\\', $class);
        $last_segment = \substr_count($class, '\\');

        $path = strtolower($parts[$last_segment - 1]) . '/' .
            strtolower($parts[$last_segment]) .
            $this->extension;

        if ($with_base_path) {
            return $this->base_path . $path;
        }

        return $path;
    }

    public function getBasePath(): string
    {
        return $this->base_path;
    }
}
