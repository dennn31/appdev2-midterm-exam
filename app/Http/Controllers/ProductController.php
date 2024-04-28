<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return response()->json(['message' => 'Display all products']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $product = Product::create($request->all());
        return response()->json(['message' => 'Product Created Succesfully']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::findOrFail($id);
        return response()->json(['message' => 'Display product with ID:' . $id ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id); $product->update($request->all());
        return response()->json(['message' => 'Product with ID:' . $id . 'updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id); $product->delete();
        return response()->json(['message' => 'Product with ID:' . $id . 'deleted successfully']);
    }

    public function uploadImageLocal(Request $request)
    {
        if ($request->hasFile('image')) { 
            Storage::disk('local')->put('/', $request->file('image'));
                return "Image successfully stored in local disk driver";
        }
        return "No image uploaded.";
    }

    public function uploadImagePublic(Request $request)
    {
        if ($request->hasFile('image')) { 
            Storage::disk('public')->put('/', $request->file('image'));
                return "Image successfully stored in public disk driver";
        }
        return "No image uploaded.";
    }

}
