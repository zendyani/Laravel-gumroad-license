<?php

namespace App\Modules\License\Application\Validator;

use App\Modules\License\Domain\Dtos\LicenseValidationContext;

class LicenseAlreadyRegistredForCurrentUserValidator implements ValidatorInterface {
    /**
     * @inheritDoc
     */
    public function validate(LicenseValidationContext $context): void {

    }
}
