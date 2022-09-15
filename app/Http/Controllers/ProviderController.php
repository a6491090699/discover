<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProviderRequest;
use App\Http\Requests\ProviderUpdateRequest;
use App\Services\ProviderService;
use Illuminate\Http\Request;

class ProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = app(ProviderService::class)->list([] , [] , request()->input('page', 1) , 10);
        return $this->_success($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProviderRequest $request)
    {
        $ret = app(ProviderService::class)->create($request->all());
        if ($ret) {
            return $this->_success();
        }
        return $this->_fail();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProviderUpdateRequest $request, $id)
    {
        $ret = app(ProviderService::class)->update($id, $request->all());
        if ($ret) {
            return $this->_success();
        }
        return $this->_fail();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ret = app(ProviderService::class)->delete($id);
        if ($ret) {
            return $this->_success();
        }
        return $this->_fail();//
    }
}
