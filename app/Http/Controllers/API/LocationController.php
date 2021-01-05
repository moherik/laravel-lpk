<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLocationRequest;
use App\Http\Resources\LocationResource;
use App\Models\Location;

class LocationController extends Controller
{
    protected $model;

    public function __construct(Location $model)
    {
        $this->model = $model;        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return LocationResource::collection(
            $this->model->where('status', 'PUBLISH')->orderBy('created_at', 'desc')->get()
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreLocationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLocationRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['user_id'] = auth()->user()->id;
        $store = $this->model->create($validatedData);
        if(!$store)
            return response()->json(['message' => 'Error saving data']);

        return new LocationResource($store);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $location = $this->model->where('id', $id)->where('status', 'PUBLISH')->firstOrFail();
        return new LocationResource($location);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreLocationRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreLocationRequest $request, $id)
    {
        $location = $this->model->where('id', $id)->first();

        $validatedData = $request->validate();
        $validatedData["user_id"] = auth()->user()->id;

        $update = $location->update($validatedData);
        if(!$update)
            return response()->json(['message' => 'Error saving data']);

        return response()->json(['message' => 'Success saving data']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $location = $this->model->where('id', $id)->firstOrFail();
        $location->delete();
    }
}
