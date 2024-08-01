<?php

namespace App\UseCases\LicenseOffers;
use App\Enums\License;

final class GetLicenseOffers
{
    public function execute(GetLicenseOffersInputDto $input)
    {
        return License::filterByGroup($input->getGroupName());
    }
}
