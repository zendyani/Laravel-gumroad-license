<?php

namespace App\Modules\License\Dto;

class FigmaUserDto {
    public function __construct(private string $apiKey, private string $figmaId, private string $figmaName) {}

    public function getApiKey() {
        return $this->apiKey;
    }

    public function getFigmaId() {
        return $this->figmaId;
    }

    public function getFigmaName() {
        return $this->figmaName;
    }

    public function all() {
        return [
            'api_key' => $this->apiKey,
            'figma_id' => $this->figmaId,
            'figma_name' => $this->figmaName
        ];
    }
}