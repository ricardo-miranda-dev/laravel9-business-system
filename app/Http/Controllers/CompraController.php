<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Compra;
use App\Models\Proveedore;
use App\Models\Comprobante;
use App\Models\Producto;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreCompraRequest;
use Carbon\Carbon;

class CompraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $compras = Compra::with('comprobante','proveedore.persona')
                ->where('estado',1)
                ->latest()
                ->get();
        return view('compra.index',compact('compras'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $comprobantes = Comprobante::all();
        $proveedores = Proveedore::whereHas('persona',function($query){
            $query->where('estado',1);
        })->get();
        $productos = Producto::where('estado',1)->get();
        return view('compra.create', compact('proveedores','comprobantes','productos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCompraRequest $request)
    {
        try {
            DB::beginTransaction();
            
            $compra = Compra::create($request->validated());
            
            $arrayProduco_id = $request->get('arrayidproducto');
            $arrayCantidad = $request->get('arraycantidad');
            $arrayPrecioCompra = $request->get('arraypreciocompra');
            $arrayPrecioVenta = $request->get('arrayprecioventa');
            
            $sizeArray = count($arrayProduco_id);
            $cont = 0;
            while($cont<$sizeArray){
                $compra->productos()->syncWithoutDetaching([
                    $arrayProduco_id[$cont] =>[
                        'cantidad' => $arrayCantidad[$cont],
                        'precio_compra'  => $arrayPrecioCompra[$cont],
                        'precio_venta'  => $arrayPrecioVenta[$cont],
                    ]                    
                ]);
                
                $producto = Producto::find($arrayProduco_id[$cont]);
                $stockActual = $producto->stock;
                $stocNuevo = intval($arrayCantidad[$cont]);
                $Stock = $stockActual+$stocNuevo;
                
                DB::table('productos')
                        ->where('id',$producto->id)
                        ->update([
                            'stock' => $Stock
                        ]);
                $cont++;
            }          
            
            
            DB::commit();
        } catch (Exception $exc) {
           
            DB::rollBack();
        }
        
        return redirect()->route('compras.index')->with('success','Compra registrada exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Compra $compra)
    {       
        return view('compra.show', compact('compra'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Compra::where('id',$id)
            ->update([
                'estado'=> 0
            ]);
        return redirect()->route('compras.index')->with('success','Compra eliminada');
    }
}
