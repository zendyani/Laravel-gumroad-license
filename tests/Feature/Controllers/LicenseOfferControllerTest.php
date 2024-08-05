<?php

namespace Tests\Feature\Controllers;

use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class LicenseOfferControllerTest extends TestCase
{
    #[Test]
    public function it_should_succeed_with_valid_license_group()
    {
        $licenseGroup = 'theme-composer'; 

        $response = $this->json("get", "/api/v1/license-offers/{$licenseGroup}");

        $response->assertStatus(200);
    }

    #[Test]
    public function it_should_fail_with_invalid_license_group()
    {
        $licenseGroup = 'invalidGroup'; // Replace with an invalid license group string

        $response = $this->json('GET', "/api/v1/license-offers/{$licenseGroup}");

        $response->assertStatus(422);
    }
}
