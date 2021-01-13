<?php

namespace App\Http\Controllers\Seguro;

use App\Http\Controllers\Controller;
use App\Http\Requests\Seguro\StoreSeguroRequest;
use App\Http\Requests\Seguro\UpdateSeguroRequest;
use App\Seguro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class SeguroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $seguros = Seguro::all();
        return View::make('seguro.index')
            ->with('seguros', $seguros);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('seguro.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSeguroRequest $request)
    {
        $seguro = new Seguro([
            'nombre' => $request->get('nombre')
        ]);
        $seguro->save();
        return redirect('/seguro')->with('success', 'Seguro grabado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Seguro  $seguro
     * @return \Illuminate\Http\Response
     */
    public function show(Seguro $seguro)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Seguro  $seguro
     * @return \Illuminate\Http\Response
     */
    public function edit(Seguro $seguro)
    {
        return view('seguro.edit')->with('seguro', $seguro);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Seguro  $seguro
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSeguroRequest $request, Seguro $seguro)
    {
        $seguro->fill($request->all());
        $seguro->save();
        return redirect('/seguro')->with('success', 'Seguro actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Seguro  $seguro
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $seguro = Seguro::findOrFail($request->id);
        $seguro->delete();
        return redirect()->route('seguro.index')->with('success', 'Seguro eliminado correctamente');
    }
}
