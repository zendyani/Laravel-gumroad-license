<?php

namespace App\Services;
use App\Modules\License\Port\ApiKeyServiceInterface;
use Illuminate\Support\Str;

class ApiKeyService implements ApiKeyServiceInterface {
 
    /**
     * Summary of generate
     * @return string
     */
    public function generate(): string {
        return Str::uuid();
    }

    /**
     * Validates if the given API key is a valid UUID.
     * @param string $key
     * @return bool
     */
    public function isValid(string $key): bool {
        return Str::isUuid($key);
    }

}