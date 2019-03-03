<?php

namespace Tests\Components\Elements;

use Tests\Renderers\ClassNameRenderer;
use Vellum\Contracts\Components\AbstractComponent;
use Vellum\Contracts\DisplayTypes\DisplayTypesInterface;
use Vellum\Contracts\Inputs\InputsInterface;
use Vellum\DisplayTypes\DisplayType;
use Vellum\DisplayTypes\DisplayTypes;
use Vellum\Inputs\Inputs;
use Vellum\Inputs\TextInput;

class Button extends AbstractComponent
{
    public function __construct(array $argument_data = []) {
        parent::__construct(
            $argument_data,
            new ClassNameRenderer()
        );
    }

    protected function createDisplayTypes(): DisplayTypesInterface
    {
        return new DisplayTypes(
            new DisplayType(
                'submit',
                null,
                'Submit',
                true
            ),
            new DisplayType('cancel'),
            new DisplayType('warning')
        );
    }

    protected function createInputs(): InputsInterface
    {
        return new Inputs(
            new TextInput(
                'button_text',
                'Button Text',
                'Submit'
            )
        );
    }
}
