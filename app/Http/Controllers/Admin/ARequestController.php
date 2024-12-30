<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Request;
use App\Models\User;
use App\Models\Material;
use Illuminate\Http\Request as HttpRequest;

class ARequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $requests = Request::with(['user', 'material'])->get();
        $requests = Request::paginate(5);
        return view('admin.requests.requests', compact('requests'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        $materials = Material::all();
        return view('admin.requests.create', compact('users', 'materials'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(HttpRequest $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id_user',
            'material_id' => 'required|exists:materials,id_material',
            'status' => 'required|in:en attente,accepté,refusé',
        ]);

        Request::create($validated);

        return redirect()->route('requests.index')->with('success', 'Request created successfully.');
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
