<?php

namespace App\Domains\Cars\Entities;


class Brand extends ModelBase

{
    protected $table = 'brands';

    protected $fillable= [
        'id',
        'name',
        'default',
    ];

}
