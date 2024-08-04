<?php

namespace App\Modules\License\Repository;
use App\Models\FigmaUser;

interface FigmaUserRepositoryInterface {
    /**
     * @param string $id
     * @return null|FigmaUser
     */
    public function findByFigmaId(string $id): ?FigmaUser;

    /**
     * @param array $data
     * @return \App\Models\FigmaUser
     */
    public function save(array $data): FigmaUser;
    
}