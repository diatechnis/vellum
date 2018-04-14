<?php

namespace Vellum\Inputs;

use Vellum\Inputs\Enums\Formats;
use Vellum\Inputs\Enums\Types;

class ArrayOfObjectsInput extends AbstractInput
{
    /** @var Inputs */
    private $inputs;

    public function __construct(
        $name,
        $description,
        Inputs $inputs,
        $hint = ''
    ) {
        parent::__construct(
            $name,
            $description,
            Types::APP,
            Formats::ARRAY,
            '[]',
            $hint
        );

        $this->inputs = $inputs;
    }

    public function toArray(): array
    {
        $array = parent::toArray();

        $array['inputs'] = $this->inputs->toArray();

        return $array;
    }


}
