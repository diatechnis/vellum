<?php

namespace Vellum\Path;

use Vellum\Contracts\Components\ComponentInterface;

interface TemplatePathInterface
{
    public function resolve(
        ComponentInterface $component,
        bool $with_base_path = true
    ): string;

    public function getBasePath(): string;
}
