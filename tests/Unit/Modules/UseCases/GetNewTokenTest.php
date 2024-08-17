<?php

namespace Tests\Unit\Modules\UseCases;

use App\Models\License;
use App\Models\FigmaUser;
use App\Modules\License\Application\CommandHandlers\GetTokenCommandHandler;
use App\Modules\License\Application\Commands\GetTokenCommand;
use Illuminate\Support\Str;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\Test;
use App\Modules\License\Domain\Dtos\FigmaUserDto;
use App\Modules\License\Domain\Dtos\Input\GetTokenInputDto;
use App\Modules\License\Domain\Port\ApiKeyServiceInterface;
use App\Modules\License\Domain\Enums\License as LicenseType;
use App\Modules\License\Domain\Port\LicenseServiceInterface;
use App\Modules\License\Domain\Exceptions\InvalidInputException;
use App\Modules\License\Domain\Repositories\LicenseRepositoryInterface;
use App\Modules\License\Domain\Repositories\FigmaUserRepositoryInterface;

class GetNewTokenTest extends TestCase {
    private $apiKeyServiceMock;
    private $licenseRepositoryMock;
    private $licenseServiceMock;

    public function setUp(): void {
        $this->apiKeyServiceMock = $this->createMock(ApiKeyServiceInterface::class);
        $this->apiKeyServiceMock->method('generate')
            ->willReturn('randomapikey');

        $this->licenseRepositoryMock = $this->createMock(LicenseRepositoryInterface::class);

        $this->licenseServiceMock = $this->createMock(LicenseServiceInterface::class);
    }

    #[Test]
    public function it_throws_exception_if_input_is_invalid() {
        // Arrange
        $input = new GetTokenInputDto('', '-/*', LicenseType::THEME_COMPOSER_FREELANCER);

        $repositoryMock = $this->createMock(FigmaUserRepositoryInterface::class);
        $repositoryMock->method('findByFigmaId')
            ->with('')
            ->willReturn(null);

        $this->expectException(InvalidInputException::class);

        // Act
        $command = new GetTokenCommand($input);
        (new GetTokenCommandHandler($repositoryMock, $this->licenseRepositoryMock, $this->apiKeyServiceMock, $this->licenseServiceMock))->handle($command);
    }

    #[Test]
    public function it_returns_ispremium_false_if_user_does_not_exist() {
        // Arrange
        $input = new GetTokenInputDto('4823774f-c19e-4770-bc32-edef98f276d6', 'testname', LicenseType::THEME_COMPOSER_FREELANCER);

        $repositoryMock = $this->createMock(FigmaUserRepositoryInterface::class);
        $repositoryMock->method('findByFigmaId')
            ->with('4823774f-c19e-4770-bc32-edef98f276d6')
            ->willReturn(null);

        // Act
        $command = new GetTokenCommand($input);
        $response = (new GetTokenCommandHandler($repositoryMock, $this->licenseRepositoryMock, $this->apiKeyServiceMock, $this->licenseServiceMock))->handle($command);

        // Assert
        $this->assertFalse($response['ispremium']);
    }

    #[Test]
    public function it_creates_user_if_not_found() {
        // Arrange
        $input = new GetTokenInputDto('4823774f-c19e-4770-bc32-edef98f276d6', 'figmaname', LicenseType::THEME_COMPOSER_FREELANCER);

        // Mock Repository
        $repositoryMock = $this->createMock(FigmaUserRepositoryInterface::class);

        $user = new FigmaUser();
        $user->api_key = 'randomapikey';
        $user->figma_id = $input->getId();
        $user->figma_name = $input->getName();
        $figmaUser = new FigmaUserDto($user->api_key, $user->figma_id, $user->figma_name);

        $repositoryMock->method('save')
            ->with($figmaUser)
            ->willReturn($user);

        $repositoryMock->method('findByFigmaId')
            ->with('4823774f-c19e-4770-bc32-edef98f276d6')
            ->willReturn(null);

        // Act
        $command = new GetTokenCommand($input);
        $response = (new GetTokenCommandHandler($repositoryMock, $this->licenseRepositoryMock, $this->apiKeyServiceMock, $this->licenseServiceMock))->handle($command);

        // Assert
        $this->assertArrayHasKey('api-key', $response);
        $this->assertArrayHasKey('ispremium', $response);
        $this->assertFalse($response['ispremium']);
    }

    #[Test]
    public function it_check_if_user_has_a_valid_license() {
        // Arrange
        /**
         * - User exist
         * - License exist for user-product relation
         *
         */
        $input = new GetTokenInputDto('4823774f-c19e-4770-bc32-edef98f276d6', 'figmaname', LicenseType::THEME_COMPOSER_FREELANCER);

        $user = new FigmaUser();
        $user->id = Str::uuid();
        $user->api_key = 'randomapikey';
        $user->figma_id = $input->getId();
        $user->figma_name = $input->getName();

        // Mock Repository
        $userRepositoryMock = $this->createMock(FigmaUserRepositoryInterface::class);
        $userRepositoryMock->method('findByFigmaId')
            ->with('4823774f-c19e-4770-bc32-edef98f276d6')
            ->willReturn($user);

        $license = new License();
        $license->license = 'licensecode';

        $licenseRepositoryMock = $this->createMock(LicenseRepositoryInterface::class);
        $licenseRepositoryMock->method('findByUserAndProduct')
            ->willReturn($license);

        $licenseServiceMock = $this->createMock(LicenseServiceInterface::class);
        $licenseServiceMock->method('isValid')
            ->willReturn(true);

        // Act
        $command = new GetTokenCommand($input);
        $response = (new GetTokenCommandHandler($userRepositoryMock, $licenseRepositoryMock, $this->apiKeyServiceMock, $licenseServiceMock))->handle($command);

        // Assert
        /**
         * - Check ispremium is true
         */
        $this->assertTrue($response['ispremium']);
    }
}
