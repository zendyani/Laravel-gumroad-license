<?php

namespace App\Modules\License\Repository;
use App\Models\License;
use App\Modules\License\Enum\License as LicenseType;

interface LicenseRepositoryInterface {
    public function findByUserAndProduct(string $userId, LicenseType $productName): ?License;
}