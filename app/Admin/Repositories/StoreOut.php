<?php

namespace App\Admin\Repositories;

use App\Models\StoreOut as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class StoreOut extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
