@extends('layouts.app',['name_page'=>'renter-bookings'])

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
                    <tr>
                        <th>ID</th>
                        <th>Grill ID/Model</th>
                        <th>Reserved by</th>
                        <th>Reserved for/hours</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bookings as $booking)
                    <tr>
                        <td>{{ $booking->id }}</td>
                        <td>
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