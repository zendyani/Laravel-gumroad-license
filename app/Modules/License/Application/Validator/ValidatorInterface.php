<?php

namespace App\Modules\License\Validator;

use App\Modules\License\Dto\LicenseValidationContext;

interface ValidatorInterface {
    /**
     * Summary of validate
     * @param \App\Modules\License\Dto\LicenseValidationContext $context
     * @return void
     */
    public function validate(LicenseValidationContext $context): void;
}
