<?php

namespace Database\Seeders;

use App\Domains\Account\Entities\User;
use App\Domains\Cars\Entities\Brand;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public $brands = [
        'BMW',
        'HONDA',
        'TOYOTA',
        'FERRARI',
        'MERCEDES BENZ',
        'VOLKSWAGEN',
        'CHEVROLET',
        'FORD',
        'RENAULT',
        'TESLA',
        'SUZUKI',
        'NISSAN',
        'MAZOA',
        'PORSCHE',
        'JEEP',
        'ACURA',
        'CITROEN',
        'LAND ROVER',
        'AUDI'
    ];

    public function run()
    {

        foreach ($this->brands as $index => $item){
            $brand = [
                'name' => $this->brands[$index],
                'default' => 1
            ];

            try {

            Brand::create($brand);

            }catch (\Exception $e){
                print('Você já utilizou o comando db:seed anteriormente.');
            }

        }

        print('Marcas de carro padrões inseridas com sucesso!');


    }
}
