<?php

namespace App\Modules\License\Application\Validator;

use App\Modules\License\Domain\Dtos\LicenseValidationContext;

class LicenseSeatsValidator implements ValidatorInterface {
    public function __construct() {

    }


    /**
     * Get Seats by product
     * Get number of license used (seat in use)
     * Check if it's less than the max seat allowed by product type
     *
     * @param \App\Modules\License\Domain\Dtos\LicenseValidationContext $context
     * @return void
     */
    public function validate(LicenseValidationContext $context): void {

    }
}
