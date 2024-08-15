<?php

namespace App\Modules\License\Domain\Repositories;

use App\Models\License;
use App\Modules\License\Domain\Enums\License as LicenseType;
use App\Modules\License\Domain\Dtos\LicenseValidationContext;

interface LicenseRepositoryInterface {
    /**
     * Summary of findByUserAndProduct
     * @param string $userId
     * @param \App\Modules\License\Domain\Enums\License $productName
     * @return null|License
     */
    public function findByUserAndProduct(string $userId, LicenseType $productName): ?License;

    /**
     * Summary of saveAndAssociateToUser
     * @param \App\Modules\License\Domain\Dtos\LicenseValidationContext $context
     * @return bool
     */
    public function saveAndAssociateToUser(LicenseValidationContext $context): bool;
}
