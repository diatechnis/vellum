<?php
/**
 * @author mkelly
 * @date 4/12/18
 */

namespace Vellum\Inputs;

use Vellum\Inputs\Enums\Formats;
use Vellum\Inputs\Enums\Types;
use Vellum\Inputs\Options\Options;

class SelectMultipleInput extends AbstractInput
{
    public function __construct(
        $name,
        $description,
        Options $options,
        $default_value = null,
        $hint = ''
    ) {
        parent::__construct(
            $name,
            $description,
            Types::CHECKBOX,
            Formats::ARRAY,
            $default_value,
            $hint,
            $options
        );
    }
}
