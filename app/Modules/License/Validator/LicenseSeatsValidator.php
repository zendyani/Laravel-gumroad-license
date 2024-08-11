<?php

namespace  App\Modules\License\Validator;

use App\Modules\License\Dto\LicenseValidationContext;

class LicenseSeatsValidator implements ValidatorInterface {
    public function __construct() {

    }


    /**
     * Get Seats by product
     * Get number of license used (seat in use)
     * Check if it's less than the max seat allowed by product type
     *
     * @param \App\Modules\License\Dto\LicenseValidationContext $context
     * @return LicenseValidationContext
     */
    public function validate(LicenseValidationContext $context): LicenseValidationContext {

        return $context;
    }
}
