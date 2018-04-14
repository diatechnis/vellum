<?php

namespace Vellum\Renderers;

use PHPUnit\Framework\TestCase;
use Tests\Components\Elements\Button;
use Tests\Renderers\ClassNameRenderer;

class ClassNameRendererTest extends TestCase
{
    public function test_render_returns_class_name()
    {
        $renderer = new ClassNameRenderer();

        $name = $renderer->render(new Button());

        $this->assertEquals(Button::class, $name);
    }
}
