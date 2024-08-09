<?php

namespace App\Services;

use App\Models\License;
use Illuminate\Support\Facades\Http;
use App\Modules\License\Enum\License as LicenseType;
use App\Modules\License\Port\LicenseServiceInterface;

class LicenseService implements LicenseServiceInterface {
    /**
     * Verifies the license with Gumroad and saves the data.
     *
     * @param string $license_key
     * @param LicenseType $productCode
     * @return License|false
     */
    protected function verifyAndSaveLicense(string $license_key, LicenseType $productCode) {

        $response = Http::post('https://api.gumroad.com/v2/licenses/verify', [
            'product_id' => $productCode->value,
            'license_key' => $license_key,
        ]);

        if ($response->successful()) {
            $data = $response->json();

            // Map the response data to the model's fillable attributes
            $licenseData = [
                'license' => $data['license_key'],
                'email' => $data['purchase']['email'],
                'product_permalink' => $data['purchase']['product_permalink'],
                'product_name' => $data['purchase']['product_name'],
                'price' => $data['purchase']['price'],
                'ip_country' => $data['purchase']['ip_country'],
                'recurrence' => $data['purchase']['recurrence'],
                'uses' => $data['uses'],
                'sale_timestamp' => $data['purchase']['sale_timestamp'],
                'product_code' => $data['purchase']['product_id'],
                'subscription_ended_at' => $data['purchase']['subscription_ended_at'] ?? null,
                'subscription_cancelled_at' => $data['purchase']['subscription_cancelled_at'] ?? null,
                'subscription_failed_at' => $data['purchase']['subscription_failed_at'] ?? null,
            ];

            // Create and return the License model instance
            return License::create($licenseData);
        }

        return false;

    }

    /**
     * @inheritDoc
     */
    public function isValid(string $license_key, LicenseType $productCode): bool {
        try {
            $license = $this->verifyAndSaveLicense($license_key, $productCode);

            return $license &&
                $license->success &&
                $license->subscription_ended_at == null &&
                $license->subscription_cancelled_at == null &&
                $license->subscription_failed_at == null;

        } catch (\Throwable $th) {
            throw $th;
        }

    }
}
