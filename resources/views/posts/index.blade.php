@extends('layouts.app')


@section('content')
<div class="container">
	<div class="row row-cols-1">
		<div class="col border-bottom">
			<div>
				<h2>All Posts 
				@guest
					
				@else
					@canany(['post-create'])	
						<a class="btn btn-primary float-end" href="{{ route('posts.create') }}">Create New</a>
					@endcanany
				@endguest
				</h2>
			</div>
		</div>
	</div>


	@if ($message = Session::get('success'))
	<div class="alert alert-success mt-3">
		<p>{{ $message }}</p>
	</div>
	@endif



	<div class="row row-cols-1 p-2">
		@foreach ($posts as $key => $post)
			@if ($post->trashed())
				@can('post-delete')
		<div id="post-{{$post->id}}" class="col border-bottom pb-3 pb-lg-1 p-1">
			<div class="row row-cols-1">
				<div class="col">
					<h3 class="mb-0">{{ $post->title }}
						<div class="float-lg-end pt-2 pt-lg-0">
							{!! Form::open(['method' => 'POST','route' => ['posts.restore', $post->id],'style'=>'display:inline']) !!}
								{!! Form::submit('Restore', ['class' => 'btn btn-danger']) !!}
							{!! Form::close() !!}
						</div>
					</h3>
					<small class="text-muted">Author: <a href="{{ route('users.show', $post->user->id) }}">{{ $post->user->name }}</a>  | Last edit: {{ \Carbon\Carbon::parse($post->created_at)->format('d/m/Y') }} | <span class="badge bg-danger">Deleted</span></small>
				</div>
				<div class="col mt-3 text-truncate" style="max-height: 300px">
					<x-markdown>
					{{ $post->description }}
					</x-markdown>
				</div>
			</div>
		</div>
				@endcan 
			@else
		<div id="post-{{$post->id}}" class="col border-bottom pb-3 pb-lg-1 p-1">
			<div class="row row-cols-1">
				<div class="col">
					<h3 class="mb-0"><a href="{{ route('posts.show',$post->id) }}">{{ $post->title }}</a>
						<div class="float-lg-end pt-2 pt-lg-0">
							@can('post-edit')
							<a class="btn btn-warning" href="{{ route('posts.edit',$post->id) }}">Edit</a>
							@endcan   
							@can('post-delete')
								{!! Form::open(['method' => 'DELETE','route' => ['posts.destroy', $post->id],'style'=>'display:inline']) !!}
									{!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
								{!! Form::close() !!}
							@endcan
						</div>
					</h3>	
					<small class="text-muted">Author: <a href="{{ route('users.show', $post->user->id) }}">{{ $post->user->name }}</a>  | Last edit: {{ \Carbon\Carbon::parse($post->created_at)->format('d/m/Y') }}</small>
				</div>
				<div id="publication-{{$post->id}}" class="col mt-3 text-truncate" style="max-height: 300px">
					<x-markdown>
					{{ $post->description }}
					</x-markdown>
				</div>
				<div class="col d-grid mt-2">
					<button onClick="ReadAll(this, {{$post->id}})" class="btn btn-outline-primary">Read all</button>
				</div>				
			</div>
		</div>			
			@endif
		@endforeach
	</div>
	{!! $posts->render("pagination::bootstrap-5") !!}
	
	<script>
		function ReadAll(button, id) {
			let element = document.getElementById("publication-"+id);
			element.style.removeProperty("max-height");
			//element.classList.remove("text-truncate");
			button.style.display = "none";
		}	
	</script>
</div>
@endsection