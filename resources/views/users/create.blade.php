@extends('layouts.app')


@section('content')
<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<div>
				<h2>Create New User <a class="btn btn-primary float-end" href="{{ route('users.index') }}"> Back</a></h2>
			</div>
		</div>
	</div>


	@if (count($errors) > 0)
		<div class="alert alert-danger mt-2">
			<strong>Whoops!</strong> There were some problems with your input.<br><br>
			<ul>
			   @foreach ($errors->all() as $error)
				 <li>{{ $error }}</li>
			   @endforeach
			</ul>
		</div>
	@endif



	{!! Form::open(array('route' => 'users.store','method'=>'POST')) !!}
	<div class="row">
		<div class="col-6">
			<div class="form-group mt-3">
				<label for="name" class="form-label">Name:</label>
				{!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control','id' => 'name')) !!}
			</div>
		</div>
		<div class="col-6">
			<div class="form-group mt-3">
				<label for="email" class="form-label">Email:</label>
				{!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control','id' => 'email')) !!}
			</div>
		</div>
		<div class="col-6">
			<div class="form-group mt-3">
				<label for="password" class="form-label">Password:</label>
				{!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control','id' => 'password')) !!}
			</div>
		</div>
		<div class="col-6">
			<div class="form-group mt-3">
				<label for="confirm-password" class="form-label">Confirm Password:</label>
				{!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control','id' => 'confirm-password')) !!}
			</div>
		</div>
		<div class="col-12">
			<div class="form-group mt-3">
				<label for="roles" class="form-label">Roles:</label>
				{!! Form::select('roles[]', $roles,[], array('class' => 'form-control','multiple','id' => 'roles')) !!}
			</div>
		</div>
		<div class="col-12 text-center d-grid mt-3">
			<button type="submit" class="btn btn-primary">Submit</button>
		</div>
	</div>
	{!! Form::close() !!}
</div>
@endsection