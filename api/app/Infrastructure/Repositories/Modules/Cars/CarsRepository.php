<?php

namespace App\Infrastructure\Repositories\Modules\Cars;

use App\Domains\Cars\Entities\Car;
use App\Infrastructure\Repositories\BaseRepository;
use App\Infrastructure\Repositories\Modules\Cars\Interfaces\ICarsRepository;

class CarsRepository extends BaseRepository implements ICarsRepository
{

    private function getListWithFilter($filter)
    {

        $queryBuilder = $this->model->join('brands', 'brands.id', 'cars.brand_id')->orderBy('cars.created_at', 'DESC');

        if ($filter) {
            foreach ($filter as $name => $value) {

                if (is_null($value) && $value != '0') {
                    continue;
                }

                switch ($name) {
                    case 'model':
                        $queryBuilder->where('cars.model', 'like', "%" . $value . "%");
                        break;
                    case 'brand_id':
                        $queryBuilder->where('cars.brand_id', $value);
                }
            }
        }

        $queryBuilder->select('cars.id',
            'brands.name as brande_name',
            'cars.brand_id',
            'cars.model',
            'cars.color',
            'cars.engine',
            'cars.year_of_manufacture');

        return $queryBuilder;
    }

    public function getWidgets()
    {

        $queryBuilder = $this->model->join('brands', 'brands.id', 'cars.brand_id');

        $queryBuilder->selectRaw(
            'COUNT(cars.id) as total, sum(IF(HOUR(TIMEDIFF(cars.created_at, now())) < 24, 1, 0 )) as recently_created,
COUNT(DISTINCT(cars.brand_id)) as total_brands'
        );

        $queryBuilder = $queryBuilder->first();

        return $queryBuilder;
    }

    public function getListWithFilterPaginate($itemsByPage, $filter)
    {

        $queryBuilder = $this->getListWithFilter($filter);

        $queryBuilder = $queryBuilder->paginate($itemsByPage);

        return $queryBuilder;

    }

    function model()
    {
        return Car::class;
    }
}
