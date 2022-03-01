@extends('layouts.app')


@section('content')
<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<div>
				<h2>Users Management <a class="btn btn-primary float-end" href="{{ route('users.create') }}"> Create New</a></h2>
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
				<div class="col-2 my-auto"><strong>Name</strong></div>
				<div class="col-3 my-auto"><strong>Email</strong></div>
				<div class="col-3 my-auto"><strong>Roles</strong></div>
				<div class="col-3 my-auto"><strong>Action</strong></div>
			</div>
		</div>
		@foreach ($data as $key => $user)
		<div class="col border-bottom pb-3 pb-lg-1 p-1">
			<div class="row row-cols-1 row-cols-lg-12">
				<div class="col col-lg-1 my-auto"><strong class="d-lg-none">ID: </strong>{{ $user->id }}</div>
				<div class="col col-lg-2 my-auto"><strong class="d-lg-none">Name: </strong>{{ $user->name }}</div>
				<div class="col col-lg-3 my-auto text-truncate"><strong class="d-lg-none">Email: </strong>{{ $user->email }}</div>
				<div class="col col-lg-3 my-auto text-truncate"><strong class="d-lg-none">Roles: </strong>
				@if(!empty($user->getRoleNames()))
					@foreach($user->getRoleNames() as $v)
					   <label class="badge bg-success">{{ $v }}</label>
					@endforeach
				@endif
				</div>
				<div class="col col-lg-3 my-auto">
					<div class="float-lg-end pt-2 pt-lg-0">
						<a class="btn btn-secondary" href="{{ route('users.show',$user->id) }}">Show</a>
						<a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Edit</a>
						{!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
							{!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>	 
		@endforeach
	</div>


	{!! $data->render("pagination::bootstrap-5") !!}
</div>
@endsection