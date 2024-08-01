<?php

namespace App\UseCases\LicenseOffers;
use App\Enums\LicenseGroup;

class GetLicenseOffersInputDto {
    public function __construct(private LicenseGroup $group ){}
    public function getGroupName() {
        return $this->group;
    }
}