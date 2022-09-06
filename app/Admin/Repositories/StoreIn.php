<?php

namespace App\Admin\Repositories;

use App\Models\StoreIn as Model;
use Dcat\Admin\Form;
use Dcat\Admin\Repositories\EloquentRepository;
use Illuminate\Support\Facades\Log;

class StoreIn extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;

    public function store(Form $form)
    {
        $ret = parent::store($form);
        

        return $ret;
    }

    // public function getFormColumns()
    // {
    //     return [$this->getKeyName(), 'name', 'title', 'created_at'];
    // }

}
