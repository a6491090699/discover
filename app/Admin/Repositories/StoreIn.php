<?php

namespace App\Admin\Repositories;

use App\Models\StoreIn as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class StoreIn extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
