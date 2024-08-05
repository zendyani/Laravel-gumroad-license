<?php

namespace App\Repositories;

use App\Models\FigmaUser;
use App\Modules\License\Repository\LicenseRepositoryInterface;
use App\Models\License;
use App\Modules\License\Enum\License as LicenseType;

class LicenseRepository implements LicenseRepositoryInterface
{
    /**
     * Summary of findByUserAndProduct
     * @param string $userId
     * @param \App\Modules\License\Enum\License $productName
     * @return void
     */
    public function findByUserAndProduct(string $userId, LicenseType $productName): ?License
    {
        // Find the user by ID
        $figmaUser = FigmaUser::find($userId);

        if ($figmaUser) {
            // Find the license by product name
            return $figmaUser->licenses()->where('product_name', $productName->value)->first();
        }

        return null;
    }
}