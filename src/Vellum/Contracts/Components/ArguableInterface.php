<?php

namespace Vellum\Contracts\Components;

use Vellum\Contracts\Arguments\ArgumentsInterface;

interface ArguableInterface
{
    public function getArguments(): ArgumentsInterface;
}
