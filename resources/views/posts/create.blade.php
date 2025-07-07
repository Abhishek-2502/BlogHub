@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-10 px-6">
    <h1 class="text-2xl font-bold mb-6">Create New Post</h1>

    @if ($errors->any())
        <div class="mb-4 text-red-500">
            <ul class="list-disc ml-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label for="title" class="block font-medium">Title</label>
            <input type="text" name="title" id="title"
                   class="w-full border border-gray-300 px-4 py-2 rounded mt-1"
                   value="{{ old('title') }}" required>
        </div>

        <div class="mb-4">
            <label for="content" class="block font-medium">Content</label>
            <textarea name="content" id="content" rows="6"
                      class="w-full border border-gray-300 px-4 py-2 rounded mt-1"
                      required>{{ old('content') }}</textarea>
        </div>

        <div class="mb-6">
            <label for="image" class="block font-medium mb-2">Post Image (optional)</label>
            <input type="file" name="image" id="image"
                   accept="image/*"
                   class="block w-full text-sm text-gray-700 file:mr-4 file:py-2 file:px-4
                          file:rounded file:border-0 file:text-sm file:font-semibold
                          file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">

            {{-- ✅ Image preview --}}
            <div class="mt-4">
                <img id="imagePreview" class="w-full max-h-64 object-contain rounded shadow" style="display: none;">
            </div>
        </div>

        <button type="submit"
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Publish Post
        </button>
    </form>
</div>

{{-- ✅ JavaScript for preview --}}
<script>
    document.getElementById('image').addEventListener('change', function (e) {
        const preview = document.getElementById('imagePreview');
        const file = e.target.files[0];

        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        } else {
            preview.style.display = 'none';
            preview.src = '';
        }
    });
</script>
@endsection
