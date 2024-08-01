<?php

namespace Tests\Unit\UseCases;

use App\Enums\License;
use App\Enums\LicenseGroup;
use App\UseCases\LicenseOffers\GetLicenseOffers;
use App\UseCases\LicenseOffers\GetLicenseOffersInputDto;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class GetLicenseOffersTest extends TestCase
{
    #[Test]
    public function it_return_thumblisher_license_list(): void
    {
        // Arrange
        $input = new GetLicenseOffersInputDto(LicenseGroup::THUMBLISHER);

        // Act
        $usecase = (new GetLicenseOffers())->execute($input);
        $expected = License::filterByGroup(LicenseGroup::THUMBLISHER);

        // Assert
        $this->assertEquals($expected, $usecase);
    }

    #[Test]
    public function it_return_themecomposer_license_list()
    {
        // Arrange
        $input = new GetLicenseOffersInputDto(LicenseGroup::THEME_COMPOSER);

        // Act
        $usecase = (new GetLicenseOffers())->execute($input);
        $expected = License::filterByGroup(LicenseGroup::THEME_COMPOSER);

        // Assert
        $this->assertEquals($expected, $usecase);
    }
}
