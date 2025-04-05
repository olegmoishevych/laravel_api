<?php

namespace App\Validation;

use ReflectionClass;
use App\Validation\Attributes\Required;
use App\Validation\Attributes\Type;
use InvalidArgumentException;

class DTOValidator
{
    public static function validate(object $dto): void
    {
        $reflection = new ReflectionClass($dto);

        foreach ($reflection->getProperties() as $property) {
            $value = $property->getValue($dto);
            $name = $property->getName();

            foreach ($property->getAttributes() as $attribute) {
                $attr = $attribute->newInstance();

                // Проверка на обязательность
                if ($attr instanceof Required && ($value === null || $value === '')) {
                    throw new InvalidArgumentException("Field '{$name}' is required.");
                }

                // Проверка типа
                if ($attr instanceof Type) {
                    $expected = $attr->type;
                    $actual = gettype($value);

                    if ($expected === 'float' && is_numeric($value)) {
                        $value = (float) $value;
                        $actual = 'float';
                    }

                    if ($expected === 'int' && is_numeric($value)) {
                        $value = (int) $value;
                        $actual = 'integer';
                    }

                    if ($actual !== $expected) {
                        throw new InvalidArgumentException("Field '{$name}' must be of type {$expected}, {$actual} given.");
                    }
                }
            }
        }
    }
}
