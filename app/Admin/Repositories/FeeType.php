<?php

namespace App\Admin\Repositories;

use App\Models\FeeType as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class FeeType extends EloquentRepository
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
