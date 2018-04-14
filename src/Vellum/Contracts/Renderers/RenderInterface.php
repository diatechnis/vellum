<?php

namespace Vellum\Contracts\Renderers;

use Vellum\Contracts\Components\ComponentInterface;

interface RenderInterface
{
    public function render(ComponentInterface $component): string;
}
