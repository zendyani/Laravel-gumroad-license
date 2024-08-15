<?php

namespace App\Modules\License\Domain\Repositories;

use App\Models\FigmaUser;
use App\Modules\License\Domain\Dtos\FigmaUserDto;

interface FigmaUserRepositoryInterface {
    /**
     * @param string $id
     * @return null|FigmaUser
     */
    public function findByFigmaId(string $id): ?FigmaUser;

    /**
     * @param string $apiKey
     * @return null|FigmaUser
     */
    public function findOneByApiKey(string $apiKey): ?FigmaUser;

    /**
     * @param FigmaUserDto $data
     * @return \App\Models\FigmaUser
     */
    public function save(FigmaUserDto $data): FigmaUser;

}
