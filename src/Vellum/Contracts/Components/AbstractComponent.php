<?php

namespace Vellum\Contracts\Components;

use Vellum\Contracts\Arguments\ArgumentsInterface;
use Vellum\Contracts\DisplayTypes\DisplayTypesInterface;
use Vellum\Contracts\Inputs\InputsInterface;
use Vellum\Contracts\Renderers\RenderInterface;
use Vellum\Inputs\Inputs;
use Vellum\Renderers\EmptyRenderer;

abstract class AbstractComponent implements ComponentInterface,
    ArguableInterface,
    DisplayableInterface,
    InputableInterface,
    RenderableInterface
{
    /** @var InputsInterface */
    private $inputs;
    /** @var RenderInterface */
    private $renderer;
    /** @var ArgumentsInterface */
    private $arguments;
    /** @var DisplayTypesInterface */
    private $display_types;

    /**
     * Component constructor.
     *
     * @param array $argument_data
     * @param RenderInterface $renderer
     *
     * @throws \InvalidArgumentException
     */
    public function __construct(
        array $argument_data = [],
        RenderInterface $renderer = null
    ) {
        $this->display_types = $this->createDisplayTypes();

        $this->inputs = $this->createInputs();

        $this->arguments = $this->createArguments($argument_data);

        if (null === $renderer) {
            $renderer = new EmptyRenderer();
        }
        $this->renderer = $renderer;
    }

    public function getArguments(): ArgumentsInterface
    {
        return $this->arguments;
    }

    public function getAllInputs(): InputsInterface
    {
        return new Inputs(
            $this->getDisplayTypes(),
            ...$this->getInputs()->get()
        );
    }

    public function getDisplayTypes(): DisplayTypesInterface
    {
        return $this->display_types;
    }

    public function getInputs(): InputsInterface
    {
        return $this->inputs;
    }

    public function render(): string
    {
        return $this->renderer->render($this);
    }

    abstract protected function createInputs(): InputsInterface;

    abstract protected function createDisplayTypes(): DisplayTypesInterface;

    private function createArguments(array $arguments_data): ArgumentsInterface
    {
        return $this->display_types->createArguments($arguments_data)
            ->mergeArguments($this->inputs->createArguments($arguments_data));
    }
}
