<?php

namespace App\Modules\License\Domain\Dtos;

use App\Models\FigmaUser;
use App\Modules\License\Domain\Enums\License;
use App\Modules\License\Domain\Dtos\Input\ValidateLicenseInputDto;

class LicenseValidationContext {
    private ?FigmaUser $user;
    private ?LicenseResponseDto $licenseResponse;

    public function __construct(
        private string $apiKey,
        private string $licenseKey,
        private License $productCode
    ) {
    }

    public static function fromInputDto(ValidateLicenseInputDto $input): self {
        return new self($input->getApiKey(), $input->getLicenseKey(), $input->getProductCode());
    }

    public function getApiKey(): string {
        return $this->apiKey;
    }

    public function getLicenseKey(): string {
        return $this->licenseKey;
    }

    public function getProductCode(): License {
        return $this->productCode;
    }

    public function getUser(): ?FigmaUser {
        return $this->user;
    }
    public function setUser(FigmaUser $user): void {
        $this->user = $user;
    }

    public function getLicenseResponse(): ?LicenseResponseDto {
        return $this->licenseResponse;
    }

    public function setLicenseResponse(LicenseResponseDto $licenseResponse): void {
        $this->licenseResponse = $licenseResponse;
    }

}
