<?php

namespace App\Modules\License\Application\Validator;

use App\Modules\License\Domain\Dtos\LicenseValidationContext;

interface ValidatorInterface {
    /**
     * Summary of validate
     * @param \App\Modules\License\Domain\Dtos\LicenseValidationContext $context
     * @return void
     */
    public function validate(LicenseValidationContext $context): void;
}
