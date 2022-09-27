<?php

namespace App\Services;

class ModelBaseService
{

    public function create($data)
    {
        $new = new $this->model();
        $new->fill($data)->save();
        return $new;
    }

    public function update($id, $data)
    {
        // $updates = collect($data);

        return $this->model::where('id', $id)->update($data);
    }

    public function delete($id)
    {
        return $this->model::destroy($id);
    }

    public function list($where = [], $with = [], $page = 1, $pagesize = 10, $order_field = 'id', $order_sort = 'desc')
    {

        return $this->model::with($with)->when($where, function ($where, $query) {
            foreach ($where as $key => $item) {
                $query->where($key, $item);
            }
        })->orderBy($order_field, $order_sort)->paginate($pagesize, ['*'], 'page', $page);
    }


    public static function find($id = 0)
    {
        return $this->model::find($id);
    }

    public function selectItem()
    {
        return $this->model::get($this->select_value??'*');
    }
}