@extends('layouts.app')


@section('content')
<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<div>
				<h2>Role Management <a class="btn btn-primary float-end" href="{{ route('roles.create') }}"> Create New</a></h2>
			</div>
		</div>
	</div>


	@if ($message = Session::get('success'))
	<div class="alert alert-success mt-3">
		<p>{{ $message }}</p>
	</div>
	@endif



	<div class="row row-cols-1 row-cols-md-2 row-cols-lg-1 p-2">
		<div class="col border-bottom p-1 d-none d-lg-block">
			<div class="row row-cols-12">
				<div class="col-1 my-auto"><strong>ID</strong></div>
				<div class="col-5 my-auto"><strong>Name</strong></div>
				<div class="col-6 my-auto"><strong>Action</strong></div>
			</div>
		</div>
		@foreach ($roles as $key => $role)
		<div class="col border-bottom pb-3 pb-lg-1 p-1">
			<div class="row row-cols-1 row-cols-lg-12">
				<div class="col col-lg-1 my-auto"><strong class="d-lg-none">ID: </strong>{{ $role->id }}</div>
				<div class="col col-lg-5 my-auto"><strong class="d-lg-none">Name: </strong>{{ $role->name }}</div>
				<div class="col col-lg-6 my-auto">
					<div class="float-lg-end pt-2 pt-lg-0">
						<a class="btn btn-secondary" href="{{ route('roles.show',$role->id) }}">Show</a>
						@can('role-edit')
						<a class="btn btn-primary" href="{{ route('roles.edit',$role->id) }}">Edit</a>
						@endcan   
						@can('role-delete')
							{!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!}
								{!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
							{!! Form::close() !!}
						@endcan
					</div>
				</div>
			</div>
		</div>	 
		@endforeach
	</div>


	{!! $roles->render("pagination::bootstrap-5") !!}
</div>
@endsection