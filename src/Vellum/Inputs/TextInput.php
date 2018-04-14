<?php

namespace Vellum\Inputs;

use Vellum\Inputs\Enums\Formats;
use Vellum\Inputs\Enums\Types;

final class TextInput extends AbstractInput
{
    public function __construct(
        $name,
        $description,
        $default_value = null,
        $hint = ''
    ) {
        parent::__construct(
            $name,
            $description,
            Types::TEXT,
            $format = Formats::TEXT,
            $default_value,
            $hint
        );
    }
}
