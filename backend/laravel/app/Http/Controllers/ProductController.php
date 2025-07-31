<?php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['parent', 'children']);
        if ($request->has('product_type')) {
            $query->where('product_type', $request->product_type);
        }
        if ($request->has('product_name')) {
            $query->where('product_name', 'like', '%' . $request->product_name . '%');
        }
        return response()->json($query->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_name' => 'required|string|max:255',
            'product_type' => 'required|string|max:255',
            'product_parent_id' => 'nullable|exists:products,product_id',
        ]);
        $product = Product::create($validated);
        return response()->json($product, 201);
    }

    public function show($id)
    {
        $product = Product::with(['parent', 'children'])->findOrFail($id);
        return response()->json($product);
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $validated = $request->validate([
            'product_name' => 'required|string|max:255',
            'product_type' => 'required|string|max:255',
            'product_parent_id' => 'nullable|exists:products,product_id',
        ]);
        $product->update($validated);
        return response()->json($product);
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return response()->json(null, 204);
    }
}