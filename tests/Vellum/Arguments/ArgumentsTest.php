<?php

namespace Vellum\Arguments;

use PHPUnit\Framework\TestCase;

class ArgumentsTest extends TestCase
{
    public function test_get_returns_null()
    {
        $this->assertNull($this->createArguments()->get('nonexistent'));
    }

    public function test_get_returns_default()
    {
        $this->assertEquals(
            'default_value',
            $this->createArguments()->get(
                'nonexistent',
                'default_value'
            )
        );
    }

    public function test_get_returns_argument_value()
    {
        $this->assertEquals(
            false,
            $this->createArguments()->get('third')
        );
    }

    public function test_get_dot_syntax_returns_value()
    {
        $this->assertEquals(
            2,
            $this->createArguments()->get('second.two')
        );
    }
    
    public function test_has_one_of_returns_true()
    {
        $arguments = $this->createArguments();

        $this->assertTrue(
            $arguments->hasOneOf(['third'])
        );

        $this->assertTrue(
            $arguments->hasOneOf(['empty', 'nonexistent', 'third'])
        );

        $this->assertTrue(
            $arguments->hasOneOf(['empty', 'second', 'third'])
        );
    }

    public function test_has_one_of_returns_false()
    {
        $arguments = $this->createArguments();

        $this->assertFalse(
            $arguments->hasOneOf(['nonexistent'])
        );

        $this->assertFalse(
            $arguments->hasOneOf(['empty', 'nonexistent'])
        );
    }

    public function test_has_all_returns_true()
    {
        $arguments = $this->createArguments();

        $this->assertTrue(
            $arguments->hasAll(['first'])
        );

        $this->assertTrue(
            $arguments->hasAll(['first', 'third'])
        );

        $this->assertTrue(
            $arguments->hasAll(['first', 'second', 'third'])
        );
    }
    
    public function test_has_all_returns_false()
    {
        $arguments = $this->createArguments();

        $this->assertFalse(
            $arguments->hasAll(['nonexistent'])
        );

        $this->assertFalse(
            $arguments->hasAll(['first', 'third', 'nonexistent'])
        );

        $this->assertFalse(
            $arguments->hasAll(['first', 'second', 'third', 'empty'])
        );
    }
    
    public function test_merge_arguments_returns_new_arguments()
    {
        $arguments = $this->createArguments();

        $merged = $arguments->mergeArguments(new Arguments([
            'second' => ['twice' => 'times'],
            'test' => true
        ]));

        $this->assertNotSame($arguments, $merged);

        $this->assertEquals(
            [
                'first' => 'one',
                'second' => [
                    'two' => 2,
                    'twice' => 'times'
                ],
                'third' => false,
                'test' => true
            ],
            $merged->toArray()
        );
    }
    
    public function test_add_argument_returns_new_arguments()
    {
        $arguments = $this->createArguments();

        $added = $arguments->addArgument('second.twice', 'times');

        $this->assertNotSame($arguments, $added);

        $this->assertEquals(
            [
                'first' => 'one',
                'second' => [
                    'two' => 2,
                    'twice' => 'times'
                ],
                'third' => false
            ],
            $added->toArray()
        );
    }

    public function test_to_array()
    {
        $this->assertEquals(
            [
                'first' => 'one',
                'second' => ['two' => 2],
                'third' => false
            ],
            $this->createArguments()->toArray()
        );
    }

    private function createArguments(array $arguments = [])
    {
        return new Arguments(\array_merge(
            [
                'first' => 'one',
                'second' => ['two' => 2],
                'third' => false
            ],
            $arguments
        ));
    }
}
