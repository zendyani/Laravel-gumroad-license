<?php

namespace App\Modules\License\Domain\Dtos;

class FigmaUserDto {
    public function __construct(private string $apiKey, private string $figmaId, private string $figmaName) {
    }

    public function getApiKey() {
        return $this->apiKey;
    }

    public function getFigmaId() {
        return $this->figmaId;
    }

    public function getFigmaName() {
        return $this->figmaName;
    }
}
