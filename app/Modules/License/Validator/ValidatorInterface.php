<?php

namespace App\Modules\License\Validator;

use App\Modules\License\Dto\LicenseValidationContext;

interface ValidatorInterface {
    /**
     * @param \App\Modules\License\Validator\LicenseValidationContext $context
     * @return \App\Modules\License\Validator\LicenseValidationContext
     */
    public function validate(LicenseValidationContext $context): LicenseValidationContext;
}
