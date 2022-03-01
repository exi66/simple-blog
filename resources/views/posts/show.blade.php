@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row row row-cols-1 p-2">
		<div class="col border-bottom pb-3 pb-lg-1 p-1">
			<div class="row row-cols-1">
				<div class="col pb-2 border-bottom">
					<h2 class="mb-0">{{ $post->title }}
						<div class="float-end pt-2 pt-lg-0">
							<a class="btn btn-primary" href="{{ route('posts.index') }}">Back</a>
							@can('post-edit')
							<a class="btn btn-warning" href="{{ route('posts.edit',$post->id) }}">Edit</a>
							@endcan   
							@can('post-delete')
								{!! Form::open(['method' => 'DELETE','route' => ['posts.destroy', $post->id],'style'=>'display:inline']) !!}
									{!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
								{!! Form::close() !!}
							@endcan
						</div>
					</h2>	
					<small class="text-muted">Author: <a href="{{ route('users.show', $post->user->id) }}">{{ $post->user->name }}</a> | Last edit: {{ \Carbon\Carbon::parse($post->created_at)->format('d/m/Y') }}</small>
				</div>
				<div id="publication-{{$post->id}}" class="col mt-3">
					<x-markdown>
					{{ $post->description }}
					</x-markdown>
				</div>		
			</div>
		</div>
		@guest
			
		@else
		{!! Form::open(array('route' => ['posts.comments.store', $post->id],'method'=>'POST')) !!}
		<div class="col">
			<div class="row">
				<div class="col-12">
					<div class="form-group mt-3">
						{!! Form::textarea('description', null, array('placeholder' => 'Comment','class' => 'form-control','id' => 'description','rows' => '3')) !!}
					</div>
				</div>		
				<div class="col-12 text-center d-grid mt-1">
					<button type="submit" class="btn btn-primary">Submit</button>
				</div>
			</div>
		</div>	
		{!! Form::close() !!}
		@endguest		
		<div class="col">
			<div class="row row-cols-1">
		@foreach ($comments as $key => $comm)
			@if ($comm->trashed())
				@can('comment-delete')
				<div id="comment-{{$comm->id}}" class="col mt-2">
					<div class="card">
						<div class="card-header"><a href="{{ route('users.show', $comm->user->id) }}">{{ $comm->user->name }}</a> | {{ \Carbon\Carbon::parse($comm->created_at)->format('d/m/Y') }} | <span class="badge bg-danger">Deleted</span>
							{!! Form::open(['method' => 'POST','route' => ['posts.comments.restore', $comm->id],'style'=>'display:inline']) !!}
								{!! Form::submit('Restore', ['class' => 'btn btn-danger float-end']) !!}
							{!! Form::close() !!}	  				
						</div>
						<div class="card-body">
							<x-markdown>
							{{ $comm->description }}
							</x-markdown>				
						</div>
					</div>					
				</div>					
				@endcan 
			@else
				<div id="comment-{{$comm->id}}" class="col mt-2">
					<div class="card">
						<div class="card-header"><a href="{{ route('users.show', $comm->user->id) }}">{{ $comm->user->name }}</a> | {{ \Carbon\Carbon::parse($comm->created_at)->format('d/m/Y') }}
						@can('comment-delete')
						{!! Form::open(['method' => 'DELETE','route' => ['posts.comments.destroy', $comm->id],'style'=>'display:inline']) !!}
							{!! Form::submit('Delete', ['class' => 'btn btn-danger float-end']) !!}
						{!! Form::close() !!}						
						@endcan  	
						</div>
						<div class="card-body">
							<x-markdown>
							{{ $comm->description }}
							</x-markdown>				
						</div>
					</div>					
				</div>
			@endif
		@endforeach
			</div>
		</div>
	</div>
</div>
@endsection