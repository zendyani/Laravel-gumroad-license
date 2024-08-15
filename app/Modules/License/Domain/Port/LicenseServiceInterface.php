<?php

namespace App\Modules\License\Domain\Port;

use App\Modules\License\Domain\Enums\License;
use App\Modules\License\Domain\Dtos\LicenseResponseDto;

interface LicenseServiceInterface {
    /**
     * Undocumented function
     *
     * @param string $license_key
     * @param \App\Modules\License\Domain\Enums\License $productCode
     * @return \App\Modules\License\Domain\Dtos\LicenseResponseDto|false
     */
    public function requestLicenseData(string $license_key, License $productCode): LicenseResponseDto|bool;

    /**
     * Summary of isValid
     * @param string $license
     * @param \App\Modules\License\Domain\Enums\License $produceCode
     * @return bool
     */
    public function isValid(string $license, License $produceCode): bool;
}
