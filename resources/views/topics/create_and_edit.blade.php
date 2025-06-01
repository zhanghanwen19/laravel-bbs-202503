@extends('layouts.app')

@section('title', isset($topic) ? '编辑话题' : '创建话题')

@section('content')

    <div class="container">
        <div class="col-md-10 offset-md-1">
            <div class="card ">

                <div class="card-body">
                    <h2 class="">
                        <i class="far fa-edit"></i>
                        @if ($topic->id)
                            {{ __('Edit Topic') }}
                        @else
                            {{ __('Create New Topic') }}
                        @endif
                    </h2>

                    <hr>

                    @if ($topic->id)
                        <form action="{{ route('topics.update', $topic->id) }}" method="POST" accept-charset="UTF-8">
                            @method('PUT')
                            @else
                                <form action="{{ route('topics.store') }}" method="POST" accept-charset="UTF-8">
                                    @endif
                                    @csrf

                                    @include('shared._error')

                                    <div class="mb-3">
                                        <input class="form-control" type="text" name="title"
                                               value="{{ old('title', $topic->title) }}"
                                               placeholder="{{ __('Please enter a title.') }}" required/>
                                    </div>

                                    <div class="mb-3">
                                        <select class="form-control" name="category_id" required>
                                            <option value="" hidden disabled selected>{{ __('Please select a category.') }}</option>
                                            @foreach ($categories as $value)
                                                <option value="{{ $value->id }}">{{ $value->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <textarea name="body" class="form-control" id="editor" rows="6"
                                                  placeholder="{{ __('Please enter at least 3 characters.') }}"
                                                  required>{{ old('body', $topic->body) }}</textarea>
                                    </div>

                                    <div class="well well-sm">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="far fa-save mr-2" aria-hidden="true"></i> {{ __('Save') }}
                                        </button>
                                    </div>
                                </form>
                </div>
            </div>
        </div>
    </div>

@endsection
