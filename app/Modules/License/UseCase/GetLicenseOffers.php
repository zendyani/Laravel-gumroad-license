<?php

namespace App\Modules\License\UseCase;

use App\Modules\License\Enum\License;
use App\Modules\License\Dto\Input\GetLicenseOffersInputDto;

final class GetLicenseOffers {
    /**
     * @param \App\Modules\License\Dto\Input\GetLicenseOffersInputDto $input
     * @return array
     */
    public function execute(GetLicenseOffersInputDto $input): array {
        return License::filterByGroup($input->getGroupName());
    }
}
