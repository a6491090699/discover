<?php

namespace App\Admin\Repositories;

use App\Models\AllocationItem as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class AllocationItem extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
