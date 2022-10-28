<?php

namespace App\Admin\Repositories;

use App\Models\Message as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class Message extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;

    public function read($id)
    {
        $message = Model::find($id);
        $message->is_read = 1;
        $message->save();
        return true;
    }

    public function add($from_uid ,$to_uid , $content , $type , $to_url)
    {  
        $message = new Model();
        $message->from_uid = $from_uid;
        $message->to_uid = $to_uid;
        $message->content = $content;
        $message->type = $type;
        $message->to_url = $to_url;
        $message->is_read = 0;
        $message->save();
        
    }


}
