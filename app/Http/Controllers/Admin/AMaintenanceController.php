<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Maintenance;
use App\Models\User;
use App\Models\Material;

class AMaintenanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $Allmaintenances= Maintenance::with(['user', 'material'])->get();
        $maintenances = Maintenance::with(['user', 'material'])->paginate(5);
        $search=$request->input('search');
        if($search){
            $maintenances = Maintenance::with(['user', 'material'])->whereRelation('material', 'name', 'like', '%' . $search . '%')->paginate(5);
        }

        $filter=$request->input('filter');
        $order=$request->input('order');
        
        if($filter && $order){
            if($filter==="created_at" || $filter==="updated_at"){
                $maintenances=Maintenance::with(['user', 'material'])->orderBy($filter,$order)->paginate(5);
            }elseif($filter==="status"){
                $maintenances=Maintenance::with(['user', 'material'])->where($filter, $order)->paginate(5);
            }
        }
        return view('admin.maintenances.maintenance', compact('maintenances','Allmaintenances'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $users = User::all();
        $users = User::where('id_user',"!=",1)->get();
        // $materials = Material::all();
        $materials = Material::where('id_material',"!=",1)->get();
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
            // 'status' => 'required|in:en cours,terminé',
        ]);
        // Maintenance::create($validated);
        Maintenance::create([
            'user_id' => $request->input('user_id'),
            'material_id' => $request->input('material_id'),
            'status' => 'en cours',
        ]);

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

    public function finish($Mid){//Request $request
        $maintenance=Maintenance::findOrFail($Mid);

        $maintenance->update([
            'status' => "terminé",
            'updated_at'=> now(),
        ]);

        return redirect()->route('maintenances.index')->with('success','the material has finished the maintenance');
    }
}
