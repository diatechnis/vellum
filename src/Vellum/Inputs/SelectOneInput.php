<?php

namespace Vellum\Inputs;

use Vellum\Inputs\Options\Options;
use Vellum\Inputs\Enums\Types;

final class SelectOneInput extends AbstractInput
{
    public function __construct(
        $name,
        $description,
        $format,
        Options $options,
        $default_value = null,
        $hint = ''
    ) {
        parent::__construct(
            $name,
            $description,
            Types::SELECT,
            $format,
            $default_value,
            $hint,
            $options
        );
    }
}
