<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Material;
use App\Models\Type;
use App\Models\Brand;
use App\Models\User;

class AMaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $materials = Material::with(['type', 'brand', 'user'])->get(); // Eager loading related models
        $materials=Material::paginate(10);
        return view('admin.materials.equipements', compact('materials'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Type::all();
        $brands = Brand::all();
        $users = User::all();
        return view('admin.materials.create', compact('types', 'brands' , 'users'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData=$request->validate([
            'type_id' => 'required|exists:types,id_type',
            'brand_id' => 'required|exists:brands,id_brand',
            'name' => 'required|string|max:255',
            'status' => 'required|in:libre,occupé,en maintenance,réparé',
            'user_id' => 'required|exists:users,id_user',
        ]);

        Material::create($validatedData);//$request->all()
        

        return redirect()->route('materials.index')->with('success', 'Material added successfully!');

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
        $material = Material::findOrFail($id);
        $types = Type::all();
        $brands = Brand::all();
        $users = User::all();
        return view('admin.materials.edit', compact('material', 'types', 'brands','users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $material = Material::findOrFail($id);

        $validatedData=$request->validate([
            'type_id' => 'required|exists:types,id_type',
            'brand_id' => 'required|exists:brands,id_brand',
            'name' => 'required|string|max:255',
            'status' => 'required|in:libre,occupé,en maintenance,réparé',
            'user_id' =>'required|exists:users,id_user',
        ]);

        $material->update($validatedData);//$request->all()

        return redirect()->route('materials.index')->with('success', 'Material updated successfully!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $material = Material::findOrFail($id);
        $material->delete();

        return redirect()->route('materials.index')->with('success', 'Material deleted successfully!');

    }
}
