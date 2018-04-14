<?php

namespace Vellum\Inputs;

use Vellum\Inputs\Enums\Types;

class TextInputTest extends AbstractInputsTest
{
    protected function createInput(): AbstractInput
    {
        return new TextInput(
            'test',
            'Test',
            'default',
            'Testing'
        );
    }

    protected function getType(): string
    {
        return Types::TEXT;
    }

    protected function getArray(): array
    {
        return [
            'name' => 'test',
            'description' => 'Test',
            'default_value' => 'default',
            'inputs' => [],
            'hint' => 'Testing',
            'type' => 'text',
            'format' => 'string'
        ];
    }

}
