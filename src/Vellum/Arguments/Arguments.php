<?php

namespace Vellum\Arguments;

use Vellum\Contracts\Arguments\ArgumentsInterface;

final class Arguments implements ArgumentsInterface
{
    /** @var \Adbar\Dot */
    private $arguments;

    public function __construct(array $arguments)
    {
        $this->arguments = new \Adbar\Dot($arguments);
    }

    public function get(string $key, $default = null)
    {
        return $this->arguments->get($key, $default);
    }

    public function hasOneOf(array $keys): bool
    {
        foreach ($keys as $key) {
            if ($this->arguments->has($key)) {
                return true;
            }
        }

        return false;
    }

    public function hasAll(array $keys): bool
    {
        return $this->arguments->has($keys);
    }

    public function mergeArguments(
        ArgumentsInterface $arguments
    ): ArgumentsInterface {
        return new Arguments(
            \Vellum\Helpers\recursive_array_merge(
                $this->toArray(),
                $arguments->toArray()
            )
        );
    }

    /**
     * @param string $key
     * @param mixed $value
     * @return ArgumentsInterface
     *
     * @throws \InvalidArgumentException
     */
    public function addArgument(string $key, $value): ArgumentsInterface
    {
        if ($this->hasOneOf([$key])) {
            throw new \InvalidArgumentException(
                "An argument exists at '{$key}'."
            );
        }

        $new_arguments = $this->arguments;

        $new_arguments->set($key, $value);

        return new Arguments($new_arguments->all());
    }

    public function toArray(): array
    {
        return $this->arguments->all();
    }
}
