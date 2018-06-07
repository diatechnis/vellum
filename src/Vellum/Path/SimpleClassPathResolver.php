<?php

namespace Vellum\Path;

class SimpleClassPathResolver implements ClassPathInterface
{
    private $base_namespace;

    public function __construct(string $base_namespace)
    {
        $this->base_namespace = rtrim($base_namespace, '\\');
    }

    public function resolve(string $component_type, string $name): string
    {
        return $this->base_namespace . '\\' .
            ucfirst(strtolower($component_type)) . '\\' .
            ucfirst(strtolower($name));
    }
}
