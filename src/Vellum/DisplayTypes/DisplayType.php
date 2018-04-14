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
    private $options;
    /** @var bool */
    private $is_default;

    public function __construct(
        string $name,
        InputsInterface $options = null,
        string $description = '',
        bool $is_default_type = false
    ) {
        $this->name = $name;

        if (null === $options) {
            $options = new Inputs();
        }
        $this->options = $options;

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

    public function getOptions(): InputsInterface
    {
        return $this->options;
    }

    public function hasOptions(): bool
    {
        return ! empty($this->options->toArray());
    }

    public function isDefault(): bool
    {
        return $this->is_default;
    }

    public function setDefault(bool $is_default): DisplayTypeInterface
    {
        return new self(
            $this->getIdentifier(),
            $this->getOptions(),
            $this->getDescription(),
            $is_default
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
            'inputs' => $this->options->toArray(),
            'is_default' => $this->is_default
        ];
    }
}
