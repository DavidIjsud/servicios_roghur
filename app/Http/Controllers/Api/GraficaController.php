<?php

namespace App\Http\Controllers\Api;

use App\DetalleVenta;
use App\Exceptions\MessageException;
use App\Http\Controllers\Controller;
use App\Http\Message\MessageResponse;
use App\Meta;
use App\Producto;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class GraficaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //obtener la cantidad de productos vendidos por meta (mes y producto)
    public function metaAlcanzada(Request $request)
    {
        try {
            $meta = Meta::find($request->id);
            if (!$meta) return response(['message' => MessageException::DB_NOT_FOUND], Response::HTTP_NOT_FOUND);
            $result = DetalleVenta::select(DB::raw('SUM(cantidad) as cantidad'))
                ->where('producto_id', $meta->producto_id)
                ->whereMonth('created_at', $meta->mes)->first();
            return response(['data' => $result, 'message' => MessageResponse::GET_OK]);
        } catch (\Throwable $th) {
            return response(['message' => MessageException::DB_GETDATA, 'error' => $th], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function cantidadProductoByCategoria(Request $request, $categoriaId)
    {
        $cantidad = $request->query('meses')?? 1;
        try {
            $fechaActual = date('Y-m-d H:i:s');
            $fechaMesAnterior = date('Y-m-d H:i:s', strtotime($fechaActual . "-$cantidad month"));
            $result = DB::table('detalle_ventas')
                ->select('productos.nombre',DB::raw("to_char(detalle_ventas.created_at, 'MM') as mes"), DB::raw('sum(detalle_ventas.cantidad) as cantidad'))
                ->join('productos', 'detalle_ventas.producto_id', '=', 'productos.id')
                ->where('productos.categoria_id', $categoriaId)
                ->whereBetween('detalle_ventas.created_at', [$fechaMesAnterior, $fechaActual])
                ->groupBy(['productos.nombre', 'mes'])
                ->get();
            $result = $result->groupBy('nombre');
            $newResult=[];
            foreach ($result as $key => $value) {
                array_push($newResult, ['nombre' => $key, 'cantidad' => round($value->avg('cantidad'))]);
            }
            return response(['data' => $newResult, 'message' => MessageResponse::GET_OK]);
        } catch (\Throwable $th) {
            return response(['message' => MessageException::DB_GETDATA, 'error' => $th], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getStock($id)
    {
        try {
            $producto = Producto::find($id);
            if (!$producto) return response(['message' => MessageException::DB_NOT_FOUND], Response::HTTP_NOT_FOUND);
            return response(['data' => $producto->stock, 'message' => MessageResponse::GET_OK]);
        } catch (\Throwable $th) {
            return response(['message' => MessageException::DB_GETDATA, 'error' => $th], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getTop(Request $request)
    {
        $tipo = $request->tipo == 'mejores'?'desc': 'asc';
        $cantidad = $request->cantidad?? 5;
        try {
            $result = DB::table('detalle_ventas')
                ->select('productos.nombre', DB::raw('sum(detalle_ventas.cantidad) as cantidad'))
                ->join('productos', 'detalle_ventas.producto_id', '=', 'productos.id')
                ->groupBy('productos.nombre')
                ->orderBy('cantidad', $tipo)
                ->limit($cantidad)
                ->get();
            return response(['data' => $result, 'message' => MessageResponse::GET_OK]);
        } catch (\Throwable $th) {
            return response(['message' => MessageException::DB_GETDATA, 'error' => $th], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
