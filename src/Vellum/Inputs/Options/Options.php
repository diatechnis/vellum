<?php

namespace Vellum\Inputs\Options;

use Vellum\Contracts\ArrayableInterface;

final class Options implements ArrayableInterface
{
    private $choices = [];

    public function __construct(Option ...$choices)
    {
        foreach ($choices as $choice) {
            $this->add($choice);
        }
    }

    public function get(string $name = null): Option
    {
        if (null === $name || 'default' === $name) {
            return \current($this->choices);
        }

        if (isset($this->choices[$name])) {
            return $this->choices[$name];
        }

        throw new \InvalidArgumentException(
            "Could not find choice at key '{$name}'"
        );
    }

    public function getChoices(): array
    {
        return $this->choices;
    }

    public function toArray(): array
    {
        $choices = [];

        foreach ($this->choices as $choice) {
            $choices[] = $choice->toArray();
        }

        return $choices;
    }

    private function add(Option $choice): Options
    {
        $this->choices[$choice->getName()] = $choice;

        return $this;
    }
}
