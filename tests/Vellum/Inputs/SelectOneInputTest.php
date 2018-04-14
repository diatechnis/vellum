<?php

namespace Vellum\Inputs;

use Vellum\Inputs\Options\Options;
use Vellum\Inputs\Options\Option;
use Vellum\Inputs\Enums\Types;

class SelectOneInputTest extends AbstractInputsTest
{
    protected function createInput(): AbstractInput
    {
        return new SelectOneInput(
            'test',
            'Test',
            'string',
            new Options(new Option('one', 'One')),
            'default',
            'Testing'
        );
    }

    protected function getType(): string
    {
        return Types::SELECT;
    }

    protected function getArray(): array
    {
        return [
            'name' => 'test',
            'description' => 'Test',
            'default_value' => 'default',
            'inputs' => [
                ['name' => 'one', 'value' => 'One']
            ],
            'hint' => 'Testing',
            'type' => 'select',
            'format' => 'string'
        ];
    }
}
