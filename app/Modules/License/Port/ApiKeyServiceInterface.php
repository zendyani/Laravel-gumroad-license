<?php

namespace App\Modules\License\Port;

interface ApiKeyServiceInterface {
    /**
     * Generates a UUID as the API key.
     * @return string
     */
    public function generate(): string ;

    /**
     * Validates if the given API key is a valid UUID.
     * @param string $key
     * @return bool
     */
    public function isValid(string $key): bool ;
}
