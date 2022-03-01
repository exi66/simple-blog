@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<div>
				<h2>Show Role <a class="btn btn-primary float-end" href="{{ route('roles.index') }}"> Back</a></h2>
			</div>
		</div>
	</div>


	<div class="row">
		<div class="col-12">
			<div class="form-group">
				<strong>Name:</strong>
				{{ $role->name }}
			</div>
		</div>
		<div class="col-12">
			<div class="form-group">
				<strong>Permissions:</strong>
				@if(!empty($rolePermissions))
					@foreach($rolePermissions as $v)
						<label class="badge bg-success">{{ $v->name }}</label>
					@endforeach
				@endif
			</div>
		</div>
	</div>
</div>
@endsection