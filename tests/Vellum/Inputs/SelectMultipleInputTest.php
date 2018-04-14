<?php

namespace Vellum\Inputs;

use Vellum\Inputs\Enums\Formats;
use Vellum\Inputs\Enums\Types;
use Vellum\Inputs\Options\Option;
use Vellum\Inputs\Options\Options;

class SelectMultipleInputTest extends AbstractInputsTest
{
    protected function createInput(): AbstractInput
    {
        return new SelectMultipleInput(
            'test',
            'Test',
            new Options(
                new Option('one', 'One'),
                new Option('two', 'Two')
            ),
            '[]',
            'Testing'
        );
    }

    protected function getType(): string
    {
        return Types::CHECKBOX;
    }

    protected function getFormat(): string
    {
        return Formats::ARRAY;
    }

    protected function getDefaultValue()
    {
        return '[]';
    }

    protected function getArray(): array
    {
        return [
            'name' => 'test',
            'description' => 'Test',
            'default_value' => '[]',
            'inputs' => [
                ['name' => 'one', 'value' => 'One'],
                ['name' => 'two', 'value' => 'Two']
            ],
            'hint' => 'Testing',
            'type' => 'checkbox',
            'format' => 'array'
        ];
    }
}
