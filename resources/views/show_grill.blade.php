@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Grill #{{ $grill->id }}</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    {!! Form::label('model', 'Model:') !!}
                    <h4>{{ $grill->model }}</h4>
                    <br>
                    {!! Form::label('image', 'Image:') !!}
                    <br>
                    <img src="{{ $grill->url_image }}" alt="">
                    <br>
                    <br>
                    {!! Form::label('description', 'Description:') !!}
                    <br>
                    <p>{{ $grill->description }}</p>
                    <br>
                    {!! Form::label('Renter', 'Renter:') !!}
                    <h4>{{ $grill->renter->name }}</h4>
                    <br>
                </div>
            </div>
        </div>
    </div>

    @if($user->is_user)
        <div class="row">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>
        <div class="row">
            <div class="col-md-12">
                {!! Form::open(['url' => route('user.grills.book',$grill->id),'method'=>'post','files' => false,'role' => 'form']) !!}
                    {!! Form::label('date', 'Book for:') !!}
                    <br>
                    {!! Form::date('date', null,['min'=>date('Y-m-d'),'required'=>'required']) !!}
                    <br>
                    {!! Form::label('hours', 'Hours:') !!}
                    <br>
                    {!! Form::number('hours',null,['required'=>'required']) !!}
                    <br>
                    {!! Form::submit('Book',['class'=>'btn btn-success']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    @endif
</div>
@endsection