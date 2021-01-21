@extends('layout')

@section('head')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.1/css/bulma.min.css">
@endsection

@section('content')
    <div id="wrapper">
        <div id="page" class="container">
            <h1 class="heading has-text-weight-bold is-size-4">New Article</h1>

            <form method="POST" action= "{{ route('articles.store') }}">
                @csrf

                <div class="field">
                    <label class="label" for="title">Title</label>

                    <div class="control">
                        <input 
                            class="input {{ $errors->has('title') ? 'is-danger' : '' }}" 
                            type="text" 
                            name="title" 
                            id="title"
                            value=" {{ old('title') }}">

                        @error('title')
                            <p class="help is-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="field">
                    <label class="label" for="excerpt">Excerpt</label>

                    <div class="control">
                        <textarea 
                            class="textarea {{ $errors->has('excerpt') ? 'is-danger' : '' }}" 
                            type="text" 
                            name="excerpt" 
                            id="excerpt"
                            value=" {{ old('excerpt') }}"></textarea>
                    
                        @error('excerpt')
                            <p class="help is-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="field">
                    <label class="label" for="body">Body</label>

                    <div class="control">
                        <textarea 
                            class="textarea {{ $errors->has('body') ? 'is-danger' : '' }}" 
                            type="text" 
                            name="body" 
                            id="body"
                            value=" {{ old('body') }}"></textarea>
                    
                        @error('body')
                            <p class="help is-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="field">
                    <label class="label" for="tags">Tags</label>

                    <div class="select is-multiple control">
                        <select 
                            name="tags[]" 
                            multiple
                        >
                            @foreach ($tags as $tag)
                                <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                            @endforeach
                        </select>

                        @error('tags')
                            <p class="help is-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="field is-grouped">
                    <div class="control">
                        <button class="button is-link" type="submit">Submit</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection
