<?php

namespace Vellum\Contracts\Inputs;

use Vellum\Contracts\Arguments\ArgumentsInterface;

interface InputsInterface
{
    public function add(InputInterface $input);

    /**
     * @return InputInterface[]
     */
    public function get(): array;

    public function toArray(): array;

    /**
     * Creates an arguments object from this and the supplied argument data.
     *
     * @param array $argument_data
     * @param string $namespace The key under which to assign the arguments.
     * @return ArgumentsInterface
     */
    public function createArguments(
        array $argument_data = [],
        string $namespace = null
    ): ArgumentsInterface;
}
