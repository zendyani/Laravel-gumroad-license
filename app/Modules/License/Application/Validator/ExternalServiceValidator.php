<?php

namespace App\Modules\License\Application\Validator;

use App\Modules\License\Domain\Port\LicenseServiceInterface;
use App\Modules\License\Domain\Dtos\LicenseValidationContext;

class ExternalServiceValidator implements ValidatorInterface {
    public function __construct(
        private LicenseServiceInterface $service
    ) {
    }

    /**
     * @inheritDoc
     */
    public function validate(LicenseValidationContext $context): void {
        $response = $this->service->requestLicenseData($context->getLicenseKey(), $context->getProductCode());

        if (!$response || !$this->service->isValid($context->getLicenseKey(), $context->getProductCode())) {
            throw new \Exception('License not valid');
        }

        $context->setLicenseResponse($response);
    }
}
