<!DOCTYPE html>
<html>
<head>
    <title>Step 1 - Data Entry</title>
</head>
<body>

@if (session('success'))
    <div style="position: fixed; top: 20px; right: 20px; background: #d4edda; color: #155724; padding: 10px; border-radius: 5px;">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div style="position: fixed; top: 20px; right: 20px; background: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px;">
        {{ session('error') }}
    </div>
@endif

<h2>Shift Types</h2>
<table border="1">
    <thead>
        <tr>
            <th>Shift Type</th>
            <th>Description</th>
            <th>Rate Day</th>
            <th>Rate Night</th>
            <th>Rate Sat</th>
            <th>Rate Sun</th>
            <th>Rate Public Holiday</th>
        </tr>
    </thead>
    <tbody>
        @foreach($shiftTypes as $shift)
            <tr>
                <td>{{ $shift->shift_type }}</td>
                <td>{{ $shift->description }}</td>
                <td>{{ $shift->rate_day }}</td>
                <td>{{ $shift->rate_night }}</td>
                <td>{{ $shift->rate_sat }}</td>
                <td>{{ $shift->rate_sun }}</td>
                <td>{{ $shift->rate_public_holiday }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<h3>Add New Shift Type</h3>
<!--
<form method="POST" action="{{ route('shift-type.store') }}">
    @csrf
    <input type="text" name="shift_type" placeholder="Shift Type" required>
    <input type="text" name="description" placeholder="Description">
    <input type="number" step="0.01" name="rate_day" placeholder="Rate Day" required>
    <input type="number" step="0.01" name="rate_night" placeholder="Rate Night" required>
    <input type="number" step="0.01" name="rate_sat" placeholder="Rate Sat" required>
    <input type="number" step="0.01" name="rate_sun" placeholder="Rate Sun" required>
    <input type="number" step="0.01" name="rate_public_holiday" placeholder="Rate Public Holiday" required>
    <button type="submit">Add Shift Type</button>
</form>
-->

<form action="{{ isset($editShift) ? route('shift-types.update', $editShift->id) : route('shift-type.store') }}" method="POST">
    @csrf
    @if(isset($editShift)) @method('PUT') @endif

    <input type="text" name="shift_type" value="{{ old('shift_type', $editShift->shift_type ?? '') }}" placeholder="Shift Type">
    <input type="text" name="description" value="{{ old('description', $editShift->description ?? '') }}" placeholder="Description">
    <input type="number" name="rate_day" value="{{ old('rate_day', $editShift->rate_day ?? '') }}" placeholder="Day Rate">
    <input type="number" name="rate_night" value="{{ old('rate_night', $editShift->rate_night ?? '') }}" placeholder="Night Rate">
    <input type="number" name="rate_sat" value="{{ old('rate_sat', $editShift->rate_sat ?? '') }}" placeholder="Saturday Rate">
    <input type="number" name="rate_sun" value="{{ old('rate_sun', $editShift->rate_sun ?? '') }}" placeholder="Sunday Rate">
    <input type="number" name="rate_public_holiday" value="{{ old('rate_public_holiday', $editShift->rate_public_holiday ?? '') }}" placeholder="Holiday Rate">

    <button type="submit">{{ isset($editShift) ? 'Update Shift Type' : 'Add Shift Type' }}</button>
</form>

@foreach($shiftTypes as $shift)
    <tr>
        <td>{{ $shift->shift_type }}</td>
        <td>{{ $shift->description }}</td>
        <td>
            <a href="{{ route('shift-types.edit', $shift->id) }}">Edit</a>

            <form action="{{ route('shift-types.delete', $shift->id) }}" method="POST" style="display:inline;">
                @csrf @method('DELETE')
                <button type="submit" onclick="return confirm('Delete this shift type?')">Delete</button>
            </form>
        </td>
    </tr>
@endforeach


<hr>

<h2>Locations (Read-only)</h2>
<table border="1">
    <thead>
        <tr>
            <th>Location Name</th>
            <th>State</th>
            <th>Province</th>
            <th>City</th>
            <th>Address</th>
        </tr>
    </thead>
    <tbody>
        @foreach($locations as $location)
            <tr>
                <td>{{ $location->location_name }}</td>
                <td>{{ $location->state }}</td>
                <td>{{ $location->province }}</td>
                <td>{{ $location->city }}</td>
                <td>{{ $location->address }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<h3>Add New Location (Popup/Modal can be done later)</h3>
<!--
<form method="POST" action="{{ route('location.store') }}">
    @csrf
    <input type="text" name="location_name" placeholder="Location Name" required>
    <input type="text" name="state" placeholder="State" required>
    <input type="text" name="province" placeholder="Province">
    <input type="text" name="city" placeholder="City" required>
    <input type="text" name="address" placeholder="Address" required>
    <button type="submit">Add Location</button>
</form>

<hr>
<form method="POST" action="{{ route('step1.next') }}">
    @csrf
    <button type="submit">Next</button>
</form>
-->

<form action="{{ isset($editLocation) ? route('locations.update', $editLocation->id) : route('location.store') }}" method="POST">
    @csrf
    @if(isset($editLocation)) @method('PUT') @endif

    <input type="text" name="location_name" value="{{ old('location_name', $editLocation->location_name ?? '') }}" placeholder="Location Name">
    <input type="text" name="state" value="{{ old('state', $editLocation->state ?? '') }}" placeholder="State">
    <input type="text" name="province" value="{{ old('province', $editLocation->province ?? '') }}" placeholder="Province">
    <input type="text" name="city" value="{{ old('city', $editLocation->city ?? '') }}" placeholder="City">
    <input type="text" name="address" value="{{ old('address', $editLocation->address ?? '') }}" placeholder="Address">

    <button type="submit">{{ isset($editLocation) ? 'Update Location' : 'Add Location' }}</button>
</form>

@foreach($locations as $location)
    <tr>
        <td>{{ $location->location_name }}</td>
        <td>{{ $location->state }}</td>
        <td>{{ $location->city }}</td>
        <td>
            <a href="{{ route('locations.edit', $location->id) }}">Edit</a>

            <form action="{{ route('locations.delete', $location->id) }}" method="POST" style="display:inline;">
                @csrf @method('DELETE')
                <button type="submit" onclick="return confirm('Delete this location?')">Delete</button>
            </form>
        </td>
    </tr>
@endforeach

<br><br>
<a href="{{ route('step2') }}">→ Go to Home (Step 2)</a>

</body>
</html>
