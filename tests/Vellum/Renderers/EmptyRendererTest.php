<?php

namespace Vellum\Renderers;

use PHPUnit\Framework\TestCase;
use Tests\Components\Elements\Button;

class EmptyRendererTest extends TestCase
{
    public function test_render_returns_empty_string()
    {
        $renderer = new EmptyRenderer();

        $this->assertEquals('', $renderer->render(new Button()));
    }
}
