<?php

namespace App\Modules\License\Application\Services;

use App\Modules\License\Domain\Dtos\LicenseValidationContext;
use App\Modules\License\Application\Validator\UserExistsValidator;
use App\Modules\License\Application\Validator\ExternalServiceValidator;

class LicenseValidationService {
    /**
     * Summary of validators
     * @var \App\Modules\License\Application\Validator\ValidatorInterface[]
     */
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
     * @param \App\Modules\License\Domain\Dtos\LicenseValidationContext $context
     * @return void
     */
    public function validate(LicenseValidationContext $context): void {

        foreach ($this->validators as $validator) {
            $validator->validate($context);
        }
    }
}
