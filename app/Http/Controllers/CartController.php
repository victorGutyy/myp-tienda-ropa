<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\ProductVariant;


class CartController extends Controller
{
    public function index()
    {
        $cart = Session::get('cart', []);
        return view('cart.index', compact('cart'));
    }

    public function add(Request $request)
{
    $request->validate([
        'product_id' => 'required|exists:products,id',
        'size_id' => 'required|exists:sizes,id',
        'color_id' => 'required|exists:colors,id',
    ]);

    // Buscar la variante exacta
    $variant = ProductVariant::where('product_id', $request->product_id)
        ->where('size_id', $request->size_id)
        ->where('color_id', $request->color_id)
        ->first();

    if (!$variant) {
        return back()->withErrors(['error' => 'No se encontró una combinación válida de talla y color.']);
    }

    $iva = $variant->price * 0.19;
    $priceWithIva = $variant->price + $iva;

    $cart = Session::get('cart', []);
    $cart[] = [
        'product' => $variant->product->name,
        'price' => $priceWithIva,
        'iva' => $iva,
        'base_price' => $variant->price,
        'size' => $variant->size->label,
        'color' => $variant->color->name
    ];

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

    public function checkout()
{
    $cart = Session::get('cart', []);
    $total = array_sum(array_column($cart, 'price'));

    return view('cart.checkout', compact('cart', 'total'));
}

}
