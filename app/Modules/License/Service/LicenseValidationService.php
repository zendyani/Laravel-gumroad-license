<?php

namespace App\Modules\License\Service;

use App\Modules\License\Dto\LicenseValidationContext;

class LicenseValidationService {
    /**
     * @param array<\App\Modules\License\Validator\ValidatorInterface> $validators
     */
    public function __construct(private array $validators) {
    }

    /**
     * @param \App\Modules\License\Dto\LicenseValidationContext $context
     * @return \App\Modules\License\Dto\LicenseValidationContext
     */
    public function validate(LicenseValidationContext $context): LicenseValidationContext {

        foreach ($this->validators as $validator) {
            $context = $validator->validate($context);
        }

        return $context;
    }
}
