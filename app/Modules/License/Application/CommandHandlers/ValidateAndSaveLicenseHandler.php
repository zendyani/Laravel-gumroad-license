<?php

namespace App\Modules\License\Application\CommandHandlers;

use App\Modules\License\Domain\Port\LicenseServiceInterface;
use App\Modules\License\Domain\Dtos\LicenseValidationContext;
use App\Modules\License\Domain\Exceptions\InvalidInputException;
use App\Modules\License\Domain\Dtos\Input\ValidateLicenseInputDto;
use App\Modules\License\Application\Services\LicenseValidationService;
use App\Modules\License\Domain\Repositories\LicenseRepositoryInterface;
use App\Modules\License\Domain\Repositories\FigmaUserRepositoryInterface;
use App\Modules\License\Application\Commands\ValidateAndSaveLicenseCommand;

class ValidateAndSaveLicenseHandler {
    public function __construct(
        private FigmaUserRepositoryInterface $repository,
        private LicenseRepositoryInterface $licenseRepository,
        private LicenseServiceInterface $licenseService,
        private LicenseValidationService $licenseValidationService
    ) {
    }

    public function handle(ValidateAndSaveLicenseCommand $command) {
        $this->validateInput($command->input);

        $licenseContext = LicenseValidationContext::fromInputDto($command->input);

        try {
            $this->licenseValidationService->validate($licenseContext);

            // Save license Associate license with user
            $this->licenseRepository->saveAndAssociateToUser($licenseContext);

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
