<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index()
    {
        $cart = Session::get('cart', []);
        return view('cart.index', compact('cart'));
    }

    public function add(Request $request)
    {
        $product = $request->input('product');
        $price = $request->input('price');

        $cart = Session::get('cart', []);
        $cart[] = ['product' => $product, 'price' => $price];

        Session::put('cart', $cart);

        return back()->with('success', 'Producto añadido al carrito.');
    }

    public function remove(Request $request)
    {
        $index = $request->input('index');

        $cart = Session::get('cart', []);
        unset($cart[$index]);
        Session::put('cart', array_values($cart)); // Reindexar

        return back()->with('success', 'Producto eliminado del carrito.');
    }
}
