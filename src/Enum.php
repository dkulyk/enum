<?php

declare(strict_types=1);

namespace DKulyk\Enum;

use Illuminate\Contracts\Database\Eloquent\Castable;
use MyCLabs\Enum\Enum as MyCLabsEnum;

/**
 * Enum class
 * @author Dmytro Kulyk <lnkvisitor.ts@gmail.com>
 */
abstract class Enum extends MyCLabsEnum implements Castable
{
    /**
     * Show key and value on dump.
     *
     * @return array
     */
    public function __debugInfo(): array
    {
        return [
            'key' => $this->getKey(),
            'value' => $this->value,
        ];
    }

    /**
     * @inheritDoc
     */
    public static function castUsing(array $arguments = [])
    {
        return new EnumCast(static::class);
    }
}
