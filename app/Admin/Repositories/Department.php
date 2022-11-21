<?php

namespace App\Admin\Repositories;

use App\Models\Department as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class Department extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;

    public function getApiList($company_id)
    {
        $list = Model::where('company_id', $company_id)->get()->toArray();
        $list = list_to_tree($list, 'id', 'parent_id', '_child');

        $ret = $this->loopSome($list);
        return $ret;
    }

    public function loopSome($list, $level=0)
    {
        static $ret = [];

        foreach ($list as $item) {
            $ret[] = [
                'id' => $item['id'],
                'text' => str_repeat('---', $level) . $item['title'],
            ];
            if (isset($item['_child'])) {
                $n = $level+1;
                $this->loopSome($item['_child'], $n);
            }
        }

        return $ret;
    }


    /**
     * Get options for Select field in form.
     *
     * @param \Closure|null $closure
     * @param string        $rootText
     *
     * @return array
     */
    public static function selectOptions(\Closure $closure = null, $rootText = null)
    {
        $rootText = $rootText ?: admin_trans_label('root');

        $options = (new static())->withQuery($closure)->buildSelectOptions();

        return collect($options)->prepend($rootText, 0)->all();
    }

    /**
     * Build options of select field in form.
     *
     * @param array  $nodes
     * @param int    $parentId
     * @param string $prefix
     *
     * @return array
     */
    protected function buildSelectOptions(array $nodes = [], $parentId = 0, $prefix = '')
    {
        $prefix = $prefix ?: str_repeat('&nbsp;', 6);

        $options = [];

        if (empty($nodes)) {
            $nodes = $this->allNodes();
        }

        $titleColumn = $this->getTitleColumn();
        $parentColumn = $this->getParentColumn();

        foreach ($nodes as $node) {
            $node[$titleColumn] = $prefix.'&nbsp;'.$node[$titleColumn];
            if ($node[$parentColumn] == $parentId) {
                $children = $this->buildSelectOptions($nodes, $node[$this->getKeyName()], $prefix.$prefix);

                $options[$node[$this->getKeyName()]] = $node[$titleColumn];

                if ($children) {
                    $options += $children;
                }
            }
        }

        return $options;
    }
}
