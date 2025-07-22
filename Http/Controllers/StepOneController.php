<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ShiftType;
use App\Models\Location;

class StepOneController extends Controller
{
    public function index()
    {
        $shiftTypes = ShiftType::all();
        $locations = Location::all();
        if ($shiftTypes->count() == 0 || $locations->count() == 0) {
            session()->flash('error', 'Please add at least one shift type and one location.');
        }
        return view('step1', compact('shiftTypes', 'locations'));
    }

    public function storeShiftType(Request $request)
    {
        $exists = ShiftType::where('shift_type', $request->shift_type)->exists();
        if ($exists) {
            return redirect()->back()->with('error', 'Shift type already exists.');
        }
        $data = $request->validate([
            'shift_type' => 'required|string',
            'description' => 'nullable|string',
            'rate_day' => 'required|numeric',
            'rate_night' => 'required|numeric',
            'rate_sat' => 'required|numeric',
            'rate_sun' => 'required|numeric',
            'rate_public_holiday' => 'required|numeric',
        ]);
        ShiftType::create($data);

        return redirect()->back()->with('success', 'Shift type added');
    }

    public function storeLocation(Request $request)
    {
        $exists = Location::where('location_name', $request->location_name)
            ->where('city', $request->city)
            ->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'Location already exists.');
        }
        $data = $request->validate([
            'location_name' => 'required|string',
            'state' => 'required|string',
            'province' => 'nullable|string',
            'city' => 'required|string',
            'address' => 'required|string',
        ]);
        Location::create($data);

        return redirect()->back()->with('success', 'Location added');
    }
    // ===== SHIFT-TYPE =====
    public function next()
    {
        $shiftTypes = ShiftType::all();
        $locations = Location::all();

        if ($shiftTypes->count() == 0 || $locations->count() == 0) {
            return back()->with('error', 'Please add at least one shift type and one location.');
        }

        return redirect()->route('step2');
    }

    public function deleteShiftType($id)
    {
        $shiftType = ShiftType::findOrFail($id);
        $shiftType->delete();
        return back()->with('success', 'Shift Type deleted.');
    }

    public function editShiftType($id)
    {
        $shiftTypes = ShiftType::all();
        $locations = Location::all();
        $editShift = ShiftType::findOrFail($id);
        return view('step1', compact('shiftTypes', 'locations', 'editShift'));
    }

    public function updateShiftType(Request $request, $id)
    {
        $data = $request->validate([
            'shift_type' => 'required|string',
            'description' => 'nullable|string',
            'rate_day' => 'required|numeric',
            'rate_night' => 'required|numeric',
            'rate_sat' => 'required|numeric',
            'rate_sun' => 'required|numeric',
            'rate_public_holiday' => 'required|numeric',
        ]);
        ShiftType::findOrFail($id)->update($data);
        return redirect()->route('step1')->with('success', 'Shift Type updated.');
    }


    // ===== LOCATION =====

    public function deleteLocation($id)
    {
        $location = Location::findOrFail($id);
        $location->delete();
        return back()->with('success', 'Location deleted.');
    }

    public function editLocation($id)
    {
        $shiftTypes = ShiftType::all();
        $locations = Location::all();
        $editLocation = Location::findOrFail($id);
        return view('step1', compact('shiftTypes', 'locations', 'editLocation'));
    }

    public function updateLocation(Request $request, $id)
    {
        $data = $request->validate([
            'location_name' => 'required|string',
            'state' => 'required|string',
            'province' => 'nullable|string',
            'city' => 'required|string',
            'address' => 'required|string',
        ]);
        Location::findOrFail($id)->update($data);
        return redirect()->route('step1')->with('success', 'Location updated.');
    }


}

