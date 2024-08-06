<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use App\Http\Requests\TokenRequest;
use App\Modules\License\Enum\License;
use App\Modules\License\UseCase\GetToken;
use App\Modules\License\Dto\GetTokenInputDto;

class TokenController extends Controller {
    public function __construct(
        protected GetToken $command
    ) {
    }

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
        $result = $this->command->execute($input);

        // Return the result as a JSON response
        return response()->json($result);
    }
}
