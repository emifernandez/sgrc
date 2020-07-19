<?php

namespace App\Http\Controllers\Region;

use App\Http\Controllers\Controller;
use App\Http\Requests\Region\StoreRegionRequest;
use App\Http\Requests\Region\UpdateRegionRequest;
use App\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class RegionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $regiones = Region::all();
        return View::make('region.index')
            ->with('regiones', $regiones);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('region.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRegionRequest $request)
    {
        $region = new Region([
            'nombre' => $request->get('nombre')
        ]);
        $region->save();
        return redirect('/region')->with('success', 'Region Sanitaria grabada correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function show(Region $region)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function edit(Region $region)
    {
        return view('region.edit')->with('region',$region);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRegionRequest $request, Region $region)
    {
        $region->fill($request->all());
    	$region->save();
    	return redirect('/region')->with('success', 'Region Sanitaria actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $region = Region::findOrFail($request->id);
        $region->delete();
        return redirect()->route('region.index')->with('success', 'Region Sanitaria eliminada correctamente');
    }
}
