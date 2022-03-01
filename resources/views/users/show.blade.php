@extends('layouts.app')


@section('content')
<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<div>
				<h2>Show User <a class="btn btn-primary float-end" href="{{ route('users.index') }}"> Back</a></h2>
			</div>
		</div>
	</div>


	<div class="row">
		<div class="col-12">
			<div class="form-group">
				<strong>Name:</strong>
				{{ $user->name }}
			</div>
		</div>
		<div class="col-12">
			<div class="form-group">
				<strong>Email:</strong>
				{{ $user->email }}
			</div>
		</div>
		<div class="col-12">
			<div class="form-group">
				<strong>Roles:</strong>
				@if(!empty($user->getRoleNames()))
					@foreach($user->getRoleNames() as $v)
						<label class="badge bg-success">{{ $v }}</label>
					@endforeach
				@endif
			</div>
		</div>
		<div class="col-12 py-1 my-2">
			<h2 class="m-0">Posts:</h2>
			@forelse ($posts as $post)
			@if ($post->trashed())
				@can('post-delete')				
				<div class="border-bottom py-2">
					<h3 class="mb-0 mt-2"><a href="{{ route('posts.show',$post->id) }}">{{ $post->title }}</a>
						<div class="float-lg-end pt-2 pt-lg-0">
							{!! Form::open(['method' => 'POST','route' => ['posts.restore', $post->id],'style'=>'display:inline']) !!}
								{!! Form::submit('Restore', ['class' => 'btn btn-danger']) !!}
							{!! Form::close() !!}
						</div>					
					</h3>
					<small class="text-muted">Last edit: {{ \Carbon\Carbon::parse($post->created_at)->format('d/m/Y') }} | <span class="badge bg-danger">Deleted</span></small>
				</div>
				@endcan 
			@else
				<div class="border-bottom py-2">
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
					<small class="text-muted">Last edit: {{ \Carbon\Carbon::parse($post->created_at)->format('d/m/Y') }} </small>
				</div>				
			@endif
			@empty
				No posts
			@endforelse					
		</div>
		<div class="col-12 py-1 my-2">
			<h2 class="m-0">Comments:</h2>
			@forelse ($comments as $c)
			@if ($c->trashed())
				@can('comment-delete')
				<div class="py-2 border-bottom">
					<div>
						<small class="text-muted">Last edit: {{ \Carbon\Carbon::parse($c->created_at)->format('d/m/Y') }} | <span class="badge bg-danger">Deleted</span></small>
						{!! Form::open(['method' => 'POST','route' => ['posts.comments.restore', $c->id],'style'=>'display:inline']) !!}
							{!! Form::submit('Restore', ['class' => 'btn btn-danger float-end']) !!}
						{!! Form::close() !!}		
					</div>	
					<div class="mt-2 text-truncate" style="max-height: 150px">
						<x-markdown>
						{{ $c->description }}
						</x-markdown>
					</div>
				</div>
				@endcan 
			@else
				<div class="py-2 border-bottom">
					<div>
						<small class="text-muted">Last edit: {{ \Carbon\Carbon::parse($c->created_at)->format('d/m/Y') }} | In <a href="{{ route('posts.show', $c->post->id).'#comment-'.$c->id }}">{{ $c->post->title }}</a></small>
						@can('comment-delete')
						{!! Form::open(['method' => 'DELETE','route' => ['posts.comments.destroy', $c->id],'style'=>'display:inline']) !!}
							{!! Form::submit('Delete', ['class' => 'btn btn-danger float-end']) !!}
						{!! Form::close() !!}						
						@endcan				
					</div>
					<div class="mt-2 text-truncate" style="max-height: 150px">
						<x-markdown>
						{{ $c->description }}
						</x-markdown>
					</div>	
				</div>			
			@endif
			@empty
				No comments
			@endforelse			
		</div>	
	</div>
</div>
@endsection