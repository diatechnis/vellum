<?php

namespace Vellum\DisplayTypes;

use Vellum\Contracts\Arguments\ArgumentsInterface;
use Vellum\Contracts\Inputs\InputInterface;
use Vellum\Contracts\Inputs\InputsInterface;
use Vellum\Contracts\DisplayTypes\DisplayTypeInterface;
use Vellum\Contracts\DisplayTypes\DisplayTypesInterface;
use Vellum\Inputs\Inputs;
use Vellum\Inputs\Enums\Types;

final class DisplayTypes implements DisplayTypesInterface, InputInterface
{
    /** @var DisplayTypeInterface[] */
    private $display_types = [];

    private $default_type = '';

    private const DEFAULT_NAME = 'default';

    private const DISPLAY_TYPE = 'display_type';

    public function __construct(DisplayType ...$display_types)
    {
        foreach ($display_types as $display_type) {
            $this->addDisplayType($display_type);
        }
    }

    public function getDisplayType(string $key = null): DisplayTypeInterface
    {
        if (empty($this->display_types)) {
            $display_type = new DisplayType(
                self::DEFAULT_NAME,
                null,
                '',
                true
            );

            $this->addDisplayType($display_type, true);
        }

        if (null === $key || self::DEFAULT_NAME === $key) {
            return $this->display_types[$this->default_type];
        }

        if (isset($this->display_types[$key])) {
            return $this->display_types[$key];
        }

        return new DisplayType('');
    }

    // TODO refactor out ->isDefault(bool) instances
    public function addDisplayType(
        DisplayTypeInterface $display_type,
        bool $is_default = false
    ) {
        if (! \count($this->display_types)) {
            $is_default = true;
        }

        $id = $display_type->getIdentifier();

        if ($is_default) {
            $display_type->isDefault(true);

            foreach ($this->display_types as $type) {
                $type->isDefault(false);
            }

            $this->default_type = $id;
        }

        $this->display_types[$id] = $display_type;

        return $this;
    }

    public function createArguments(
        array $argument_data = [],
        string $namespace = null //TODO is this needed?
    ): ArgumentsInterface {
        $key = self::DEFAULT_NAME;
        if (! empty($argument_data[self::DISPLAY_TYPE]['identifier'])) {
            $key = $argument_data[self::DISPLAY_TYPE]['identifier'];
        }

        $display_type = $this->getDisplayType($key);

        $display_type_arguments = [];
        if (! empty($argument_data[self::DISPLAY_TYPE]['arguments'])) {
            $display_type_arguments = $argument_data[self::DISPLAY_TYPE]['arguments'];
        }

        $arguments =  $display_type->getInputs()->createArguments(
            $display_type_arguments, self::DISPLAY_TYPE
        );

        return $arguments->addArgument(
            self::DISPLAY_TYPE . '.identifier',
            $display_type->getIdentifier() ?? self::DEFAULT_NAME
        );
    }

    public function mergeInputs(
        InputsInterface $inputs
    ): InputsInterface {
        return new Inputs($this, ...$inputs->get());
    }

    public function getType(): string
    {
        return Types::SELECT;
    }

    public function getIdentifier(): string
    {
        return 'display_type';
    }

    public function getDescription(): ?string
    {
        return 'Display Type';
    }

    public function getFormat(): string
    {
        return 'string';
    }

    public function getHint(): string
    {
        return 'How should this component look?';
    }

    public function getDefaultValue()
    {
        return $this->getDisplayType(self::DEFAULT_NAME)->getIdentifier();
    }

    public function toArray(): array
    {
        $array = [
            'name' => $this->getIdentifier(),
            'description' => $this->getDescription(),
            'type' => $this->getType(),
            'hint' => $this->getHint(),
            'format' => $this->getFormat(),
            'inputs' => [],
            'default_value' => $this->getDefaultValue()
        ];

        foreach ($this->display_types as $display_type) {
            $array['inputs'][] = $display_type->toArray();
        }

        return $array;
    }
}
