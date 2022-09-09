<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Contracts\Validation\Factory as ValidationFactory;

class Base extends FormRequest
{

    /**
     * 验证场景
     *
     * @var string
     */
    public $scene = [];

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Create the default validator instance.
     *
     * @param  \Illuminate\Contracts\Validation\Factory  $factory
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function createDefaultValidator(ValidationFactory $factory)
    {

        return $factory->make(
            $this->validationData(), $this->getSceneRules(),
            $this->messages(), $this->attributes()
        );
    }

    /**
     * 获取场景验证规则
     *
     * @return array
     */
    protected function getSceneRules()
    {
        return $this->handleScene($this->container->call([$this, 'rules']));
    }

    /***
     * 基于路由名称的场景验证
     *
     * @param array $rule
     * @return array
     */
    public function handleScene(array $rule)
    {

        $arr = [];

        foreach (($scene = $this->scene[$this->getSceneName()] ?? []) as $item){
            if( isset($rule[$item])){
                $arr[$item] = $rule[$item];
            }
        }

        return  $arr ?: $rule;
    }

    /**
     * 获取场景名称
     *
     * @return string
     */
    public function getSceneName()
    {
        return $this->input('_scene', $this->route()->getName());
    }

    /**
     * Get data to be validated from the request.
     *
     * @return array
     */
    public function validationData()
    {
        return $this->all();
    }
}