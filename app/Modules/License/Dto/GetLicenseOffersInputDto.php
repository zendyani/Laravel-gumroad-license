<?php

namespace App\Modules\License\Dto;

use App\Modules\License\Enum\LicenseGroup;

class GetLicenseOffersInputDto {
    public function __construct(private LicenseGroup $group) {
    }
    public function getGroupName() {
        return $this->group;
    }
}
