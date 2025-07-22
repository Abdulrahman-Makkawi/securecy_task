<!DOCTYPE html>
<html>
<head>
    <title>Step 2 - Home</title>
</head>
<body>
    <h1>Shift Types</h1>
    <table border="1">
        <tr>
            <th>Type</th>
            <th>Description</th>
            <th>Day</th>
            <th>Night</th>
            <th>Sat</th>
            <th>Sun</th>
            <th>Holiday</th>
            <th>Actions</th>
        </tr>
        @foreach($shiftTypes as $shift)
        <tr>
            <td>{{ $shift->shift_type }}</td>
            <td>{{ $shift->description }}</td>
            <td>{{ $shift->rate_day }}</td>
            <td>{{ $shift->rate_night }}</td>
            <td>{{ $shift->rate_sat }}</td>
            <td>{{ $shift->rate_sun }}</td>
            <td>{{ $shift->rate_public_holiday }}</td>
            <td>
                <a href="{{ route('shift-types.edit', $shift->id) }}">Edit</a>
                <form action="{{ route('step2.shift-types.destroy', $shift->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>

            </td>
        </tr>
        @endforeach
    </table>

    <h1>Locations</h1>
    <table border="1">
        <tr>
            <th>Name</th>
            <th>Actions</th>
        </tr>
        @foreach($locations as $location)
        <tr>
            <td>{{ $location->name }}</td>
            <td>
                <a href="{{ route('locations.edit', $location->id) }}">Edit</a>
                <form action="{{ route('step2.locations.destroy', $location->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>

            </td>
        </tr>
        @endforeach
    </table>

    <br>
    <a href="{{ url('/step3') }}">Next Step →</a>
</body>
</html>
