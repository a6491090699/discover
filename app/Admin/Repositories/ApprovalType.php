<?php

namespace App\Admin\Repositories;

use App\Models\ApprovalType as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class ApprovalType extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
