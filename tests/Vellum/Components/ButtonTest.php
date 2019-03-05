<?php

namespace Vellum\Components;

use Tests\Components\Elements\Button;

class ButtonTest extends \PHPUnit\Framework\TestCase
{
    public function test_get_arguments_returns_defaults(): void
    {
        $arguments = (new Button())->getArguments()->toArray();

        $this->assertEquals(
            [
                'button_text' => 'Submit',
                'display_type' => ['identifier' => 'submit']
            ],
            $arguments
        );
    }

    public function test_get_arguments_returns_input(): void
    {
        $arguments = (new Button([
            'button_text' => 'Sally forth!'
        ]))->getArguments()->toArray();

        $this->assertEquals(
            [
                'button_text' => 'Sally forth!',
                'display_type' => ['identifier' => 'submit']
            ],
            $arguments
        );
    }

    public function test_get_all_inputs_returns_combined_types_and_inputs()
    {
        $inputs = (new Button())->getAllInputs()->toArray();

        $this->assertArraySubset([
                'name' => 'display_type',
                'description' => 'Display Type',
                'type' => 'select',
                'hint' => 'How should this component look?',
                'format' => 'string',
                'inputs' => [
                    ['name' => 'submit'],
                    ['name' => 'cancel'],
                    ['name' => 'warning']
                ],
                'default_value' => 'submit',
            ],
            $inputs[0]
        );

        $this->assertEquals([
                'name' => 'button_text',
                'description' => 'Button Text',
                'type' => 'text',
                'hint' => '',
                'format' => 'string',
                'inputs' => [],
                'default_value' => 'Submit',
            ],
            $inputs[1]
        );
    }

    public function test_returns_rendered_string()
    {
        $this->assertEquals(Button::class, (new Button())->render());
    }

    public function test_to_array_has_keys_in_alpha_order()
    {
        $array = (new Button())->toArray(true);

        $this->assertEquals(
            ['arguments', 'display_types', 'inputs'],
            array_keys($array)
        );
    }
}
