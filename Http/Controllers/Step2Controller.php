<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShiftType;
use App\Models\Location;


class Step2Controller extends Controller
{

    public function index()
    {
        $shiftTypes = ShiftType::all();
        $locations = Location::all();

        return view('step2', compact('shiftTypes', 'locations'));
    }

    public function destroyShiftType($id)
    {
        ShiftType::destroy($id);
        return redirect()->route('step2')->with('success', 'Shift type deleted successfully.');
    }

    public function destroyLocation($id)
    {
        Location::destroy($id);
        return redirect()->route('step2')->with('success', 'Location deleted successfully.');
    }

}
