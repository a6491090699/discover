<?php

namespace App\Admin\Repositories;

use App\Models\PurchaseOrderBack as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class PurchaseOrderBack extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
