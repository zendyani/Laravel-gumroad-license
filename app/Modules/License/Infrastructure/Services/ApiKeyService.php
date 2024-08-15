<?php

namespace App\Modules\License\Infrastructure\Services;

use Illuminate\Support\Str;
use App\Modules\License\Domain\Port\ApiKeyServiceInterface;

class ApiKeyService implements ApiKeyServiceInterface {
    /**
     * @inheritDoc
     */
    public function generate(): string {
        return Str::uuid();
    }

    /**
     * @inheritDoc
     */
    public function isValid(string $key): bool {
        return Str::isUuid($key);
    }

}
