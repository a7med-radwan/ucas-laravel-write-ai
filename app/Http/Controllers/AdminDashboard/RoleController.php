<?php

namespace App\Http\Controllers\AdminDashboard;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::withCount('users')->get();

        return view('admin.roles.index', [
            'roles' => $roles,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.roles.create', [
            'role' => new Role(),
            'abilities' => config('abilities'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:roles,name',
            'abilities' => 'nullable|array',
            'abilities.*' => 'string',
        ]);

        Role::create([
            'name' => $data['name'],
            'abilities' => $data['abilities'] ?? [],
        ]);

        return redirect()
            ->route('admin.roles.index')
            ->with('status', 'Role created successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        return view('admin.roles.edit', [
            'role' => $role,
            'abilities' => config('abilities'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $role->id,
            'abilities' => 'nullable|array',
            'abilities.*' => 'string',
        ]);

        $role->update([
            'name' => $data['name'],
            'abilities' => $data['abilities'] ?? [],
        ]);

        return redirect()
            ->route('admin.roles.index')
            ->with('status', 'Role updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();

        return redirect()
            ->route('admin.roles.index')
            ->with('status', 'Role deleted successfully!');
    }
}
