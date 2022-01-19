@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Create New Post</h1>
    </div>
    <div class="col-lg-8">
    <form method="post" action="/dashboard/posts">
        @csrf
        <div class="mb-3">
            <label for="title" class="from-label">Title</label>
            <input type="title" class="form-control" id="title" name="title">
        </div>
        <div class="mb-3">
            <label for="slug" class="from-label">Slug</label>
            <input type="slug" class="form-control" id="slug" name="slug" disable readonly>
        </div>
        <div class="mb-3">
            <label for="category" class="from-label">Category</label>
            <select class="form-select" name="category_id">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
                 </div>
        <div>
        <label for="body" class="from-label">Body</label>
            <input id="body" type="hidden" name="body">
            <trix-editor input="body"></trix-editor>
            <label></label>
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
    </div>

    <script>
        {{--JAVASCRIPT untuk menjalankan slug--}}
        const title = document.querySelector('#title');
        const slug = document.querySelector('#slug');

        title.addEventListener ('change', function() {
            fetch('/dashboard/posts/checkSlug?title=' + title.value)
                .then (response => response.json())
                .then (data => slug.value = data.slug)

        });

        // JAVASCRIPT untuk menghilangkan fungsi tambah file
        document.addEventListener('trix-file-accept', function (e){
            e.preventDefault();
        })
    </script>
@endsection
