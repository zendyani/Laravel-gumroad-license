<?php

namespace App\Modules\License\UseCase;

use App\Modules\License\Enum\License;
use App\Modules\License\Dto\GetLicenseOffersInputDto;

final class GetLicenseOffers {
    public function execute(GetLicenseOffersInputDto $input): array {
        return License::filterByGroup($input->getGroupName());
    }
}
