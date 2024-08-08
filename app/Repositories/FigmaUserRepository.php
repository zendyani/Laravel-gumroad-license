<?php

namespace App\Repositories;

use App\Models\FigmaUser;
use App\Modules\License\Dto\FigmaUserDto;
use App\Modules\License\Repository\FigmaUserRepositoryInterface;

class FigmaUserRepository implements FigmaUserRepositoryInterface {
    /**
     * @inheritDoc
     */
    public function findByFigmaId(string $id): ?FigmaUser {
        return FigmaUser::query()->where('figma_id', $id)->first();
    }

    /**
     * @inheritDoc
     */
    public function save(FigmaUserDto $data): FigmaUser {
        $user = FigmaUser::query()->where('figma_id', $data->getFigmaId())->first();

        if (!$user) {
            $user = new FigmaUser();
        }

        $user->api_key = $data->getApiKey();
        $user->figma_id = $data->getFigmaId();
        $user->figma_name = $data->getFigmaName();

        $user->save();

        return $user;
    }
}
