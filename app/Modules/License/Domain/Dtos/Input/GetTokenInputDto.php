<?php

namespace App\Modules\License\Domain\Dtos\Input;

use App\Modules\License\Domain\Enums\License;

class GetTokenInputDto {
    public function __construct(private string $id, private string $name, private License $productCode) {
    }

    public function getId(): string {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getProductCode(): License {
        return $this->productCode;
    }
}
