<?php

namespace App\Http\Controllers\Backend\Tag;

use DataTables;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TagStoreRequest;

class TagController extends Controller
{
    public function index()
    {
        return view('backend.tags.list');
    }

    public function create()
    {
        $this->authorize('create', Tag::class);
        return view('backend.tags.create');
    }

    public function store(TagStoreRequest $request)
    {
        // Create a new category
        $tag = new Tag;
        $tag->fill($request->only(['name', 'slug']));
        $tag->status = $request->input('status', false);
        // Save the tag
        $tag->save();

        // Return a success response
        return response()->json(['message' => 'Tag created successfully'], 200);
    }


    // -------------------------------------------------------------------------
    // Private and Protected Functions
    // -------------------------------------------------------------------------

    public function getTagData()
    {
        $tags = Tag::all();

        return DataTables::of($tags)
            ->addColumn('status', function ($tag) {
                return $tag->status == 1 ? 'Approved' : 'Block';
            })
            ->addColumn('action', function ($tag) {
                return view('backend.tags.action_column', ['tag' => $tag])->render();
            })
            ->rawColumns(['name', 'slug', 'status', 'action'])
            ->make(true);
    }
}
