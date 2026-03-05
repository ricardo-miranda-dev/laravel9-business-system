<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StorePresentacionRequest;
use App\Http\Requests\UpdatePresentacionRequest;
use App\Models\Caracteristica;
use App\Models\Presentacione;
use Illuminate\Support\Facades\DB;

class PresentacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $presentaciones = Presentacione::with('caracteristica')->latest()->get();
        return view('presentacion.index',['presentaciones' => $presentaciones]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('presentacion.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePresentacionRequest $request)
    {
        //dd($request);
        try {
            DB::beginTransaction();
            $caracteristica=Caracteristica::create($request->validated());
            $caracteristica->presentacione()->create([
                'caracteristica_id' =>$caracteristica->id
            ]);
            DB::commit();
        } catch (Exception $exc) {
            //echo $exc->getTraceAsString();
            DB::rollBack();
        }
        return redirect()->route('presentaciones.index')->with('success','Presentación registrada exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Presentacione $presentacione)
    {
        //dd($presentacion);
        return view('presentacion.edit',['presentacione' =>$presentacione]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePresentacionRequest $request, Presentacione $presentacione)
    {
        Caracteristica::where('id',$presentacione->caracteristica->id)
                ->update($request->validated());
        return redirect()->route('presentaciones.index')->with('success','Presentación editada exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //dd($id);
        $presentacion = Presentacione:: find($id);
        if($presentacion->caracteristica->estado == 1){
            Caracteristica::where('id',$presentacion->caracteristica->id)
                ->update([
                    'estado' => 0
                ]);
            $message='Presentación eliminada exitosamente';
        }else{
            Caracteristica::where('id',$presentacion->caracteristica->id)
                ->update([
                    'estado' => 1
                ]);
            $message='Presentación restaurada exitosamente';
        }
        
        return redirect()->route('presentaciones.index')->with('success',$message);
    }
}
