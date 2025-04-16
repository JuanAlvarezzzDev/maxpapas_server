<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductoCollection;
use App\Models\Categoria;
use App\Models\Empaque;
use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $catAdiciones = 7;
        $catSalsas = 8;
        $catPapas = 10;
        $catSalsasAlas = 11;
        // Obtener los IDs de las categorías que deseas excluir (7 y 8)
        $categoriasExcluidas = [$catAdiciones, $catSalsas, $catPapas, $catSalsasAlas];

        $productos = Producto::where('disponible', 1)
            ->whereNotIn('categoria_id', $categoriasExcluidas)
            ->orderBy('id', 'ASC')
            ->get();

        return new ProductoCollection($productos);
    }

    public function productosPorCategoria($categoriaId)
    {
        // Recuperar solo los productos de la categoría especificada
        $productos = Producto::where('disponible', 1)
            ->where('categoria_id', $categoriaId)
            ->orderBy('id', 'DESC')
            ->get();

        return new ProductoCollection($productos);
    }

    public function DetalleProducto($productoId)
    {
        $armaCombo = 1;
        $catAdiciones = 7;
        $catSalsas = 8;
        $catPapas = 10;
        $catBebidas = 9;
        $catSalsasAlas = 11;


        $Producto = Producto::where('disponible', 1)
            ->where('id', $productoId)
            ->first();
           $categoriasIncluidas = [];
        if ($Producto->id == $armaCombo) {
            $categoriasIncluidas = [$catAdiciones, $catSalsas, $catBebidas];
        } elseif ($Producto->necesita_papas == false) {
            $categoriasIncluidas = [$catSalsas, $catBebidas, $catAdiciones];
        } elseif ($Producto->necesita_alas) {
            $categoriasIncluidas = [$catPapas, $catSalsasAlas, $catSalsas, $catBebidas, $catAdiciones];
        } else {
            $categoriasIncluidas = [$catPapas, $catSalsas, $catBebidas, $catAdiciones];
        }
       
        $categorias = [];
        foreach ($categoriasIncluidas as $categoriaId) {
            $productosQuery = Producto::where('disponible', 1)
                ->where('categoria_id', $categoriaId)
                ->orderBy('id', 'ASC');

            if ($Producto->mixto) {
            } else {
                $productosQuery->whereNotIn('id', [69]);  /* Papa MIXTA */
            }

            $productos = $productosQuery->get();

            $categoria = [
                'id' => $categoriaId,
                'imagen' => Categoria::findOrFail($categoriaId)->imagen,
                'nombre' => Categoria::findOrFail($categoriaId)->nombre,
                'productos' => $productos
            ];

            $categorias[] = $categoria;
        }

        $empaque = Empaque::find($Producto->empaque_id);
        $empaquePrecio = $empaque->precio;

        return response()->json(['producto' => $Producto, 'Empaque' => $empaquePrecio, 'options' => $categorias]);
    }

    public function empaque()
    {
        return $this->belongsTo(Empaque::class, 'empaque_id');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function show(Producto $producto)
    {
        return $producto;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Producto $producto)
    {
        //
        $producto->disponible = 0;
        $producto->save();
        return [
            'producto' => $producto
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Producto $producto)
    {
        //
    }
}
