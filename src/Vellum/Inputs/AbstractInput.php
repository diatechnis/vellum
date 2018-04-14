<?php
/**
 * @author mkelly
 * @date 10/26/15
 */
namespace Vellum\Inputs;

use Vellum\Contracts\ArrayableInterface;
use Vellum\Contracts\Inputs\InputInterface;
use Vellum\Inputs\Enums\Formats;
use Vellum\Inputs\Enums\Types;
use Vellum\Inputs\Exceptions\InvalidTypeException;
use Vellum\Inputs\Exceptions\InvalidFormatException;
use Vellum\Inputs\Options\Options;

abstract class AbstractInput implements ArrayableInterface, InputInterface
{
    /** @var string */
    private $type;
    /** @var string The lower-cased, no-spaced name of the option. */
    private $name;
    /** @var string User-friendly name of the option */
    private $description;
    /** @var string */
    private $hint;
    /** @var string */
    private $format;
    /** @var mixed */
    private $default_value;
    /** @var Options */
    private $options;

    /**
     * AbstractInput constructor.
     * @param $name
     * @param $description
     * @param $type
     * @param $format
     * @param null $default_value
     * @param string $hint
     * @param Options|null $options
     *
     * @throws InvalidTypeException
     * @throws InvalidFormatException
     */
    public function __construct(
        $name,
        $description,
        $type,
        $format,
        $default_value = null,
        $hint = '',
        Options $options = null
    ) {
        if (! Types::in($type)) {
            throw new InvalidTypeException(
                "Type, '{$type}' is not a valid type"
            );
        }
        $this->type = $type;

        if (! Formats::in($format)) {
            throw new InvalidFormatException(
                "Format, '{$format}' is not a valid format"
            );
        }
        $this->format = $format;

        $this->name = $name;

        $this->description = $description;

        $this->default_value = $default_value;

        if (null === $options) {
            $options = new Options();
        }
        $this->options = $options;

        $this->hint = $hint;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getIdentifier(): string
    {
        return $this->name;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getFormat(): string
    {
        return $this->format;
    }

    public function getHint(): string
    {
        return $this->hint;
    }

    public function getDefaultValue()
    {
        return $this->default_value;
    }

    public function toArray(): array
    {
        $array = [
            'name' => $this->name,
            'description' => $this->description,
            'type' => $this->type,
            'hint' => $this->hint,
            'format' => $this->format,
        ];

        if (null !== $this->options) {
            $array['inputs'] = $this->options->toArray();
        }

        if (!empty($this->default_value)) {
            $array['default_value'] = $this->default_value;
        }

        return $array;
    }
}
