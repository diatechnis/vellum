<?php

namespace Vellum\Contracts\DisplayTypes;

use Vellum\Contracts\Inputs\InputsInterface;

interface DisplayTypeInterface
{
    public function getIdentifier(): string;

    public function getDescription(): string;

    public function getOptions(): InputsInterface;

    public function hasOptions(): bool;

    public function isDefault(): bool;

    public function setDefault(bool $is_default): DisplayTypeInterface;

    public function toArray(): array;
}
