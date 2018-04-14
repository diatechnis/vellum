<?php

namespace Vellum\Contracts\Inputs;

interface InputInterface
{
    public function getType(): string;

    public function getIdentifier(): string;

    public function getDescription(): ?string;

    public function getFormat(): string;

    public function getHint(): string;

    /**
     * @return mixed
     */
    public function getDefaultValue();

    public function toArray(): array;
}
