@extends('layouts.app')


@section('content')
<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<div>
				<h2>Create New Post <a class="btn btn-primary float-end" href="{{ route('posts.index') }}"> Back</a></h2>
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


	{!! Form::open(array('route' => 'posts.store','method'=>'POST')) !!}
	<div class="row">
		<div class="col-12">
			<div class="form-group mt-3">
				<label for="title" class="form-label">Title:</label>
				{!! Form::text('title', null, array('placeholder' => 'Title','class' => 'form-control','id' => 'title')) !!}
			</div>
		</div>
		<div class="col-12">
			<div class="form-group mt-3">
				<label for="description" class="form-label">Description:</label>
				{!! Form::textarea('description', null, array('placeholder' => 'Post description','class' => 'form-control','id' => 'description')) !!}
			</div>
		</div>
		<div class="col-12 text-center d-grid mt-3">
			<button type="submit" class="btn btn-primary">Submit</button>
		</div>
	</div>
	{!! Form::close() !!}
</div>
@endsection