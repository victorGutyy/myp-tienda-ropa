<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:1',
            'category' => 'required|string|max:255', // ➡️ Añadir validación de categoría
        ]);
        
        Product::create($request->only(['name', 'price', 'quantity', 'category']));
        

        return redirect()->route('admin.products.index')->with('success', 'Producto creado correctamente.');
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:1',
            'category' => 'required|string|max:255', // ➡️ Añadir validación de categoría
    ]);

    $product->update($request->only(['name', 'price', 'quantity', 'category']));


        return redirect()->route('admin.products.index')->with('success', 'Producto actualizado correctamente.');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Producto eliminado correctamente.');
    }

    public function tenis()
{
    $products = Product::with('variants.color', 'variants.size')
                ->where('category', 'Tenis')
                ->orderBy('id', 'asc') // orden por ID ascendente
                ->get();

    return view('tenis', compact('products'));
}

    public function ropaMasculina()
{
    $products = Product::with('variants.color', 'variants.size')
                ->where('category', 'Ropa Masculina')
                ->orderBy('id')
                ->get();

    return view('ropa_masculina', compact('products'));
}

public function ropaFemenina()
{
    $products = Product::with('variants.color', 'variants.size')
                ->where('category', 'Ropa Femenina')
                ->orderBy('id')
                ->get();

    return view('ropa_femenina', compact('products'));
}




    
}
