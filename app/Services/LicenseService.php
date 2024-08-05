<?php

namespace App\Services;

use App\Modules\License\Port\LicenseServiceInterface;

class LicenseService implements LicenseServiceInterface
{
    /**
     * Summary of isValid
     * @param string $license
     * @return bool
     */
    public function isValid(string $license): bool{
        return true;
    }
}