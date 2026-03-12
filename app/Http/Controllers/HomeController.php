<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venta;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index() {
        $ventasPorMes = Venta::select(
            DB::raw('MONTH(fecha_hora) as mes'),
            DB::raw('SUM(total) as total')
        )
        ->groupBy('mes')
        ->orderBy('mes')
        ->get();        

        $labels = [];
        $data = [];
        
        $ventasPorDia = Venta::select(
            DB::raw('DATE(fecha_hora) as dia'),
            DB::raw('SUM(total) as total')
        )
        ->groupBy('dia')
        ->orderBy('dia')
        ->take(10)
        ->get();
        
        $labels2 = [];
        $data2 = [];

        foreach ($ventasPorMes as $venta) {
            $labels[] = $venta->mes;
            $data[] = $venta->total;
        }
        
        foreach ($ventasPorDia as $ventad) {
            $labels2[] = $ventad->dia;
            $data2[] = $ventad->total;
        }
        
        return view('panel.index', compact('labels','data','labels2','data2'));
    }
}
