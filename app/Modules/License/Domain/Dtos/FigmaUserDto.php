<?php

namespace App\Modules\License\Domain\Dtos;

class FigmaUserDto {
    public function __construct(private string $apiKey, private string $figmaId, private string $figmaName) {
    }

    public function getApiKey(): string {
        return $this->apiKey;
    }

    public function getFigmaId(): string {
        return $this->figmaId;
    }

    public function getFigmaName(): string {
        return $this->figmaName;
    }
}
