@extends('layouts.app')

@section('title', __('Topics index'))

@section('content')
    <div class="card mb-3">
        <div class="card-header">
            <h5 class="card-title">{{ __('Topics') }}</h5>
        </div>
        <div class="card-body">
            @if ($topics->isEmpty())
                <p class="text-muted">{{ __('No topics found.') }}</p>
            @else
                <ul class="list-group">
                    @foreach ($topics as $topic)
                        <li class="list-group-item">
                            <a href="{{ route('topics.show', $topic->id) }}" class="text-decoration-none">
                                <h5 class="mb-1">{{ $topic->title }}</h5>
                            </a>
                            <p class="mb-1">{{ Str::limit($topic->content, 100) }}</p>
                            <small class="text-muted">{{ __('Created at') }}
                                : {{ $topic->created_at->format('Y-m-d H:i') }}</small>
                            <div class="mt-2">
                                <a href="{{ route('topics.show', $topic->id) }}" class="btn btn-primary btn-sm">
                                    {{ __('View') }}
                                </a>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
    <div class="d-flex justify-content-center">
        {{ $topics->links() }}
    </div>
    <div class="mt-3">
        <a href="{{ route('topics.create') }}" class="btn btn-success">
            {{ __('Create New Topic') }}
        </a>
    </div>
@endsection
