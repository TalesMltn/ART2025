<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index()
    {
        // Muestra la vista de categorías de productos
        return view('productos.index');
    }

    public function mostrarPorCategoria($slug)
    {
        // Aquí luego mostrarás los productos por categoría
        return view('productos.categoria', compact('slug'));
    }
}
