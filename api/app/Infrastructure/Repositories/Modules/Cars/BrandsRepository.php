<?php

namespace App\Infrastructure\Repositories\Modules\Cars;

use App\Domains\Cars\Entities\Brand;
use App\Infrastructure\Repositories\BaseRepository;

class BrandsRepository extends BaseRepository
{

    public function getAllBrands(int $default = null){

        $queryBuilder = $this->model;

        if ($default){
            $queryBuilder->where('default', $default);
        }

        return $queryBuilder;
    }

    public function getCountAllBrands(int $default = 1){

        $queryBuilder = $this->getAllBrands($default);

        return $queryBuilder->count();
    }


    function model()
    {
        return Brand::class;
    }
}
