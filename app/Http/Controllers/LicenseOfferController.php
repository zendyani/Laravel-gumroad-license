<?php

namespace App\Http\Controllers;

use App\Modules\License\Dto\GetLicenseOffersInputDto;
use App\Modules\License\Enum\LicenseGroup;
use App\Modules\License\UseCase\GetLicenseOffers;
use App\Rules\ValidLicenseGroup;
use Illuminate\Http\Request;

class LicenseOfferController extends Controller
{

    public function __construct(protected GetLicenseOffers $getLicenseOffers){}

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, string $licenseGroup)
    {
        $validator = \Validator::make(['licenseGroup' => $licenseGroup], [
            'licenseGroup' => ['required', 'string', new ValidLicenseGroup()],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $input = new GetLicenseOffersInputDto(LicenseGroup::from($licenseGroup));
        return $this->getLicenseOffers->execute($input);
    }
}
