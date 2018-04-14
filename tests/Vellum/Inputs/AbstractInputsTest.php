<?php

namespace Vellum\Inputs;

use PHPUnit\Framework\TestCase;

abstract class AbstractInputsTest extends TestCase
{
    public function test_get_type()
    {
        $this->assertEquals(
            $this->getType(),
            $this->createInput()->getType()
        );
    }

    public function test_get_identifier()
    {
        $this->assertEquals(
            $this->getIdentifier(),
            $this->createInput()->getIdentifier()
        );
    }

    public function test_get_description()
    {
        $this->assertEquals(
            $this->getDescription(),
            $this->createInput()->getDescription()
        );
    }

    public function test_get_format()
    {
        $this->assertEquals(
            $this->getFormat(),
            $this->createInput()->getFormat()
        );
    }

    public function test_get_hint()
    {
        $this->assertEquals(
            $this->getHint(),
            $this->createInput()->getHint()
        );
    }

    public function test_get_default_value()
    {
        $this->assertEquals(
            $this->getDefaultValue(),
            $this->createInput()->getDefaultValue()
        );
    }

    public function test_to_array()
    {
        $this->assertEquals(
            $this->getArray(),
            $this->createInput()->toArray()
        );
    }
    
    abstract protected function getType(): string;
    
    abstract protected function getArray(): array;
    
    abstract protected function createInput(): AbstractInput;
    
    protected function getIdentifier(): string
    {
        return 'test';
    }

    protected function getDescription(): ?string
    {
        return 'Test';
    }

    protected function getFormat(): string
    {
        return 'string';
    }

    protected function getHint(): string
    {
        return 'Testing';
    }

    protected function getDefaultValue()
    {
        return 'default';
    }
}
