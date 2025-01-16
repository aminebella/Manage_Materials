<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Material;
use App\Models\Type;
use App\Models\Brand;
use App\Models\User;

class UMyMaterialController extends Controller
{
    public function index()
    {
        // $materials = Material::with(['type', 'brand', 'user'])->get(); // Eager loading related models
        // $materials=Material::paginate(10); blasphemoua 1
        $materials = Auth::user()->materials;
        return view('user.MyMaterials.Myequipements', compact('materials'));
    }
   
}
