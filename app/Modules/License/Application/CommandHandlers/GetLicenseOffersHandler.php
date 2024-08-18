<?php

namespace App\Modules\License\Application\CommandHandlers;

use App\Modules\License\Domain\Enums\License;
use App\Modules\License\Application\Commands\GetLicenseOffersCommand;

class GetLicenseOffersHandler {
    /**
     * Summary of handle
     * @param \App\Modules\License\Application\Commands\GetLicenseOffersCommand $command
     * @return License[]
     */
    public function handle(GetLicenseOffersCommand $command): array {
        return License::filterByGroup($command->input->getGroupName());
    }
}
