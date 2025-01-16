<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Sector;
use Illuminate\Http\Request;

class AUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $users = User::all();
        $users = User::paginate(10);
        return view('admin.users.users', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sectors = Sector::all();
        return view('admin.users.create',compact('sectors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'sector_id'=>'required|exists:sectors,id_sector',
            'role' => 'required|string|in:admin,user',
        ]);

        $validated['password'] = bcrypt($validated['password']);
        User::create($validated);

        return redirect()->route('users.index')->with('success', 'Utilisateur créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Récupérer l'utilisateur avec ses matériels
        $user = User::with('materials')->findOrFail($id);

        // Retourner la vue avec les données
        return view('admin.users.showmaterials', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) //or User $user
    {
        $user = User::find($id);
        $sectors = Sector::all();
        return view('admin.users.edit', compact('user','sectors'));
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Récupération de l'utilisateur
        $user = User::findOrFail($id);

        // Récupération du sector s'utilisateur
        $sector = Sector::with('users')->findOrFail($id);

        $validated = $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|unique:users', //email,' . $user->id_user,
            'sector_id'=>'required|exists:sectors,id_sector',
            'password' => 'nullable|min:6',
            'role' => 'required|string|in:admin,user',
        ]);

       

        if (!empty($validatedData['password'])) {
            $validated['password'] = bcrypt($request->password);//$validated['password']
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        //or 
        // $users->update([
        //     'firstname'=>$request->name,
        //     'lastname'=>$request->email,
        //     'email'=>$request->password
        // ]);


        return redirect()->route('users.index')->with('success', 'Utilisateur mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user=User::find($id);
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Utilisateur supprimé avec succès.');
    }
}
