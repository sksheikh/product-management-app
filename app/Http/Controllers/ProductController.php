<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $poducts = Product::with('category')
            ->orderBy('created_at', 'desc')->get();

        return response()->json([
            'status' => 200,
            'data' => $poducts
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:products,name',
            'description' => 'required',
            'price' => 'required|numeric',
            'category' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => 'Validation error',
                'error' => $validator->errors(),
            ], 400);
        }

        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->category_id = $request->category;
        $product->save();

        return response()->json([
            'status' => 200,
            'message' => 'Product has been created successfully',
            'data' => $product
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:products,name,' . $id,
            'description' => 'required',
            'price' => 'required|numeric',
            'category' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => 'Validation error',
                'error' => $validator->errors(),
            ], 400);
        }

        $product = Product::find($id);
        if ($product == null) {
            return response()->json([
                "status" => 404,
                'data' => [],
                'message' => 'Product not found',
            ], 404);
        }
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->category_id = $request->category;
        $product->save();

        return response()->json([
            'status' => 200,
            'message' => 'Product has been updated successfully',
            'data' => $product
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);
        if ($product == null) {
            return response()->json([
                "status" => 404,
                'data' => [],
                'message' => 'Product not found',
            ], 404);
        }

        $product->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Product has been deleted successfully',
        ]);
    }
}
