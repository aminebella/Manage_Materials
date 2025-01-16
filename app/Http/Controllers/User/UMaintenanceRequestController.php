<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Maintenance;
use App\Models\User;
use App\Models\Material;

class UMaintenanceRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $maintenances = Maintenance::with(['user', 'material'])->get();
        $maintenances = Maintenance::paginate(5);
        return view('user.MyMaintenances.Mymaintenances', compact('maintenances'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        $materials = Material::all();
        return view('admin.maintenances.create', compact('users', 'materials'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id_user',
            'material_id' => 'required|exists:materials,id_material',
            'status' => 'required|in:en cours,terminé',
        ]);

        Maintenance::create($validated);

        return redirect()->route('maintenances.index')->with('success', 'Maintenance created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $maintenance = Maintenance::findOrFail($id);
        $users = User::all();
        $materials = Material::all();
        return view('admin.maintenances.edit', compact('maintenance', 'users', 'materials'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id_user',
            'material_id' => 'required|exists:materials,id_material',
            'status' => 'required|in:en cours,terminé',
        ]);

        $maintenance = Maintenance::findOrFail($id);
        $maintenance->update($validated);

        return redirect()->route('maintenances.index')->with('success', 'Maintenance updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $maintenance = Maintenance::findOrFail($id);
        $maintenance->delete();

        return redirect()->route('maintenances.index')->with('success', 'Maintenance deleted successfully.');
    }
}
