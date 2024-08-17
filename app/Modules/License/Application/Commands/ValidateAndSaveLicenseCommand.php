<?php

namespace App\Modules\License\Application\Commands;

use App\Modules\License\Domain\Dtos\Input\ValidateLicenseInputDto;

class ValidateAndSaveLicenseCommand {
    public function __construct(public readonly ValidateLicenseInputDto $input) {
    }
}
