<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Models\Role;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateAdminRequest;
use DataTables;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view('backend.admins.list');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('backend.admins.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateAdminRequest $request)
    {
        Admin::create($request->validated());
        return redirect(route('admins.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Admin $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $admin)
    {
        //
    }

    public function getAdminData()
    {
        $admins = Admin::all();

        return DataTables::of($admins)
            ->addColumn('status', function ($category) {
                return $category->status == 1 ? 'Approved' : 'Block';
            })
            ->addColumn('action', 'backend.admins.action_column')
            ->rawColumns(['name', 'email', 'status', 'action'])
            ->make(true);
    }
}
