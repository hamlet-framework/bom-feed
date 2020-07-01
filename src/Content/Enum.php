<?php

namespace Hamlet\BureauOfMeteorology\Content;

abstract class Enum
{
    /**
     * @var string
     */
    protected $value;

    protected function __construct(string $value)
    {
        $this->value = $value;
    }

    /**
     * @param string $value
     * @return static|null
     */
    public static function of(string $value)
    {
        return static::values()[$value];
    }

    /**
     * @return static[]
     * @psalm-return array<string,static>
     */
    public static function values()
    {
        static $instances;
        if (!isset($instances)) {
            foreach (static::options() as $option) {
                $instances[$option] = new static($option);
            }
        }
        return $instances;
    }

    /**
     * @return string[]
     */
    abstract protected static function options(): array;

    public function value(): string
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
