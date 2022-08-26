<?php

namespace App\Admin\Repositories;

use App\Models\FrameContract as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class FrameContract extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;

    public function create_sn()
    {
        $number = create_uniqid_sn('frame_contract');
        return $number;
    }

    public function update_autoincrement()
    {
        increment_uniqid_sn('frame_contract');
    }
}
