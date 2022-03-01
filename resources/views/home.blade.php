@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8">
            <div class="card">
                <div class="card-header">Last posts <a class="float-end" href="{{ route('posts.index') }}">View all</a></div>
                <div class="card-body">
				@forelse ($posts as $p)
					<div class="border-bottom py-2">
						<h3 class="mb-0 mt-2"><a href="{{ route('posts.show',$p->id) }}">{{ $p->title }}</a></h3>
						<small class="text-muted">Author: <a href="{{ route('users.show', $p->user->id) }}">{{ $p->user->name }}</a> | Last edit: {{ \Carbon\Carbon::parse($p->created_at)->format('d/m/Y') }}</small>
					</div>
				@empty
					No posts
				@endforelse				
				</div>
            </div>
            <div class="card mt-4">
                <div class="card-header">Most discussed</div>
                <div class="card-body">
				@empty($most)
					No posts
				@else
					<h3 class="mb-0 mt-2"><a href="{{ route('posts.show',$most->id) }}">{{ $most->title }}</a></h3>
					<small class="text-muted">Author: <a href="{{ route('users.show', $most->user->id) }}">{{ $most->user->name }}</a> | Last edit: {{ \Carbon\Carbon::parse($most->created_at)->format('d/m/Y') }}</small>				
				@endempty
                </div>
            </div>			
        </div>
        <div class="col-lg-4 mt-4 mt-lg-0">
			<form method="POST" action="{{ route('searched') }}">
				<div class="input-group">
					<input type="text" class="form-control" name="search" required>
					<button class="btn btn-primary" type="sumbit">Search</button>
				</div>
			</form>
            <div class="card mt-4">
                <div class="card-header">Last comments</div>
                <div class="card-body">
				@forelse ($comments as $c)
					<small class="text-muted"><a href="{{ route('users.show', $c->user->id) }}">{{ $c->user->name }}</a> | Last edit: {{ \Carbon\Carbon::parse($c->created_at)->format('d/m/Y') }} | In <a href="{{ route('posts.show', $c->post->id).'#comment-'.$c->id }}">{{ $c->post->title }}</a></small>
					<div class="mt-2 text-truncate border-bottom" style="max-height: 150px">
						<x-markdown>
						{{ $c->description }}
						</x-markdown>
					</div>
				@empty
					No comments
				@endforelse		
                </div>
            </div>			
        </div>		
    </div>
</div>
@endsection
