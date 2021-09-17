@extends('layouts.admin')
@section('content')
<h1>Create User</h1>
{!! Form::open(['method'=>'POST', 'action'=> 'App\Http\Controllers\AdminUsersController@store', 'files'=>true])
!!}
<div class="form-group">
    {!! Form::label('name','Name:' )!!}
    {!! Form::text('name',null,['class'=>"form-control"] )!!}
</div>
<div class="form-group">
    {!! Form::label('email','E-mail:' )!!}
    {!! Form::text('email',null,['class'=>"form-control"] )!!}
</div>
<div class="form-group">
    {!! Form::label('Select roles: (hou de ctrl toets ingedrukt om meerdere roles te selecteren' )!!}
    {!! Form::select('roles[]',$roles, null,['class'=>'form-control','multiple'=>'multiple'])!!}
</div>
<div class="form-group">
    {!! Form::label('password', 'Password:') !!}
    {!! Form::password('password',['class'=>"form-control"] )!!}
</div>
<div class="form-group">
    {!! Form::label('photo_id', 'Photo:' )!!}
    {!! Form::file('photo_id', null, ['class'=>"form-control"] )!!}
</div>
<div class="form-group">
    {!! Form::label('is_active','Status:')!!}
    {!! Form::select('is_active',array(1=>'active', 0=>'Not active'),0,['class'=>'form-control'])!!}
</div>
<div class="form-group">
    {!! Form::submit('Create user',['class'=>'btn btn-primary'])!!}
</div>
{!!Form::close()!!}
@include('includes.form_error')
@endsection