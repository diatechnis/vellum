<?php

namespace Vellum\Contracts\Components;

use Vellum\Contracts\Inputs\InputsInterface;

interface ComponentInterface
{
    public function getAllInputs(): InputsInterface;
}
