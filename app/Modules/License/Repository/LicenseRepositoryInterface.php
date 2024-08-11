<?php

namespace App\Modules\License\Repository;

use App\Models\License;
use App\Modules\License\Enum\License as LicenseType;
use App\Modules\License\Dto\LicenseValidationContext;

interface LicenseRepositoryInterface {
    /**
     * Summary of findByUserAndProduct
     * @param string $userId
     * @param \App\Modules\License\Enum\License $productName
     * @return null|License
     */
    public function findByUserAndProduct(string $userId, LicenseType $productName): ?License;

    /**
     * Summary of saveAndAssociateToUser
     * @param \App\Modules\License\Dto\LicenseValidationContext $context
     * @return bool
     */
    public function saveAndAssociateToUser(LicenseValidationContext $context): bool;
}
