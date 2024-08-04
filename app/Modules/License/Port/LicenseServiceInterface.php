<?php

namespace App\Modules\License\Port;

interface LicenseServiceInterface {
    /**
     * Summary of isValid
     * @param string $license
     * @return bool
     */
    public function isValid(string $license): bool;
}