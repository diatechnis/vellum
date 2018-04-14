<?php

namespace Vellum\Inputs;

use Vellum\Inputs\Enums\Formats;
use Vellum\Inputs\Enums\Types;
use Vellum\Inputs\Options\Option;
use Vellum\Inputs\Options\Options;

class ArrayOfObjectsInputTest extends AbstractInputsTest
{
    protected function createInput(): AbstractInput
    {
        $hint = 'Testing';

        return new ArrayOfObjectsInput(
            'players',
            'Role Players',
            new Inputs(
                new TextInput(
                    'pseudonym',
                    'Character Name',
                    'Mirk',
                    $hint
                ),
                new SelectOneInput(
                    'alter_ego',
                    'Alter Ego',
                    Formats::TEXT,
                    new Options(
                        new Option('wizard', 'Wizard'),
                        new Option('warrior', 'Warrior'),
                        new Option('ranger', 'Ranger')
                    ),
                    'wizard',
                    $hint
                )
            ),
            $hint
        );
    }

    protected function getIdentifier(): string
    {
        return 'players';
    }

    protected function getDescription(): ?string
    {
        return 'Role Players';
    }

    protected function getType(): string
    {
        return Types::APP;
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
            'name' => 'players',
            'description' => 'Role Players',
            'default_value' => '[]',
            'inputs' => [
                [
                    'name' => 'pseudonym',
                    'description' => 'Character Name',
                    'default_value' => 'Mirk',
                    'inputs' => [],
                    'hint' => 'Testing',
                    'type' => 'text',
                    'format' => 'string'
                ],
                [
                    'name' => 'alter_ego',
                    'description' => 'Alter Ego',
                    'default_value' => 'wizard',
                    'inputs' => [
                        [
                            'name' => 'wizard',
                            'value' => 'Wizard'
                        ],
                        [
                            'name' => 'warrior',
                            'value' => 'Warrior'
                        ],
                        [
                            'name' => 'ranger',
                            'value' => 'Ranger'
                        ]
                    ],
                    'hint' => 'Testing',
                    'type' => 'select',
                    'format' => 'string'
                ]
            ],
            'hint' => 'Testing',
            'type' => 'app',
            'format' => 'array'
        ];
    }
}
