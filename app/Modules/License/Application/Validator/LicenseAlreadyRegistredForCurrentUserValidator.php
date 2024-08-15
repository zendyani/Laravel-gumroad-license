<?php

namespace App\Modules\License\Validator;

use App\Modules\License\Dto\LicenseValidationContext;

class LicenseAlreadyRegistredForCurrentUserValidator implements ValidatorInterface {
    /**
     * @param \App\Modules\License\Dto\LicenseValidationContext $context
     * @return LicenseValidationContext
     */
    public function validate(LicenseValidationContext $context): void {

    }
}
