<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Modules\License\Dto\LicenseResponseDto;
use App\Modules\License\Enum\License as LicenseType;
use App\Modules\License\Port\LicenseServiceInterface;

class LicenseService implements LicenseServiceInterface {
    /**
     * @inheritDoc
     */
    public function requestLicenseData(string $license_key, LicenseType $productCode): LicenseResponseDto|bool {

        $response = Http::post('https://api.gumroad.com/v2/licenses/verify', [
            'product_id' => $productCode->value,
            'license_key' => $license_key,
        ]);

        if ($response->successful()) {
            $data = $response->json();

            // Map the response data to the model's fillable attributes
            $licenseData = new LicenseResponseDto(
                (string) $data['license_key'],
                (string) $data['purchase']['email'],
                (string) $data['purchase']['product_name'],
                (string) $data['purchase']['product_permalink'],
                (string) $data['purchase']['short_product_id'],
                (int) $data['purchase']['price'],
                (string) $data['purchase']['recurrence'],
                (string) $data['purchase']['ip_country'],
                // $licenseModel->setSaleTimestamp($sale_timestamp),
                $data['uses'],
                $data['purchase']['subscription_ended_at'],
                $data['purchase']['subscription_cancelled_at'],
                $data['purchase']['subscription_failed_at'],
            );

            return $licenseData;
        }

        return false;
    }

    /**
     * @inheritDoc
     */
    public function isValid(string $license_key, LicenseType $productCode): bool {
        try {
            $license = $this->requestLicenseData($license_key, $productCode);

            return $license &&
                $license->getSubscriptionEndedAt() == null &&
                $license->getSubscriptionCancelledAt() == null &&
                $license->getSubscriptionFailedAt() == null;

        } catch (\Throwable $th) {
            throw $th;
        }

    }
}
