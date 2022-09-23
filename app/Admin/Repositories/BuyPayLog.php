<?php

namespace App\Admin\Repositories;

use App\Models\BuyPayLog as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class BuyPayLog extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
