<?php

namespace Vellum\Contracts\DisplayTypes;


use Vellum\Contracts\Arguments\ArgumentsInterface;
use Vellum\Contracts\Inputs\InputsInterface;

interface DisplayTypesInterface
{
    /**
     * Returns the display type at the supplied key.
     *
     * If the key is empty or the string, "default", then this will return the
     * default display type. If a match is not found, it will return an empty
     * display type.
     *
     * @param string|null $key
     * @return DisplayTypeInterface
     */
    public function getDisplayType(string $key = null): DisplayTypeInterface;

    public function mergeInputs(
        InputsInterface $inputs
    ): InputsInterface;

    public function createArguments(
        array $argument_data = [],
        string $namespace = null
    ): ArgumentsInterface;

    public function toArray(): array;
}
