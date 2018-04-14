<?php

namespace Vellum\Renderers;

use Vellum\Contracts\Components\ComponentInterface;
use Vellum\Contracts\Renderers\RenderInterface;

final class EmptyRenderer implements RenderInterface
{
    public function render(ComponentInterface $arguments): string
    {
        return '';
    }
}
