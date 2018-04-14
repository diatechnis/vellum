<?php

namespace Vellum\Inputs;

use PHPUnit\Framework\TestCase;
use Vellum\Inputs\Options\Options;
use Vellum\Inputs\Options\Option;

class OptionsTest extends TestCase
{
    public function test_get_returns_last_choice()
    {
        $this->assertEquals(
            'Number Two',
            $this->createChoices()->get('last')->getValue()
        );
    }

    public function test_get_with_null_returns_first_choice()
    {
        $this->assertEquals(
            'Number One',
            $this->createChoices()->get()->getValue()
        );
    }
    public function test_get_with_default_string_returns_first_choice()
    {
        $this->assertEquals(
            'Number One',
            $this->createChoices()->get('default')->getValue()
        );
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function test_get_throws_exception()
    {
        $this->createChoices()->get('nonexistent');
    }

    private function createChoices(): Options
    {
        return new Options(
            new Option('first', 'Number One'),
            new Option('last', 'Number Two')
        );
    }

//    public function test_get_choices() {}

//    public function test_to_array() {}
}
