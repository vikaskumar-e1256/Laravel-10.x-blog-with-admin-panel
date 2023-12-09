<?php

namespace App\Http\Controllers\Backend\Category;

use DataTables;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryStoreRequest;

class CategoryController extends Controller
{

    public function index()
    {
        return view('backend.categories.list');
    }

    public function create()
    {
        return view('backend.categories.create');
    }

    public function store(CategoryStoreRequest $request)
    {
        // Create a new category
        $category = new Category;
        $category->fill($request->only(['name', 'slug']));
        $category->status = $request->input('status', false);
        // Save the category
        $category->save();

        // Return a success response
        return response()->json(['message' => 'Category created successfully'], 200);
    }


    // -------------------------------------------------------------------------
    // Private and Protected Functions
    // -------------------------------------------------------------------------

    public function getCategoryData()
    {
        $categories = Category::with('image');

        return DataTables::of($categories)
            ->addColumn('image', function ($category) {
                return view('backend.categories.image_column', ['category' => $category])->render();
            })
            ->addColumn('status', function ($category) {
                return $category->status == 1 ? 'Approved' : 'Block';
            })
            ->addColumn('action', 'backend.categories.action_column')
            ->rawColumns(['title', 'slug', 'status', 'action'])
            ->make(true);
    }
}
