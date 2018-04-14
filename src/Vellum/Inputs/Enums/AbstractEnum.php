<?php

namespace Vellum\Inputs\Enums;

class AbstractEnum
{
    public static function toArray(): array
    {
        // TODO get constants by reflection?
        return [];
    }

    public static function in($value): bool
    {
        return \in_array($value, static::values(), true);
    }

    /**
     * @return string[]
     */
    public static function keys(): array
    {
        return \array_keys(static::toArray());
    }

    /**
     * @return string[]
     */
    public static function values(): array
    {
        return \array_values(static::toArray());
    }
}
