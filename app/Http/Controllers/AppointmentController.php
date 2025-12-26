<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Equipment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $appointments = Appointment::with('equipment', 'user')
            ->latest('scheduled_date')
            ->paginate(10);
        return view('appointments.index', compact('appointments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $equipment = Equipment::where('status', '!=', 'retired')->get();
        return view('appointments.create', compact('equipment'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'equipment_id' => 'required|exists:equipment,id',
            'scheduled_date' => 'required|date_format:Y-m-d\TH:i|after:now',
            'description' => 'nullable|string',
            'status' => 'required|in:scheduled,in_progress,completed,cancelled',
        ]);

        $validated['user_id'] = auth()->id();

        Appointment::create($validated);

        return redirect()->route('appointments.index')->with('success', 'Appointment scheduled successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Appointment $appointment)
    {
        return view('appointments.show', compact('appointment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Appointment $appointment)
    {
        $this->authorize('update', $appointment);
        $equipment = Equipment::where('status', '!=', 'retired')->get();
        return view('appointments.edit', compact('appointment', 'equipment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Appointment $appointment)
    {
        $this->authorize('update', $appointment);

        $validated = $request->validate([
            'equipment_id' => 'required|exists:equipment,id',
            'scheduled_date' => 'required|date_format:Y-m-d\TH:i',
            'description' => 'nullable|string',
            'status' => 'required|in:scheduled,in_progress,completed,cancelled',
            'notes' => 'nullable|string',
        ]);

        $appointment->update($validated);

        return redirect()->route('appointments.show', $appointment)->with('success', 'Appointment updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointment)
    {
        $this->authorize('delete', $appointment);
        $appointment->delete();
        return redirect()->route('appointments.index')->with('success', 'Appointment deleted successfully!');
    }
}
