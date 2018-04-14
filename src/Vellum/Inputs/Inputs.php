<?php

namespace Vellum\Inputs;

use Vellum\Arguments\Arguments;
use Vellum\Contracts\Arguments\ArgumentsInterface;
use Vellum\Contracts\ArrayableInterface;
use Vellum\Contracts\Inputs\InputInterface;
use Vellum\Contracts\Inputs\InputsInterface;

final class Inputs implements InputsInterface, ArrayableInterface
{
    /** @var InputInterface[] */
    private $inputs;

    public function __construct(InputInterface ...$inputs)
    {
        $this->inputs = $inputs;
    }

    public function get(): array
    {
        return $this->inputs;
    }

    /**
     * @param InputInterface $input
     * @return $this
     */
    public function add(InputInterface $input): self
    {
        $this->inputs[] = $input;

        return $this;
    }

    public function createArguments(
        array $argument_data = [],
        string $namespace = null
    ): ArgumentsInterface {
        $defaults = [];

        foreach($this->inputs as $input) {
            if (null !== $input->getDefaultValue()) {
                $defaults[$input->getIdentifier()] = $input->getDefaultValue();
            }
        }

        $merged = \array_merge($defaults, $argument_data);

        if (null !== $namespace) {
            $merged = [$namespace => $merged];

        }

        return new Arguments($merged);
    }

    public function toArray(): array
    {
        $inputs = [];

        foreach($this->inputs as $input) {
            $inputs[] = $input->toArray();
        }
        
        return $inputs;
    }
}
