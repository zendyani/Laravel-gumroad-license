<?php

namespace App\Repositories;

use App\Models\FigmaUser;
use App\Modules\License\Dto\FigmaUserDto;
use App\Modules\License\Repository\FigmaUserRepositoryInterface;

class FigmaUserRepository implements FigmaUserRepositoryInterface
{
    /**
     * @param string $id
     * @return null|FigmaUser
     */
    public function findByFigmaId(string $id): ?FigmaUser
    {
        return FigmaUser::where('figma_id', $id)->first();
    }

    /**
     * @param FigmaUserDto $data
     * @return FigmaUser
     */
    public function save(FigmaUserDto $data): FigmaUser
    {
        $user = FigmaUser::where('figma_id', $data->getFigmaId())->first();

        if (!$user) {
            $user = new FigmaUser();
        }

        $user->fill($data->all());
        $user->save();

        return $user;
    }
}