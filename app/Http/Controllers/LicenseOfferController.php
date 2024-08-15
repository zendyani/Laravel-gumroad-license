<?php

namespace App\Http\Controllers;

use App\Rules\ValidLicenseGroup;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Bus;
use App\Modules\License\Domain\Enums\LicenseGroup;
use App\Modules\License\Domain\Dtos\Input\GetLicenseOffersInputDto;
use App\Modules\License\Application\Commands\GetLicenseOffersCommand;

class LicenseOfferController extends Controller {
    /**
     * Displaying license offers filtred by group name
     * @param string $licenseGroup
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(string $licenseGroup): JsonResponse {

        $validator = \Validator::make(['licenseGroup' => $licenseGroup], [
            'licenseGroup' => ['required', 'string', new ValidLicenseGroup()],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $command = new GetLicenseOffersCommand(new GetLicenseOffersInputDto(LicenseGroup::from($licenseGroup)));

        $result = Bus::dispatch($command);

        return response()->json($result);
    }
}
