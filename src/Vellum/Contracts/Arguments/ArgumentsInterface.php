<?php

namespace Vellum\Contracts\Arguments;

interface ArgumentsInterface
{
    /**
     * Returns the supplied argument by key or the default if it not in the arguments.
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public function get(string $key, $default = null);

    /**
     * Returns true if one the supplied keys is in the arguments or false if not.
     *
     * @param string[] $key
     * @return bool
     */
    public function hasOneOf(array $key): bool;

    /**
     * Returns true if the supplied keys are in the arguments or false if not.
     *
     * @param string[] $key
     * @return bool
     */
    public function hasAll(array $key): bool;

    /**
     * Returns a new Arguments object based on this and the supplied parameter.
     *
     * @param ArgumentsInterface $arguments
     * @return ArgumentsInterface
     */
    public function mergeArguments(
        ArgumentsInterface $arguments
    ): ArgumentsInterface;

    /**
     * Returns a new Arguments object with the supplied data added.
     *
     * @param string $key
     * @param mixed $value
     * @return ArgumentsInterface
     */
    public function addArgument(string $key, $value): ArgumentsInterface;

    /**
     * Returns the arguments as an array.
     *
     * @return array
     */
    public function toArray(): array;
}
