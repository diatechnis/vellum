<?php

namespace Vellum\Path;

use Vellum\Contracts\Components\ComponentInterface;

interface TemplatePathInterface
{
    public function resolve(ComponentInterface $component): string;

    public function getBasePath(): string;
}
