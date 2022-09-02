<?php

namespace App\Admin\Repositories;

use App\Models\PurchaseBackItem as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class PurchaseBackItem extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
