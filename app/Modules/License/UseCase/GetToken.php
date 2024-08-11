<?php

namespace App\Modules\License\UseCase;

use App\Modules\License\Dto\FigmaUserDto;
use App\Modules\License\Dto\Input\GetTokenInputDto;
use App\Modules\License\Port\ApiKeyServiceInterface;
use App\Modules\License\Port\LicenseServiceInterface;
use App\Modules\License\Exception\InvalidInputException;
use App\Modules\License\Repository\LicenseRepositoryInterface;
use App\Modules\License\Repository\FigmaUserRepositoryInterface;

final class GetToken {
    public function __construct(
        private FigmaUserRepositoryInterface $repository,
        private LicenseRepositoryInterface $licenseRepository,
        private ApiKeyServiceInterface $apiKeyService,
        private LicenseServiceInterface $licenseService
    ) {
    }

    /**
     * Summary of execute
     * @param \App\Modules\License\Dto\Input\GetTokenInputDto $input
     * @return array
     */
    public function execute(GetTokenInputDto $input): array {
        $this->validateInput($input);

        $ispremium = false;

        // Check if user exist
        $user = $this->repository->findByFigmaId($input->getId());

        if ($user) {
            $license = $this->licenseRepository->findByUserAndProduct($user->id, $input->getProductCode());
            if ($license) {
                $ispremium = $this->licenseService->isValid($license->license, $input->getProductCode());
            }
        } else {
            // Generate api-key
            $apiKey = $this->apiKeyService->generate();

            // Create user
            $figmaUser = new FigmaUserDto($apiKey, $input->getId(), $input->getName());

            $user = $this->repository->save($figmaUser);
        }

        return ['api-key' => $user?->api_key, 'ispremium' => $ispremium];

    }

    /**
     * Validates the input data.
     *
     * @param GetTokenInputDto $input The input DTO containing Figma user information.
     * @throws InvalidInputException if the input data is invalid.
     */
    private function validateInput(GetTokenInputDto $input): void {
        $id = $input->getId();
        $name = $input->getName();

        if (empty($id) || !is_string($id) || empty($name) || !is_string($name)) {
            throw new InvalidInputException('Invalid ID or name value');
        }
    }
}
