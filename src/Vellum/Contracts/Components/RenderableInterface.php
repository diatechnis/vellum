<?php

namespace Vellum\Contracts\Components;

interface RenderableInterface
{
    /**
     * @return string The content to display.
     */
    public function render(): string;
}
