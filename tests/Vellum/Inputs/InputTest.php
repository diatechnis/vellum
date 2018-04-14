<?php

namespace Vellum\Inputs;

use Tests\Inputs\Input;
use PHPUnit\Framework\TestCase;
use Vellum\Inputs\Enums\Formats;
use Vellum\Inputs\Enums\Types;

class InputTest extends TestCase
{
    /**
     * @expectedException \Vellum\Inputs\Exceptions\InvalidTypeException
     */
    public function test_constructor_throws_type_exception()
    {
        new Input(
            'test',
            'Test',
            'nonexistent',
            Formats::TEXT
        );
    }

    /**
     * @expectedException \Vellum\Inputs\Exceptions\InvalidFormatException
     */
    public function test_constructor_throws_format_exception()
    {
        new Input(
            'test',
            'Test',
            Types::TEXT,
            'nonexistent'
        );
    }
}
