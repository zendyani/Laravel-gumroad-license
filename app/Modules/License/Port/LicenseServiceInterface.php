<?php

namespace App\Modules\License\Port;

use App\Modules\License\Enum\License;

interface LicenseServiceInterface {
    /**
     * Summary of isValid
     * @param string $license
     * @param \App\Modules\License\Enum\License $produceCode
     * @return bool
     */
    public function isValid(string $license, License $produceCode): bool;
}
