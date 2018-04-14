<?php

namespace Vellum\DisplayTypes;

use PHPUnit\Framework\TestCase;
use Vellum\Contracts\DisplayTypes\DisplayTypeInterface;
use Vellum\Inputs\Inputs;
use Vellum\Inputs\TextInput;

class DisplayTypeTest extends TestCase
{
    public function test_get_identifier_returns_string()
    {
        $this->assertEquals(
            'testing',
            $this->createDisplayType()->getIdentifier()
        );
    }

    public function test_get_description_returns_string()
    {
        $this->assertEquals(
            'Testing Display Type',
            $this->createDisplayType()->getDescription()
        );
    }

    public function test_get_options_returns_inputs()
    {
        $this->assertEquals(
            new Inputs(
                new TextInput('text_option', 'Text Option')
            ),
            $this->createDisplayType()->getOptions()
        );
    }

    public function test_has_options_returns_bool()
    {
        $this->assertTrue($this->createDisplayType()->hasOptions());
    }

    public function test_is_default_returns_true()
    {
        $this->assertTrue($this->createDisplayType()->isDefault());
    }

    public function test_is_default_returns_false()
    {
        $display = new DisplayType(
            'testing',
            null,
            'Testing',
            false
        );

        $this->assertFalse($display->isDefault());
    }

    public function test_set_default_returns_false()
    {
        $this->assertFalse(
            $this->createDisplayType()->setDefault(false)->isDefault()
        );
    }

    public function test_to_array_returns_array()
    {
        $this->assertArraySubset(
            [
                'name' => 'testing',
                'description' => 'Testing Display Type',
                'inputs' => [],
                'is_default' => true
            ],
            $this->createDisplayType()->toArray()
        );
    }

    private function createDisplayType(): DisplayTypeInterface
    {
        return new DisplayType(
            'testing',
            new Inputs(
                new TextInput('text_option', 'Text Option')
            ),
            'Testing Display Type',
            $is_default = true
        );
    }
}
