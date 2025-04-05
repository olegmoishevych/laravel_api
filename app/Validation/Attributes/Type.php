<?php

namespace App\Validation\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class Type
{
    public function __construct(public string $type) {}
}
