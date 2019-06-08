@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row row-eq-height">
        <div class="col-md-8 align-baseline">
            <h1>Grills</h1>
        </div>
        <div class="col-md-4 text-right align-baseline">
            <br>
            <a href="{{ route('grills.create') }}" class="btn btn-primary" role="button" aria-disabled="true">New Grill</a> 
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead>
                    <tr class="d-flex">
                        <th class="col-1">ID</th>
                        <th class="col-2">Model</th>
                        <th class="col-3">Description</th>
                        <th class="col-3">Image</th>
                        <th class="col-3">Zipcode</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($grills as $grill)
                    <tr class="d-flex">
                        <td class="col-1">{{ $grill->id }}</td>
                        <td class="col-2">{{ $grill->model }}</td>
                        <td class="col-3">{{ $grill->description }}</td>
                        <td class="col-3"><img src="{{ $grill->url_image }}" width="80" alt=""></td>
                        <td class="col-3">{{ $grill->zipcode }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection