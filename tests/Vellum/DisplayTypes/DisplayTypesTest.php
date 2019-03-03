<?php

namespace Vellum\DisplayTypes;

use PHPUnit\Framework\TestCase;
use Vellum\Contracts\DisplayTypes\DisplayTypesInterface;
use Vellum\Inputs\Inputs;
use Vellum\Inputs\TextInput;

class DisplayTypesTest extends TestCase
{
    public function test_get_display_type_returns_default_with_null_key()
    {
        $this->assertEquals(
            new DisplayType(
                'submit',
                $this->createInputs('Submit'),
                'Submit',
                $is_default = true
            ),
            $this->createPopulatedDisplayTypes()->getDisplayType()
        );
    }

    public function test_get_display_type_returns_default_with_default_key()
    {
        $this->assertEquals(
            new DisplayType(
                'submit',
                $this->createInputs('Submit'),
                'Submit',
                $is_default = true
            ),
            $this->createPopulatedDisplayTypes()->getDisplayType('default')
        );
    }

    public function test_get_display_type_returns_type_with_key()
    {
        $this->assertEquals(
            new DisplayType(
                'cancel',
                $this->createInputs('Cancel'),
                'Cancel',
                $is_default = false
            ),
            $this->createPopulatedDisplayTypes()->getDisplayType('cancel')
        );
    }

    public function test_get_display_type_returns_empty_type_with_key()
    {
        $this->assertEquals(
            new DisplayType(
                '',
                null,
                '',
                $is_default = false
            ),
            $this->createPopulatedDisplayTypes()->getDisplayType('nothing')
        );
    }

    public function test_create_arguments_returns_default_display_type()
    {
        $display = new DisplayTypes();

        $arguments = $display->createArguments()->toArray();

        $this->assertEquals(
            ['display_type' => ['identifier' => 'default']],
            $arguments
        );
    }

    public function test_create_arguments_returns_options()
    {
        $display = $this->createPopulatedDisplayTypes();

        $arguments = $display->createArguments([
            'display_type' => [
                'identifier' => 'cancel',
                'arguments' => [
                    'button_text' => 'Disengage!'
                ]
            ]
        ])->toArray();

        $this->assertEquals(
            [
                'display_type' => [
                    'identifier' => 'cancel',
                    'button_text' => 'Disengage!'
                ],
            ],
            $arguments
        );
    }

    public function test_get_inputs_returns_input_array()
    {
        $display = $this->createPopulatedDisplayTypes();

        $options = $display->toArray();

        $this->assertArraySubset(
            [
                'name' => 'display_type',
                'description' => 'Display Type',
                'default_value' => 'submit',
                'type' => 'select',
                'format' => 'string',
                'inputs' => [
                    [
                        'name' => 'submit',
                        'description' => 'Submit',
                        'inputs' => [],
                        'is_default' => true
                    ],
                    [
                        'name' => 'cancel',
                        'description' => 'Cancel',
                        'inputs' => [],
                        'is_default' => false
                    ]
                ]
            ],
            $options
        );
    }

    public function test_merge_combines_inputs()
    {
        $display = $this->createPopulatedDisplayTypes();

        $inputs = new Inputs(
            new TextInput('test', 'Test')
        );

        $merged = $display->mergeInputs($inputs)->toArray();

        $this->assertArraySubset(
            [
                ['name' => 'display_type'],
                ['name' => 'test'],
            ],
            $merged
        );
    }

    public function test_to_array()
    {
        $this->assertArraySubset(
            [
                'name' => 'display_type',
                'description' => 'Display Type',
                'type' => 'select',
                'hint' => 'How should this component look?',
                'format' => 'string',
                'inputs' => [
                        [
                            'name' => 'submit',
                            'description' => 'Submit',
                            'is_default' => true,
                            'inputs' => []
                        ],
                        [
                            'name' => 'cancel',
                            'description' => 'Cancel',
                            'is_default' => false,
                            'inputs' => []
                        ]
                ]
            ],
            $this->createPopulatedDisplayTypes()->toArray()
        );
    }

    private function createPopulatedDisplayTypes(): DisplayTypesInterface
    {
        return new DisplayTypes(
            new DisplayType(
                'submit',
                $this->createInputs('Submit'),
                'Submit',
                $is_default = true
            ),
            new DisplayType(
                'cancel',
                $this->createInputs('Cancel'),
                'Cancel'
            )
        );
    }

    private function createInputs(string $description): Inputs
    {
        return new Inputs(
            new TextInput('button_text', $description)
        );
    }
}
