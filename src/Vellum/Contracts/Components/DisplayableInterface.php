<?php

namespace Vellum\Contracts\Components;

use Vellum\Contracts\DisplayTypes\DisplayTypesInterface;

interface DisplayableInterface
{
    public function getDisplayTypes(): DisplayTypesInterface;
}
