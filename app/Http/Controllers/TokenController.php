<?php

namespace App\Http\Controllers;

use App\Http\Requests\TokenRequest;
use App\Modules\License\Dto\GetTokenInputDto;
use App\Modules\License\Enum\License;
use App\Modules\License\UseCase\GetToken;
use Illuminate\Http\Request;

class TokenController extends Controller
{
    public function __construct(
        protected GetToken $command
    ) {
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(TokenRequest $request)
    {
        // The request is automatically validated before this point
        $data = $request->validated();

        // Accessing data from the request
        $figmaId = $data['id'];
        $figmaName = $data['name'];
        $productCode = License::from($data['code']);

        
        $input = new GetTokenInputDto($figmaId, $figmaName, $productCode);
        return $this->command->execute($input);
    }
}
