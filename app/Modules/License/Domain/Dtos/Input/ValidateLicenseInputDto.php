<?php

namespace App\Modules\License\Domain\Dtos\Input;

use App\Modules\License\Domain\Enums\License;

class ValidateLicenseInputDto {
    public function __construct(private string $apiKey, private string $licenseKey, private License $productCode) {
    }

    public function getApiKey() {
        return $this->apiKey;
    }

    public function getLicenseKey() {
        return $this->licenseKey;
    }

    public function getProductCode() {
        return $this->productCode;
    }
}
