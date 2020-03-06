<?php
declare(strict_types=1);

namespace DKulyk\Enum;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use RuntimeException;

/**
 * Class EnumCast
 */
class EnumCast implements CastsAttributes
{
    /**
     * @var string
     */
    private $enum;

    /**
     * EnumCast constructor.
     * @param  string  $enum
     */
    public function __construct(string $enum)
    {
        if (! class_exists($enum)) {
            throw new RuntimeException("Enum class '{$enum}' not found");
        }

        if (! is_a($enum, Enum::class, true)) {
            throw new RuntimeException("Enum class '{$enum}' must be extended from " . Enum::class);
        }

        $this->enum = $enum;
    }

    /**
     * @inheritDoc
     */
    public function get($model, string $key, $value, array $attributes)
    {
        $class = $this->enum;

        return new $class(ctype_digit($value) ? (int) $value : $value);
    }

    /**
     * @inheritDoc
     */
    public function set($model, string $key, $value, array $attributes)
    {
        return [
            $key => $value instanceof Enum ? $value->getValue() : (string) $value,
        ];
    }
}
