<?php

namespace App\Admin\Repositories;

use App\Models\Approval;
use App\Models\Flow as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class Flow extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;

    public function selectItems()
    {
        return $this->eloquentClass::pluck('title','id')->toarray();
    }
}
