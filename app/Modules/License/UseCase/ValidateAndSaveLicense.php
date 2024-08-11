<?php

namespace App\Modules\License\UseCase;

use App\Modules\License\Dto\LicenseValidationContext;
use App\Modules\License\Port\LicenseServiceInterface;
use App\Modules\License\Exception\InvalidInputException;
use App\Modules\License\Service\LicenseValidationService;
use App\Modules\License\Dto\Input\ValidateLicenseInputDto;
use App\Modules\License\Repository\LicenseRepositoryInterface;
use App\Modules\License\Repository\FigmaUserRepositoryInterface;

class ValidateAndSaveLicense {
    public function __construct(
        private FigmaUserRepositoryInterface $repository,
        private LicenseRepositoryInterface $licenseRepository,
        private LicenseServiceInterface $licenseService,
        private LicenseValidationService $licenseValidationService
    ) {
    }

    public function execute(ValidateLicenseInputDto $input) {

        $this->validateInput($input);

        $licenseContext = LicenseValidationContext::fromInputDto($input);

        try {
            $context = $this->licenseValidationService->validate($licenseContext);

            // Save license Associate license with user
            $this->licenseRepository->saveAndAssociateToUser($context);

            //Return success
            return ['success' => true, 'msg' => 'Your license is valid, welcome'];

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    private function validateInput(ValidateLicenseInputDto $input): void {
        $apiKey = $input->getApiKey();
        $licenseKey = $input->getLicenseKey();
        $productCode = $input->getProductCode();

        if (empty($apiKey) || !is_string($apiKey) || empty($licenseKey) || !is_string($licenseKey) || !$productCode) {
            throw new InvalidInputException('Failed input validation');
        }
    }
}
