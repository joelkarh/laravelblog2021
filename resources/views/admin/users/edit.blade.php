@extends('layouts.admin')
@section('content')
<h1>Edit User</h1>
<div class="row">
    <div class="col-8 img-thumbnail">
        {!! Form::open(['method'=>'PATCH', 'action'=> ['App\Http\Controllers\AdminUsersController@store',$user->id], 'files'=>true])
!!}
<div class="form-group">
    {!! Form::label('name','Name:' )!!}
    {!! Form::text('name',$user->name,['class'=>"form-control"] )!!}
</div>
<div class="form-group">
    {!! Form::label('email','E-mail:' )!!}
    {!! Form::text('email',$user->email,['class'=>"form-control"] )!!}
</div>
<div class="form-group">
    {!! Form::label('Select roles: (hou de ctrl toets ingedrukt om meerdere roles te selecteren' )!!}
    {!! Form::select('roles[]',$roles, $user->roles->pluck('id')->toArray(),['class'=>'form-control','multiple'=>'multiple'])!!}
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
    {!! Form::select('is_active',array(1=>'active', 0=>'Not active'),$user->is_active,['class'=>'form-control'])!!}
</div>
<div class="form-group">
    {!! Form::submit('Create user',['class'=>'btn btn-primary'])!!}
</div>
{!!Form::close()!!}
    </div>
    <div class="col-4 d-flex justify-content-center align-items-center img-thumbnail">
        <img src="{{$user->photo ? asset($user->photo->file): "http://placehold.it/400x400"}}" alt="{{$user->name}}" class="img-fluid img-thumbnail">
    </div>
</div>

@include('includes.form_error')
@endsection