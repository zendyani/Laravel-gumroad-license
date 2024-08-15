<?php

namespace App\Modules\License\Infrastructure\Persistence\Eloquent;

use App\Models\License;
use App\Models\FigmaUser;
use App\Modules\License\Domain\Enums\License as LicenseType;
use App\Modules\License\Domain\Dtos\LicenseValidationContext;
use App\Modules\License\Domain\Repositories\LicenseRepositoryInterface;

class LicenseRepository implements LicenseRepositoryInterface {
    /**
     * @inheritDoc
     */
    public function findByUserAndProduct(string $userId, LicenseType $productName): ?License {
        // Find the user by ID
        $figmaUser = FigmaUser::find($userId);

        if ($figmaUser) {
            // Find the license by product name
            return $figmaUser->licenses()->where('product_name', $productName->value)->first();
        }

        return null;
    }

    /**
     * @inheritDoc
     */
    public function saveAndAssociateToUser(LicenseValidationContext $context): bool {
        return true;
    }
}
