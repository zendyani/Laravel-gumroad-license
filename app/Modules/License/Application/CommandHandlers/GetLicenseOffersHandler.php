<?php

namespace App\Modules\License\Application\CommandHandlers;

use App\Modules\License\Domain\Enums\License;
use App\Modules\License\Application\Commands\GetLicenseOffersCommand;

class GetLicenseOffersHandler {
    public function handle(GetLicenseOffersCommand $command): array {
        return License::filterByGroup($command->input->getGroupName());
    }
}
