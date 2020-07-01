@extends('layouts.app')

@section('content')
<div class="container" style="margin-top: 50px;">
    <div class="row justify-content-center">
      <div class="col-12 col-md-8 col-lg-8 col-xl-6">
        <div class="row">
          <div class="col text-center title">
            <h1>Add Contact</h1>
          </div>
          </div>
          {!! Form::open(['action' => 'Contact_Controller@store', 'method' => 'POST']) !!}
          <div class="form-group">
              {{Form::label('title','Name')}}
              {{Form::text('name','', ['class'=>'form-control', ])}}
          </div>
          <div class="form-group">
              {{Form::label('title','Company')}}
              {{Form::text('company','', ['id'=> 'article-ckeditor', 'class'=>'form-control', ])}}
          </div>
          <div class="form-group">
            {{Form::label('title','Phone')}}
            {{Form::text('phone','', ['id'=> 'article-ckeditor', 'class'=>'form-control', ])}}
        </div>
          <div class="form-group">
              {{Form::label('title','Email')}}
              {{Form::text('email','', ['class'=>'form-control', ])}}
          </div>
          <div align="left">
          {{Form::submit('Submit', ['class'=>'btn btn-primary', 'style'=>'float:right'])}}
          </div>
      {!! Form::close() !!}
      </div>
    </div>
  </div>
@endsection