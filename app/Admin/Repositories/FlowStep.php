<?php

namespace App\Admin\Repositories;

use App\Models\FlowStep as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class FlowStep extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
