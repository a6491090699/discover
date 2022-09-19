<?php

namespace App\Admin\Repositories;

use App\Models\ApprovalFlowType as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class ApprovalFlowType extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
