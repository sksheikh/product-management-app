<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::with('products')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'status' => 200,
            'data' => $categories
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:categories,name',
            'description' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => 'Validation error',
                'error' => $validator->errors(),
            ], 400);
        }

        $category = new Category();
        $category->name = $request->name;
        $category->description = $request->description;
        $category->save();

        return response()->json([
            'status' => 200,
            'message' => 'Category has been created successfully',
            'data' => $category
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
            'name' => 'required|unique:categories,name,' . $id,
            'description' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => 'Validation error',
                'error' => $validator->errors(),
            ], 400);
        }

        $category = Category::find($id);
        if ($category == null) {
            return response()->json([
                "status" => 404,
                'data' => [],
                'message' => 'Category not found',
            ], 404);
        }


        $category->name = $request->name;
        $category->description = $request->description;
        $category->save();

        return response()->json([
            'status' => 200,
            'message' => 'Category has been updated successfully',
            'data' => $category
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);
        if ($category == null) {
            return response()->json([
                "status" => 404,
                'data' => [],
                'message' => 'Category not found',
            ], 404);
        }

        $category->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Category has been deleted successfully',
        ]);
    }
}
