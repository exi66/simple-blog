@extends('layouts.app')


@section('content')
<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<div>
				<h2>Create New Role <a class="btn btn-primary float-end" href="{{ route('roles.index') }}"> Back</a></h2>
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


	{!! Form::open(array('route' => 'roles.store','method'=>'POST')) !!}
	<div class="row">
		<div class="col-12">
			<div class="form-group mt-3">
				<label for="name" class="form-label">Name:</label>
				{!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control','id' => 'name')) !!}
			</div>
		</div>
		<div class="col-12">
			<div class="form-group mt-3">
				<label for="prems" class="form-label">Permission:</label>
				<div id="prems" class="form-control">
					@foreach($permission as $value)
						<label>{{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name')) }}
						{{ $value->name }}</label>
					<br/>
					@endforeach
				</div>
			</div>
		</div>
		<div class="col-12 text-center d-grid mt-3">
			<button type="submit" class="btn btn-primary">Submit</button>
		</div>
	</div>
	{!! Form::close() !!}
</div>
@endsection