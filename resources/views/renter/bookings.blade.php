@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row row-eq-height">
        <div class="col-md-12 align-baseline">
            <h1>Grill Bookings</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead>
                    <tr class="d-flex">
                        <th class="col-1">ID</th>
                        <th class="col-2">Grill ID/Model</th>
                        <th class="col-3">Asked by</th>
                        <th class="col-3">Asked for/hours</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bookings as $booking)
                    <tr class="d-flex">
                        <td class="col-1">{{ $booking->id }}</td>
                        <td class="col-2">
                            <a href="{{ route('grills.show',$booking->grill->id) }}">{{ $booking->grill->id }}<br>{{ $booking->grill->model }}</a>
                        </td>
                        <td>{{ $booking->user->name }}</td>
                        <td>{{ $booking->reserved_for }}<br>{{ $booking->hours }} Hours</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection