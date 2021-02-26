<?php

namespace App\Domains\Cars\Entities;


class Car extends ModelBase

{
    protected $table = 'cars';

    protected $fillable= [
        'id',
        'brand_id',
        'engine',
        'color',
        'model',
        'year_of_manufacture'
    ];

    protected $dates = [
        'deleted_at',
        'created_at',
        'updated_at'
    ];
}
