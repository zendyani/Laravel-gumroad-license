<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rules\ValidLicenseGroup;
use Illuminate\Http\JsonResponse;
use App\Modules\License\Enum\LicenseGroup;
use App\Modules\License\UseCase\GetLicenseOffers;
use App\Modules\License\Dto\Input\GetLicenseOffersInputDto;

class LicenseOfferController extends Controller {
    public function __construct(protected GetLicenseOffers $command) {
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, string $licenseGroup): JsonResponse {
        $validator = \Validator::make(['licenseGroup' => $licenseGroup], [
            'licenseGroup' => ['required', 'string', new ValidLicenseGroup()],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $input = new GetLicenseOffersInputDto(LicenseGroup::from($licenseGroup));
        $result = $this->command->execute($input);

        // Return the result as a JSON response
        return response()->json($result);
    }
}
