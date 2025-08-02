@extends('layouts.app')

@section('content')
<div class="container">

    <div class="card mb-4">
        <div class="card-header">
            <h3>{{ $post->title }}</h3>
            <small>By {{  $post->user->name }} - {{ $post->created_at->diffForHumans() }}</small>
        </div>
        <div class="card-body">
            <p>{{ $post->content }}</p>
        </div>
    </div>

    <div class="mb-4">
        <h5 id="comments-count">Comments ({{ $post->comments->count() }})</h5>
        <ul class="list-group" id="comments-list">
            @forelse ($post->comments as $comment)
                <li class="list-group-item">
                    <strong>{{ $comment->user ? $comment->user->name : 'Anonymous' }}:</strong>
                    {{ $comment->comment_text }}
                    <br>
                    <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                </li>
            @empty
                <li class="list-group-item text-muted">No comments yet.</li>
            @endforelse
        </ul>
    </div>

    <div>
        <h5>Add Comment</h5>
        @auth
            <form method="POST" action="{{ route('comments.store') }}" id="comment-form">
                @csrf
                <input type="hidden" name="post_id" value="{{ $post->id }}">

                <div class="mb-3">
                    <label for="comment_text" class="form-label">Comment</label>
                    <textarea name="comment_text" class="form-control" rows="3" required></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Submit Comment</button>
            </form>
        @else
            <p>Please <a href="{{ route('login') }}">login</a> to add a comment.</p>
        @endauth
    </div>

</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
    $('#comment-form').submit(function(e) {
        e.preventDefault();

        $.ajax({
            url: $(this).attr('action'),
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                $('#comment-form textarea[name="comment_text"]').val('');

                var newCommentHtml = `
                    <li class="list-group-item">
                        <strong>${response.user_name}:</strong>
                        ${response.comment_text}
                        <br>
                        <small class="text-muted">${response.created_at}</small>
                    </li>
                `;

                $('#comments-list').append(newCommentHtml);

                var countElem = $('#comments-count');
                var currentCount = parseInt(countElem.text().match(/\d+/)[0]);
                countElem.text(`Comments (${currentCount + 1})`);
            },
            error: function(xhr) {
                alert('Failed to add comment. Please try again.');
            }
        });
    });
});
</script>
@endsection
