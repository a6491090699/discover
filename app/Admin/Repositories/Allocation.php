<?php

namespace App\Admin\Repositories;

use App\Models\Allocation as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class Allocation extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
