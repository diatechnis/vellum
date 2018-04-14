<?php

namespace Tests\Renderers;

use Vellum\Contracts\Components\ComponentInterface;
use Vellum\Contracts\Renderers\RenderInterface;

final class ClassNameRenderer implements RenderInterface
{
    public function render(ComponentInterface $component): string
    {
        return \get_class($component);
    }
}
