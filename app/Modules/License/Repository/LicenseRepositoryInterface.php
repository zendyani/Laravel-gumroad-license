<?php

namespace App\Modules\License\Repository;
use App\Models\License;
use App\Modules\License\Enum\License as LicenseType;

interface LicenseRepositoryInterface {
    /**
     * Summary of findByUserAndProduct
     * @param string $userId
     * @param \App\Modules\License\Enum\License $productName
     * @return void
     */
    public function findByUserAndProduct(string $userId, LicenseType $productName): ?License;
}