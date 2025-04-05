<?php

namespace App\DTO;

use App\Validation\Attributes\Required;
use App\Validation\Attributes\Type;

readonly class ProductDTO
{
    public function __construct(
        #[Required]
        #[Type('string')]
        public string $name,

        #[Required]
        #[Type('float')]
        public float $price,

        #[Required]
        #[Type('string')]
        public string $category,

        #[Required]
        #[Type('array')]
        public array $attributes,
    ) {}
}
