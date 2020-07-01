@extends('layouts.app')

@section('content')
<div class="container" style="margin-top: 50px;">
    <div class="row justify-content-center">
      <div class="col-12 col-md-8 col-lg-8 col-xl-6">
        <div class="row">
          <div class="col text-center title">
            <h1>Edit Contact</h1>
          </div>
          </div>
            {!! Form::open(['action' => ['Contact_Controller@update', $contact->id], 'method' => 'POST']) !!}
                <div class="form-group">
                    {{Form::label('title','Name')}}
                    {{Form::text('name',$contact->name, ['class'=>'form-control', ])}}
                </div>
                <div class="form-group">
                    {{Form::label('title','Company')}}
                    {{Form::text('company',$contact->company, ['id'=> 'article-ckeditor', 'class'=>'form-control', ])}}
                </div>
                <div class="form-group">
                {{Form::label('title','Phone')}}
                {{Form::text('phone',$contact->phone, ['id'=> 'article-ckeditor', 'class'=>'form-control', ])}}
                </div>
                <div class="form-group">
                    {{Form::label('title','Email')}}
                    {{Form::text('email',$contact->email, ['class'=>'form-control', ])}}
                </div>
                {{-- add this PUT refer to route method PUT|PATCH under posts.update --}}
                {{Form::hidden('_method', 'PUT')}}
                {{Form::submit('Submit', ['class'=>'btn btn-primary', 'style'=>'float:right'])}}
            {!! Form::close() !!}
        </div>
    </div>
  </div>
@endsection