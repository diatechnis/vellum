<?php

namespace Vellum\Contracts\Components;

use Vellum\Contracts\Arguments\ArgumentsInterface;
use Vellum\Contracts\Inputs\InputsInterface;

interface ComponentInterface
{
    public function getAllInputs(): InputsInterface;

    public function getArguments(): ArgumentsInterface;
}
