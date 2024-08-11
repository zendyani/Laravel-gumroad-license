<?php

namespace Tests\Unit\Modules\UseCases;

use PHPUnit\Framework\TestCase;
use App\Modules\License\Enum\License;
use PHPUnit\Framework\Attributes\Test;
use App\Modules\License\Enum\LicenseGroup;
use App\Modules\License\UseCase\GetLicenseOffers;
use App\Modules\License\Dto\Input\GetLicenseOffersInputDto;

class GetLicenseOffersTest extends TestCase {
    #[Test]
    public function it_return_thumblisher_license_list(): void {
        // Arrange
        $input = new GetLicenseOffersInputDto(LicenseGroup::THUMBLISHER);

        // Act
        $usecase = (new GetLicenseOffers())->execute($input);
        $expected = License::filterByGroup(LicenseGroup::THUMBLISHER);

        // Assert
        $this->assertEquals($expected, $usecase);
    }

    #[Test]
    public function it_return_themecomposer_license_list() {
        // Arrange
        $input = new GetLicenseOffersInputDto(LicenseGroup::THEME_COMPOSER);

        // Act
        $usecase = (new GetLicenseOffers())->execute($input);
        $expected = License::filterByGroup(LicenseGroup::THEME_COMPOSER);

        // Assert
        $this->assertEquals($expected, $usecase);
    }
}
