<?php

namespace App\Modules\License\Application\CommandHandlers;

use App\Modules\License\Domain\Dtos\FigmaUserDto;
use App\Modules\License\Domain\Dtos\Input\GetTokenInputDto;
use App\Modules\License\Domain\Port\ApiKeyServiceInterface;
use App\Modules\License\Domain\Port\LicenseServiceInterface;
use App\Modules\License\Application\Commands\GetTokenCommand;
use App\Modules\License\Domain\Exceptions\InvalidInputException;
use App\Modules\License\Domain\Repositories\LicenseRepositoryInterface;
use App\Modules\License\Domain\Repositories\FigmaUserRepositoryInterface;

class GetTokenCommandHandler {
    public function __construct(
        private FigmaUserRepositoryInterface $repository,
        private LicenseRepositoryInterface $licenseRepository,
        private ApiKeyServiceInterface $apiKeyService,
        private LicenseServiceInterface $licenseService
    ) {
    }

    public function handle(GetTokenCommand $command) {
        $this->validateInput($command->input);

        $ispremium = false;

        // Check if user exist
        $user = $this->repository->findByFigmaId($command->input->getId());

        if ($user) {
            $license = $this->licenseRepository->findByUserAndProduct($user->id, $command->input->getProductCode());
            if ($license) {
                $ispremium = $this->licenseService->isValid($license->license, $command->input->getProductCode());
            }
        } else {
            // Generate api-key
            $apiKey = $this->apiKeyService->generate();

            // Create user
            $figmaUser = new FigmaUserDto($apiKey, $command->input->getId(), $command->input->getName());

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
