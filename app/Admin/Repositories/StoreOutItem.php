<?php

namespace App\Admin\Repositories;

use App\Models\StoreOutItem as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class StoreOutItem extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
