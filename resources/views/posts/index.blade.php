@extends('layouts.app')

@section('content')
<div class="container">
    {{-- Success Flash Message --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <h2>All Posts</h2>

    {{-- Search Filter --}}
    <form method="GET" action="{{ route('posts.index') }}" class="row g-3 mb-4">
        <div class="col-md-4">
            <input type="text" name="title" class="form-control" placeholder="Filter by Title" value="{{ request('title') }}">
        </div>
        <div class="col-md-4">
            <input type="text" name="author" class="form-control" placeholder="Filter by Author" value="{{ request('author') }}">
        </div>
        <div class="col-md-4">
            <button type="submit" class="btn btn-primary">Search</button>
            <a href="{{ route('posts.index') }}" class="btn btn-secondary">Reset</a>
        </div>
    </form>

    {{-- Add New Post Button --}}
    @if(auth()->user()->role === 'admin' || auth()->user()->role === 'editor')
        <a href="{{ route('posts.create') }}" class="btn btn-success mb-3">Add New Post</a>
    @endif

    {{-- Posts Table --}}
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Author</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($posts as $index => $post)
                <tr>
                    <td>{{ $posts->firstItem() + $index }}</td>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->user->name ?? 'Unknown' }}</td>
                    <td>{{ $post->created_at->format('Y-m-d') }}</td>
                    <td>
                        {{-- View only for admin --}}
                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('posts.show', $post) }}" class="btn btn-info btn-sm">View</a>
                        @endif

                        {{-- Edit for admin and editor --}}
                        @if(auth()->user()->role === 'admin' || auth()->user()->role === 'editor')
                            <a href="{{ route('posts.edit', $post) }}" class="btn btn-warning btn-sm">Edit</a>
                        @endif

                        {{-- Delete only for admin --}}
                        @if(auth()->user()->role === 'admin')
                            <form action="{{ route('posts.destroy', $post) }}" method="POST" style="display:inline-block;">
                                @csrf 
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr><td colspan="5">No posts found.</td></tr>
            @endforelse
        </tbody>
    </table>

    {{-- Pagination --}}
    {{ $posts->appends(request()->query())->links() }}
</div>
@endsection
