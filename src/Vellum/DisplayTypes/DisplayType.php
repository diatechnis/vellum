<?php

namespace Vellum\DisplayTypes;

use Vellum\Contracts\ArrayableInterface;
use Vellum\Contracts\DisplayTypes\DisplayTypeInterface;
use Vellum\Contracts\Inputs\InputsInterface;
use Vellum\Inputs\Inputs;

final class DisplayType implements DisplayTypeInterface, ArrayableInterface
{
    /** @var string */
    private $name;
    /** @var string */
    private $description;
    /** @var InputsInterface */
    private $inputs;
    /** @var bool */
    private $is_default;

    public function __construct(
        string $name,
        InputsInterface $inputs = null,
        string $description = '',
        bool $is_default_type = false
    ) {
        $this->name = $name;

        if (null === $inputs) {
            $inputs = new Inputs();
        }
        $this->inputs = $inputs;

        $this->description = $description;

        $this->is_default = $is_default_type;
    }

    public function getIdentifier(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getInputs(): InputsInterface
    {
        return $this->inputs;
    }

    public function hasInputs(): bool
    {
        return ! empty($this->inputs->toArray());
    }

    public function isDefault(): bool
    {
        return $this->is_default;
    }

    public function setDefault(bool $is_default): DisplayTypeInterface
    {
        return new self(
            $this->getIdentifier(),
            $this->getInputs(),
            $this->getDescription(),
            $is_default
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
            'inputs' => $this->inputs->toArray(),
            'is_default' => $this->is_default
        ];
    }
}
