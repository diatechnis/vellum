<?php

namespace Vellum\Inputs\Enums;

class Types extends AbstractEnum
{
    public const APP = 'app';
    public const TEXT = 'text';
    public const NUMBER = 'number';
    public const SELECT = 'select';
    public const CHECKBOX = 'checkbox';

    /**
     * @return string[]
     */
    public static function toArray(): array
    {
        return [
            'APP' => 'app',
            'TEXT' => 'text',
            'NUMBER' => 'number',
            'SELECT' => 'select',
            'CHECKBOX' => 'checkbox',
        ];
    }
}
