<?php

namespace App\Modules\License\Validator;

use App\Modules\License\Dto\LicenseValidationContext;
use App\Modules\License\Port\LicenseServiceInterface;

class ExternalServiceValidator implements ValidatorInterface {
    public function __construct(
        private LicenseServiceInterface $service
    ) {
    }

    public function validate(LicenseValidationContext $context): LicenseValidationContext {
        $response = $this->service->requestLicenseData($context->getLicenseKey(), $context->getProductCode());

        if (!$response || !$this->service->isValid($context->getLicenseKey(), $context->getProductCode())) {
            throw new \Exception('License not valid');
        }

        $context->setLicenseResponse($response);
        return $context;
    }
}
