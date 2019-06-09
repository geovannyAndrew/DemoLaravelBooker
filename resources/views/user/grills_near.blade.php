@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row row-eq-height">
        <div class="col-md-12 align-baseline">
            <h1>Grills Near me</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead>
                    <tr class="d-flex">
                        <th class="col-1">ID</th>
                        <th class="col-2">Model</th>
                        <th class="col-3">Image</th>
                        <th class="col-3">Renter</th>
                        <th class="col-3">View</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($grills as $grill)
                    <tr class="d-flex">
                        <td class="col-1">{{ $grill->id }}</td>
                        <td class="col-2">{{ $grill->model }}</td>
                        <td class="col-3"><img src="{{ $grill->url_image }}" width="80" alt=""></td>
                        <td class="col-3">{{ $grill->renter->name }}</td>
                        <td class="col-3">
                            <a href="{{ route('grills.show',$grill->id)}}"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection