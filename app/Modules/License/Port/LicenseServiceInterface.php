<?php

namespace App\Modules\License\Port;

use App\Modules\License\Enum\License;
use App\Modules\License\Dto\LicenseResponseDto;

interface LicenseServiceInterface {
    /**
     * Undocumented function
     *
     * @param string $license_key
     * @param \App\Modules\License\Enum\License $productCode
     * @return \App\Modules\License\Dto\LicenseResponseDto|false
     */
    public function requestLicenseData(string $license_key, License $productCode): LicenseResponseDto|bool;

    /**
     * Summary of isValid
     * @param string $license
     * @param \App\Modules\License\Enum\License $produceCode
     * @return bool
     */
    public function isValid(string $license, License $produceCode): bool;
}
