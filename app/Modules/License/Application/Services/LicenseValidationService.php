<?php

namespace App\Modules\License\Service;

use App\Modules\License\Dto\LicenseValidationContext;
use App\Modules\License\Validator\UserExistsValidator;
use App\Modules\License\Validator\ExternalServiceValidator;

class LicenseValidationService {
    private array $validators;

    public function __construct(
        UserExistsValidator $userExistsValidator,
        ExternalServiceValidator $externalServiceValidator,
    ) {
        $this->validators = [
            $userExistsValidator,
            $externalServiceValidator,
        ];
    }

    /**
     * @param \App\Modules\License\Dto\LicenseValidationContext $context
     * @return \App\Modules\License\Dto\LicenseValidationContext
     */
    public function validate(LicenseValidationContext $context): void {

        foreach ($this->validators as $validator) {
            $validator->validate($context);
        }
    }
}
