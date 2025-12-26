<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use Illuminate\Http\Request;

class EquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $equipment = Equipment::latest()->paginate(10);
        return view('equipment.index', compact('equipment'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('equipment.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'model' => 'nullable|string|max:255',
            'serial_number' => 'nullable|string|unique:equipment',
            'category' => 'required|string|max:255',
            'status' => 'required|in:operational,in_repair,maintenance,retired',
            'purchase_date' => 'nullable|date',
            'last_maintenance_date' => 'nullable|date',
            'description' => 'nullable|string',
        ]);

        Equipment::create($validated);

        return redirect()->route('equipment.index')->with('success', 'Equipment added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Equipment $equipment)
    {
        return view('equipment.show', compact('equipment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Equipment $equipment)
    {
        return view('equipment.edit', compact('equipment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Equipment $equipment)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'model' => 'nullable|string|max:255',
            'serial_number' => 'nullable|string|unique:equipment,serial_number,' . $equipment->id,
            'category' => 'required|string|max:255',
            'status' => 'required|in:operational,in_repair,maintenance,retired',
            'purchase_date' => 'nullable|date',
            'last_maintenance_date' => 'nullable|date',
            'description' => 'nullable|string',
        ]);

        $equipment->update($validated);

        return redirect()->route('equipment.show', $equipment)->with('success', 'Equipment updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Equipment $equipment)
    {
        $equipment->delete();
        return redirect()->route('equipment.index')->with('success', 'Equipment deleted successfully!');
    }
}
