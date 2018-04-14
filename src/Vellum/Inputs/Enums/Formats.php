<?php

namespace Vellum\Inputs\Enums;

class Formats extends AbstractEnum
{
    public const TEXT = 'string';
    public const NUMBER = 'int';
    public const ARRAY = 'array';

    /**
     * @return string[]
     */
    public static function toArray(): array
    {
        return [
            'TEXT' => 'string',
            'NUMBER' => 'int',
            'ARRAY' => 'array',
        ];
    }
}
