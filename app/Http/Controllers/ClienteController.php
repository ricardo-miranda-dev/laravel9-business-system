<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Documento;
use App\Models\Persona;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreClienteRequest;
use App\Http\Requests\UpdateClienteRequest;

class ClienteController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-cliente|crear-cliente|editar-cliente|eliminar-cliente',['only'=>['index']]);
        $this->middleware('permission:crear-cliente',['only'=>['create','store']]);
        $this->middleware('permission:editar-cliente',['only'=>['edit','update']]);
        $this->middleware('permission:eliminar-cliente',['only'=>['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes = Cliente::with('persona.documento')->latest()->get();
        return view('cliente.index', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $documentos = Documento::all();
        return view('cliente.create', compact('documentos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClienteRequest $request)
    {
        try {
            DB::beginTransaction();
            $persona=Persona::create($request->validated());
            $persona->cliente()->create([
                'persona_id' =>$persona->id
            ]);
            DB::commit();
        } catch (Exception $exc) {
            //echo $exc->getTraceAsString();
            DB::rollBack();
        }
        return redirect()->route('clientes.index')->with('success','Cliente registrado exitosamente');
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
    public function edit(Cliente $cliente)
    {
        $cliente->load('persona.documento');
        $documentos = Documento::all();
        return view('cliente.edit', compact('cliente','documentos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClienteRequest $request, Cliente $cliente)
    {
        try {
            DB::beginTransaction();
            Persona::where('id',$cliente->persona->id)
                    ->update($request->validated());
            
            DB::commit();
        } catch (Exception $exc) {
            //echo $exc->getTraceAsString();
            DB::rollBack();
        }
        return redirect()->route('clientes.index')->with('success','Cliente editado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cliente = Cliente:: find($id);
        if($cliente->persona->estado == 1){
            Persona::where('id',$cliente->persona->id)
                ->update([
                    'estado' => 0
                ]);
            $message='Cliente eliminado exitosamente';
        }else{
            Persona::where('id',$cliente->persona->id)
                ->update([
                    'estado' => 1
                ]);
            $message='Cliente restaurado exitosamente';
        }
        
        return redirect()->route('clientes.index')->with('success',$message);
    }
}
