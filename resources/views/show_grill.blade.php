@extends('layouts.app',['name_page'=>'bb-detail-grill'])

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Grill #{{ $grill->id }}</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-grill">
                <div class="card-body">
                    <div class="image">
                        <h6>Image:</h6>
                        <img src="{{ $grill->url_image }}" alt="">
                    </div>
                    <div class="info">
                        <h6>Model:</h6>
                        <p>{{ $grill->model }}</p>
                        <h6>Description:</h6>
                        <p>{{ $grill->description }}</p>
                        <h6>Renter:</h6>
                        <p>{{ $grill->renter->name }}</p>
                    </div>
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
                {!! Form::open(['url' => route('user.grills.book',$grill->id),'method'=>'post','files' => false,'role' => 'form', 'class'=>'bb-form']) !!}
                    <h3>Booking Grill</h3>
                    <div class="form-group">
                        {!! Form::label('date', 'Book for:') !!}
                        <br>
                        {!! Form::date('date', null,['min'=>date('Y-m-d'),'required'=>'required']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('hours', 'Hours:') !!}
                        <br>
                        {!! Form::number('hours',null,['required'=>'required','min'=>0]) !!}
                    </div>
                    {!! Form::submit('Book',['class'=>'btn btn-success bb-submit']) !!}
                    
                {!! Form::close() !!}
            </div>
        </div>
    @endif
</div>
@endsection