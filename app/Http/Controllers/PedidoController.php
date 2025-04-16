<?php

namespace App\Http\Controllers;

use App\Http\Resources\PedidoCollection;
use App\Models\OrdenProducto;
use App\Models\Pedido;
use App\Models\PedidoProducto;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Obtén los parámetros de fecha
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Si no se proporciona startDate o endDate, usa la fecha actual por defecto
        if (!$startDate) {
            $startDate = now()->startOfDay()->format('Y-m-d'); // Inicio del día actual
        }
        if (!$endDate) {
            $endDate = now()->endOfDay()->format('Y-m-d'); // Fin del día actual
        }
        // Construye la consulta base
        $query = Pedido::with('user', 'metodoPago', 'state')
            ->whereNotIn('state_pedido_id', [1])
            ->whereBetween('created_at', [
                $startDate . ' 00:00:00',
                $endDate . ' 23:59:59'
            ])
            ->with('productos');

        // Calcula el total de los pedidos filtrados
        $total = $query->sum('total');

        // Ordena por fecha de creación descendente
        $query->orderBy('created_at', 'desc');

        // Devuelve los resultados paginados
        return response()->json([
            'data' => $query->paginate(10),
            'total' => $total,
        ]);
    }



    public function pedidosPorEstado($estado)
    {
        // Obtener los pedidos con el estado proporcionado
        return new PedidoCollection(Pedido::with('user', 'metodoPago', 'state')->with('productos')->where('state_pedido_id', $estado)->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // Almacenar una orden
        $pedido = new Pedido;
        $pedido->user_id = Auth::user()->id;
        $pedido->total = $request->total;
        $pedido->cliente = $request->cliente;
        $pedido->save();

        // Obtener el ID del pedido
        $id = $pedido->id;

        // Obtener los productos
        $productos = $request->productos;

        //Obtener nombre de cliente
        // Formatear un arreglo 
        $pedido_producto = [];

        foreach ($productos as $producto) {
            $pedido_producto[] = [
                'pedido_id' => $id,
                'producto_id' => $producto['idCombo'],
                'cantidad' => $producto['cantidad'],
                'envio' => $producto['envio'],
                'comentario' => $producto['comentario'],
                'detalle' => json_encode($producto['detalle']), // Almacenar el detalle como JSON
                'totalCombo' => $producto['totalCombo'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }

        // Almacenar en la BD
        PedidoProducto::insert($pedido_producto);

        return [
            'message' => 'Pedido realizado correctamente, estará listo en unos minutos'
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function show(Pedido $pedido)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pedido $pedido) {}

    public function updatePay(Request $request, Pedido $pedido)
    {
        $deliveredStatus = 2;
        try {
            // Validar la solicitud
            $validated = $request->validate([
                'metodo_pago' => 'required|integer'
            ]);

            // Actualizar el campo 'metodo_pago' con el valor recibido
            $pedido->metodo_pago = $validated['metodo_pago'];

            $pedido->state_pedido_id = $deliveredStatus;
            $pedido->save();


            // Devolver una respuesta JSON con un mensaje de éxito
            return response()->json([
                'message' => '¡Pago realizado con éxito!',
                'pedido' => $pedido
            ], 200);
        } catch (\Exception $e) {
            // Capturar y manejar cualquier excepción
            return response()->json([
                'message' => 'Error al pagar Pedido',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pedido $pedido)
    {
        //
    }
}
