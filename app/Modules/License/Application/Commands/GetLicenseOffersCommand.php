<?php

namespace App\Modules\License\Application\Commands;

use App\Modules\License\Domain\Dtos\Input\GetLicenseOffersInputDto;

class GetLicenseOffersCommand {
    public function __construct(public readonly GetLicenseOffersInputDto $input) {
    }
}
