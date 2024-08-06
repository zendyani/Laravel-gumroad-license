<?php

namespace App\Services;

use App\Modules\License\Port\LicenseServiceInterface;

class LicenseService implements LicenseServiceInterface {
    /**
     * @inheritDoc
     */
    public function isValid(string $license): bool {
        return true;
    }
}
