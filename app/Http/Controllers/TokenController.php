<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use App\Http\Requests\TokenRequest;
use Illuminate\Support\Facades\Bus;
use App\Modules\License\Domain\Enums\License;
use App\Modules\License\Domain\Dtos\Input\GetTokenInputDto;
use App\Modules\License\Application\Commands\GetTokenCommand;

class TokenController extends Controller {
    /**
     * Handle the incoming request.
     */
    public function __invoke(TokenRequest $request): JsonResponse {
        // The request is automatically validated before this point
        $data = $request->validated();

        // Accessing data from the request
        $figmaId = $data['id'];
        $figmaName = $data['name'];
        $productCode = License::from($data['code']);

        $input = new GetTokenInputDto($figmaId, $figmaName, $productCode);
        $result = Bus::dispatch(new GetTokenCommand($input));

        // Return the result as a JSON response
        return response()->json($result);
    }
}
