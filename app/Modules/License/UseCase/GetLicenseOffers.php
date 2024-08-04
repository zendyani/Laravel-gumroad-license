<?php

namespace App\Modules\License\UseCase;
use App\Modules\License\Dto\GetLicenseOffersInputDto;
use App\Modules\License\Enum\License;

final class GetLicenseOffers
{
    public function execute(GetLicenseOffersInputDto $input)
    {
        return License::filterByGroup($input->getGroupName());
    }
}
