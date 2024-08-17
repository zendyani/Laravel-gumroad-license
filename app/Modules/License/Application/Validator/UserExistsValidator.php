<?php

namespace App\Modules\License\Application\Validator;

use App\Modules\License\Domain\Dtos\LicenseValidationContext;
use App\Modules\License\Domain\Repositories\FigmaUserRepositoryInterface;

class UserExistsValidator implements ValidatorInterface {
    public function __construct(private FigmaUserRepositoryInterface $repository) {
    }

    /**
     * @inheritDoc
     */
    public function validate(LicenseValidationContext $context): void {
        $user = $this->repository->findOneByApiKey($context->getApiKey());
        if (!$user) {
            throw new \Exception('User not found');
        }

        $context->setUser($user);
    }
}
