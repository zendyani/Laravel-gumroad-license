<?php

namespace App\Modules\License\Application\Commands;

use App\Modules\License\Domain\Dtos\Input\GetTokenInputDto;

final class GetTokenCommand {
    public function __construct(public readonly GetTokenInputDto $input) {
    }
}
