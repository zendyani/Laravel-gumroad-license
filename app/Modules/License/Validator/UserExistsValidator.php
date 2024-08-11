<?php

namespace App\Modules\License\Validator;

use App\Modules\License\Dto\LicenseValidationContext;
use App\Modules\License\Repository\FigmaUserRepositoryInterface;

class UserExistsValidator implements ValidatorInterface {
    public function __construct(private FigmaUserRepositoryInterface $repository) {
    }

    /**
     * Summary of validate
     * @param \App\Modules\License\Dto\LicenseValidationContext $context
     * @throws \Exception
     * @return \App\Modules\License\Dto\LicenseValidationContext
     */
    public function validate(LicenseValidationContext $context): void {
        $user = $this->repository->findOneByApiKey($context->getApiKey());
        if (!$user) {
            throw new \Exception('User not found');
        }

        $context->setUser($user);
    }
}
