<?php

namespace App\Admin\Repositories;

use App\Models\SaleBackOrder as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class SaleBackOrder extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
