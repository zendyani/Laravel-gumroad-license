<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Bus;
use App\Http\Requests\AddLicenseRequest;
use App\Modules\License\Domain\Enums\License;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Modules\License\Domain\Dtos\Input\ValidateLicenseInputDto;
use App\Modules\License\Application\Commands\ValidateAndSaveLicenseCommand;

class AddLicenseController extends Controller {
    /**
     * Handle the incoming request.
     */
    public function __invoke(AddLicenseRequest $request): JsonResponse {
        // The request is automatically validated before this point
        $data = $request->validated();

        // Accessing data from the request
        $apiKey = $data['api-key'];
        $licenseKey = $data['license-key'];
        $productCode = License::from($data['product-code']);

        $input = new ValidateLicenseInputDto($apiKey, $licenseKey, $productCode);

        try {
            $result = Bus::dispatch(new ValidateAndSaveLicenseCommand($input));
        } catch (\Throwable $e) {
            throw new HttpResponseException(
                response()->json([
                    'success' => false,
                    'message' => 'Validation errors',
                    'errors' => $e->getMessage()
                ], 422)
            );
        }

        // Return the result as a JSON response
        return response()->json($result);
    }
}
