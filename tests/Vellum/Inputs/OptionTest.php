<?php

namespace Vellum\Inputs;

use PHPUnit\Framework\TestCase;
use Vellum\Inputs\Options\Option;

class OptionTest extends TestCase
{
    public function test_get_name()
    {
        $this->assertEquals(
            'testing',
            $this->createChoice()->getName()
        );
    }

    public function test_get_value()
    {
        $this->assertEquals(
            'One, Two, Three',
            $this->createChoice()->getValue()
        );
    }

    public function test_to_array()
    {
        $this->assertEquals(
            ['name' => 'testing', 'value' => 'One, Two, Three'],
            $this->createChoice()->toArray()
        );
    }

    private function createChoice(): Option
    {
        return new Option('testing', 'One, Two, Three');
    }
}
