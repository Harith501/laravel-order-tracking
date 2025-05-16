@extends('layouts.app')

@section('title', 'Google Sheet Data')

@section('content')
<div class="container">
    <h1 class="mb-4">Google Sheet Data</h1>

    @if (!empty($rows))
        <table class="table table-bordered">
            <thead>
                <tr>
                    @foreach ($rows[0] as $heading)
                        <th>{{ $heading }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach (array_slice($rows, 1) as $row)
                    <tr>
                        @foreach ($row as $cell)
                            <td>{{ $cell }}</td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No data found.</p>
    @endif
</div>
@endsection
