<?php

namespace App\Services;

use Illuminate\Support\Str;
use App\Modules\License\Port\ApiKeyServiceInterface;

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
