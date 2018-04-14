<?php

namespace Vellum\Inputs\Options;

use Vellum\Contracts\ArrayableInterface;

final class Option implements ArrayableInterface
{
    /** @var string */
    private $name;
    /** @var string */
    private $value;

    public function __construct(string $name, string $value)
    {
        $this->name = $name;
        $this->value = $value;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function toArray(): array
    {
        return ['name' => $this->getName(), 'value' => $this->getValue()];
    }
}
