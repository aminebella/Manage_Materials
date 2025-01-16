<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Auth;

use App\Models\Request;
use App\Models\User;
use App\Models\Material;


class UMaterialRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $requests = Request::with(['user', 'material'])->get();
        // $requests = Request::paginate(5);
        $requests = Auth::user()->requests;
        return view('user.MyRequests.Myrequests', compact('requests'));
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     $users = User::all();
    //     $materials = Material::all();
    //     return view('admin.requests.create', compact('users', 'materials'));
    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(HttpRequest $request)
    {
        $validated = $request->validate([
            'material_id' => 'required|exists:materials,id_material',
        ]);

        // Créer une demande
        Request::create([
            'user_id' => Auth::id(),
            'material_id' => $validated['material_id'],
            'status' => 'en attente',
        ]);

        return redirect()->route('user.dashboard')->with('success', 'Demande envoyée.');

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
        $request = Request::findOrFail($id);
        $users = User::all();
        $materials = Material::all();
        return view('admin.requests.edit', compact('request', 'users', 'materials'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(HttpRequest $request, string $id)
    {
        $requestModel = Request::findOrFail($id);
        
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id_user',
            'material_id' => 'required|exists:materials,id_material',
            'status' => 'required|in:en attente,accepté,refusé',
        ]);

        $requestModel->update($validated);

        return redirect()->route('requests.index')->with('success', 'Request updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $request = Request::findOrFail($id);
        $request->delete();

        return redirect()->route('requests.index')->with('success', 'Request deleted successfully.');
    }
}
