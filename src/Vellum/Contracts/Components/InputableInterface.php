<?php

namespace Vellum\Contracts\Components;

use Vellum\Contracts\Inputs\InputsInterface;

interface InputableInterface
{
    public function getInputs(): InputsInterface;
}
