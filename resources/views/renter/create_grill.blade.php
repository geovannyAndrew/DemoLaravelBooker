@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Create a new Grill</h1>
        </div>
    </div>
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
            <div class="card">
                <div class="card-body">
                {!! Form::open(['route' => 'grills.store','method'=>'post','files' => true,'role' => 'form']) !!}
                    {!! Form::label('model', 'Model:') !!}
                    {!! Form::text('model',null,['class'=>'form-control','required' => 'required']) !!}
                    <br>
                    {!! Form::label('path', 'Select an Image:', []) !!}                          
                    {!! Form::file('image',null, ['required' => 'true']) !!}
                    <br>
                    {!! Form::label('zipcode', 'Zipcode:') !!}
                    {!! Form::number('zipcode',null,['class'=>'form-control','required' => 'required']) !!}
                    <br>
                    {!! Form::label('description', 'Description:', []) !!}
                    <br>
                    {!! Form::textarea('description', null, ['class'=>'form-control','placeholder'=>'Enter a description here...','rows' => 3]) !!}
                    <br>
                    {!! Form::submit('Save',['class'=>'btn btn-success']) !!}
                {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection