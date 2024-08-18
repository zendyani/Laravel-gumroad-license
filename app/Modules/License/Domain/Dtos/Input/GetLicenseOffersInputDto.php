<?php

namespace App\Modules\License\Domain\Dtos\Input;

use App\Modules\License\Domain\Enums\LicenseGroup;

class GetLicenseOffersInputDto {
    public function __construct(private LicenseGroup $group) {
    }
    public function getGroupName(): LicenseGroup {
        return $this->group;
    }
}
