<?php

namespace App\Admin\Repositories;

use App\Models\SellPayLog as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class SellPayLog extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;

    public function selectItems()
    {
        return $this->eloquentClass::pluck('sn', 'id')->toarray();
    }
}
