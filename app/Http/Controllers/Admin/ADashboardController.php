<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Material;
use App\Models\Request as MaterialRequest;
use App\Models\Maintenance;

class ADashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $totalUsers = User::count();
        $totalMaterials = Material::count();
        $freeMaterials = Material::where('status','libre'); 
        $pendingRequests = MaterialRequest::where('status', 'en attente')->count();
        $ongoingMaintenances = Maintenance::where('status', 'en cours')->count();

        return view('admin.dashboard.dashboard', compact('totalUsers', 'totalMaterials', 'pendingRequests', 'ongoingMaintenances', 'freeMaterials'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
