<?php

namespace App\Admin\Repositories;

use App\Models\Provider as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class Provider extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
