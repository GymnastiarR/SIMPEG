<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use App\Http\Requests\StoreDepartementRequest;
use App\Http\Requests\UpdateDepartementRequest;
use App\Models\User;

class DepartementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $departements = Departement::with('firstApprover', 'secondApprover')->get();
        $approvers = User::where('role', 'approver')->orderBy('name')->get();

        return view('departement', [
            'departements' => $departements,
            'approvers' => $approvers,
        ]);
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
    public function store(StoreDepartementRequest $request)
    {
        Departement::create($request->validated());

        return redirect()->route('departement.index')->with('success', 'Departement created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Departement $departement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Departement $departement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDepartementRequest $request, Departement $departement)
    {
        $departement->update($request->validated());

        return redirect()->back()->with('success', 'Departement updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Departement $departement)
    {
        //
    }
}
