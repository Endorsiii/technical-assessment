<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Product::query();
        if ($request->has('product_name')) {
            $query->where('product_name', 'like', '%' . $request->input('product_name') . '%');
        }
        if ($request->has('product_type')) {
            $query->where('product_type', 'like', '%' . $request->input('product_type') . '%');
        }
        $products = $query->with(['parent', 'children'])->get();
        return response()->json($products);
    }

    public function store(Request $request): JsonResponse
    {
        $product = Product::create($request->only(['product_name', 'product_type', 'product_parent_id']));
        return response()->json($product);
    }

    public function show($id): JsonResponse
    {
        $product = Product::with(['parent', 'children'])->findOrFail($id);
        return response()->json($product);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $product = Product::findOrFail($id);
        $product->update($request->only(['product_name', 'product_type', 'product_parent_id']));
        return response()->json($product);
    }

    public function destroy($id): JsonResponse
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return response()->json(['message' => 'Deleted']);
    }
}