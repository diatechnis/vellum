<?php

namespace Tests\Vellum\Options;

use Vellum\Inputs\Inputs;
use Vellum\Inputs\TextInput;

class OptionsTest extends \PHPUnit\Framework\TestCase
{
    public function test_add_option_sets_on_array()
    {
        $options = new Inputs();

        $array = $options->toArray();

        $this->assertCount(0, $array);

        $options->add(new TextInput('test', 'Test'));

        $array = $options->toArray();

        $this->assertCount(1, $array);

        $this->assertArraySubset(
            ['name' => 'test', 'description' => 'Test'],
            $array[0]
        );
    }

    public function test_create_arguments_returns_empty_arguments()
    {
        $options = new Inputs();

        $arguments = $options->createArguments();

        $this->assertEquals([], $arguments->toArray());
    }

    public function test_create_arguments_returns_default_arguments()
    {
        $options = new Inputs();

        $option = new TextInput(
            'default',
            'Default Inputs',
            'Default text'
        );

        $options->add($option);

        $arguments = $options->createArguments();

        $this->assertEquals(
            [$option->getIdentifier() => $option->getDefaultValue()],
            $arguments->toArray()
        );
    }
}
