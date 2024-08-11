<?php

namespace App\Modules\License\Dto;

use App\Models\FigmaUser;
use App\Modules\License\Enum\License;
use App\Modules\License\Dto\Input\ValidateLicenseInputDto;

class LicenseValidationContext {
    private ?FigmaUser $user;
    private ?LicenseResponseDto $licenseResponse;

    public function __construct(
        private string $apiKey,
        private string $licenseKey,
        private License $productCode
    ) {
    }

    public static function fromInputDto(ValidateLicenseInputDto $input) {
        return new self($input->getApiKey(), $input->getLicenseKey(), $input->getProductCode());
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

    public function getUser() {
        return $this->user;
    }
    public function setUser($user) {
        $this->user = $user;
    }

    public function getLicenseResponse() {
        return $this->licenseResponse;
    }

    public function setLicenseResponse($licenseResponse) {
        $this->licenseResponse = $licenseResponse;
    }

}
