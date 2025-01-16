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
    public function index(Request $request)
    {
        $AllTypes=Type::all();
        $AllMaterials= Material::with(['type', 'brand', 'user'])->get();
        $materials = Material::with(['type', 'brand', 'user'])->paginate(10); // Eager loading related models

        $search=$request->input("search");
        if($search){
            $materials=Material::with(['type', 'brand', 'user'])->where("name","like","%".$search."%")->paginate(10);
        }

        $AllTypes = Type::all();
        $AllBrands = Brand::all();

        $filter = $request->input("filter");
        $order = $request->input('order');
        if($filter && $order){
            $validFilters = ['type_id', 'brand_id', 'status'];
            if(in_array($filter,$validFilters)){
                $materials=Material::with(['type', 'brand', 'user'])->where($filter,$order)->paginate(10);
            }
        }
        // else if($filter){
        //     return view('admin.materials.equipements', compact('filter'));
        // }
        
        return view('admin.materials.equipements', compact('materials','AllMaterials','AllTypes', 'AllBrands', 'filter'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Type::all();
        $brands = Brand::all();
        $users = User::where('id_user', '!=', 1)->get();
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
            'name' => 'required|string|min:2|max:255',
            'user_id' => 'nullable|exists:users,id_user',
        ]);

        // Déterminer le statut du matériel en fonction de la sélection de l'utilisateur
        $status = $request->input('user_id') ? 'occupé' : 'libre';

        // Assurez-vous de définir un user_id par défaut s'il n'est pas sélectionné
        $userId = $request->input('user_id') ?? 1; // 1 correspond à l'utilisateur fictif (libre)

        // Material::create($validatedData);
        Material::create([
            'type_id' =>$request->input('type_id'),
            'brand_id' => $request->input('type_id'),
            'name' => $request->input('name'),
            'status' => $status,
            'user_id' => $userId,
        ]);

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
        $users = User::where('id_user', '!=', 1)->get();//$users = User::all();
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

        // Déterminer le statut du matériel en fonction de la sélection de l'utilisateur
        $status = $request->input('user_id')==1 ? 'libre': 'occupé';

        // Assurez-vous de définir un user_id par défaut s'il n'est pas sélectionné
        // $userId = $request->input('user_id') ?? 1; // 1 correspond à l'utilisateur fictif (libre)

        // Material::create($validatedData);
        $material->update([
            'type_id' =>$request->input('type_id'),
            'brand_id' => $request->input('type_id'),
            'name' => $request->input('name'),
            'status' => $status,
            'user_id' => $request->input('user_id'),
        ]);
        // $material->update($validatedData);//$request->all()
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
