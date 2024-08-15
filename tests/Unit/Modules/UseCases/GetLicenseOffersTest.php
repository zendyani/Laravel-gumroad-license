<?php

namespace Tests\Unit\Modules\UseCases;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\Test;
use App\Modules\License\Domain\Enums\License;
use App\Modules\License\Domain\Enums\LicenseGroup;
use App\Modules\License\Domain\Dtos\Input\GetLicenseOffersInputDto;
use App\Modules\License\Application\Commands\GetLicenseOffersCommand;
use App\Modules\License\Application\CommandHandlers\GetLicenseOffersHandler;

class GetLicenseOffersTest extends TestCase {
    #[Test]
    public function it_return_thumblisher_license_list(): void {
        // Arrange
        $input = new GetLicenseOffersInputDto(LicenseGroup::THUMBLISHER);
        $command = new GetLicenseOffersCommand($input);

        // Act
        $usecase = (new GetLicenseOffersHandler())->handle($command);
        $expected = License::filterByGroup(LicenseGroup::THUMBLISHER);

        // Assert
        $this->assertEquals($expected, $usecase);
    }

    #[Test]
    public function it_return_themecomposer_license_list() {
        // Arrange
        $input = new GetLicenseOffersInputDto(LicenseGroup::THEME_COMPOSER);
        $command = new GetLicenseOffersCommand($input);

        // Act
        $usecase = (new GetLicenseOffersHandler())->handle($command);
        $expected = License::filterByGroup(LicenseGroup::THEME_COMPOSER);

        // Assert
        $this->assertEquals($expected, $usecase);
    }
}
