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
        $this->authorize('create', Category::class);
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
        $categories = Category::all();

        return DataTables::of($categories)
            ->addColumn('status', function ($category) {
                return $category->status == 1 ? 'Approved' : 'Block';
            })
            ->addColumn('action', function ($category) {
                return view('backend.categories.action_column', ['category' => $category])->render();
            })
            ->rawColumns(['name', 'slug', 'status', 'action'])
            ->make(true);
    }
}
