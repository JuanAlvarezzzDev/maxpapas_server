<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoriaCollection;
use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index()
    {
        $catAdiciones = 7;
        $catSalsas = 8;
        $catPapas = 10;
        $catAlas = 11;
        $categoriasExcluidas = [$catAdiciones, $catSalsas, $catPapas, $catAlas];
        $categorias = Categoria::whereNotIn('id', $categoriasExcluidas)->get();
        return new CategoriaCollection($categorias);
    }
}
