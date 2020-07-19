<?php

namespace App\Http\Controllers\Red;

use App\Http\Controllers\Controller;
use App\Http\Requests\Red\StoreRedRequest;
use App\Http\Requests\Red\UpdateRedRequest;
use App\Red;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class RedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $redes = Red::all();
        return View::make('red.index')
            ->with('redes', $redes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('red.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRedRequest $request)
    {
        $red = new Red([
            'nombre' => $request->get('nombre')
        ]);
        $red->save();
        return redirect('/red')->with('success', 'Red grabada correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Red  $red
     * @return \Illuminate\Http\Response
     */
    public function show(Red $red)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Red  $red
     * @return \Illuminate\Http\Response
     */
    public function edit(Red $red)
    {
        return view('red.edit')->with('red',$red);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Red  $red
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRedRequest $request, Red $red)
    {
        $red->fill($request->all());
    	$red->save();
    	return redirect('/red')->with('success', 'Red actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Red  $red
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $red = Red::findOrFail($request->id);
        $red->delete();
        return redirect()->route('red.index')->with('success', 'Red eliminada correctamente');
    }
}
