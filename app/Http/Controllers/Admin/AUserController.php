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
    public function index(Request $request)
    {
        $Allusers=User::all();
        $users = User::paginate(10);

        $search=$request->input("search");
        if($search){
            $users=User::where("firstname","like",'%'.$search.'%')->orwhere("lastname",'like','%'.$search.'%')->orWhereRaw("CONCAT(firstname, ' ', lastname) LIKE ?", ['%' . $search . '%'])->paginate(10);
        }

        $filter=$request->input("filter");
        if($filter){
            $users=User::where("role",$filter)->paginate(10);
        }
        return view('admin.users.users', compact('users','Allusers'));
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

        return redirect()->route('users.index')->with('success', 'User has been created successfully.');
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
        $user = User::findOrFail($id);
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
        // $sector = Sector::with('users')->findOrFail($id);

        $validated = $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id_user . ',id_user',
            'sector_id'=>'required|exists:sectors,id_sector',
            'password' => 'nullable|min:6',
            'role' => 'required|string|in:admin,user',
        ]);

        if (!empty($request->input('password'))) {
            $validated['password'] = bcrypt($request->input('password'));
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        //or 
        // $users->update([
        //     'firstname'=>$request->firstname,
        //     'lastname'=>$request->lastname,
        //     'email'=>$request->email
        // ]);
        return redirect()->route('users.index')->with('success', 'User Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user=User::find($id);
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User has been deleted succesfully.');
    }
}
