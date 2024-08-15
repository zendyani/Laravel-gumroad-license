<?php

namespace App\Modules\License\Domain\Dtos\Input;

use App\Modules\License\Enum\License;

class GetTokenInputDto {
    public function __construct(private string $id, private string $name, private License $productCode) {
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getProductCode() {
        return $this->productCode;
    }
}
