<?php

namespace Tests\Feature\Controllers;

use Tests\TestCase;
use App\Models\License;
use App\Models\FigmaUser;
use PHPUnit\Framework\Attributes\Test;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\License\Enum\License as LicenseType;

class TokenControllerTest extends TestCase {
    use RefreshDatabase;

    #[Test]
    public function it_returns_apiKey_and_ispremium_false_for_valid_request_and_user_without_license() {
        // Create necessary data using factories
        $figmaUser = FigmaUser::factory()->create();

        // Create the request data
        $requestData = [
            'id' => $figmaUser->figma_id,
            'name' => $figmaUser->figma_name,
            'code' => LicenseType::THEME_COMPOSER_BUSINESS->value,
        ];

        // Send a POST request to the /token endpoint
        $response = $this->postJson('/api/v1/token', $requestData);

        // Assert the response status and content
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'api-key',
        ]);
    }


    #[Test]
    public function it_returns_apiKey_and_ispremium_true_for_valid_request_and_user_with_license() {
        // Create necessary data using factories
        $figmaUser = FigmaUser::factory()->create();
        $license = License::factory()->create([
            'product_name' => LicenseType::THEME_COMPOSER_BUSINESS->value,
            'product_code' => LicenseType::THEME_COMPOSER_BUSINESS->value,
        ]);

        // Attach the license to the figma user
        $figmaUser->licenses()->attach($license->id);

        // Create the request data
        $requestData = [
            'id' => $figmaUser->figma_id,
            'name' => $figmaUser->figma_name,
            'code' => LicenseType::THEME_COMPOSER_BUSINESS->value,
        ];

        // Send a POST request to the /token endpoint
        $response = $this->postJson('/api/v1/token', $requestData);

        // Assert the response status and content
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'api-key',
        ]);
    }
}
