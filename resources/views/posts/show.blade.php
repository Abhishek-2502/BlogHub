@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-10 px-6 sm:px-10 lg:px-14">
    <h1 class="text-3xl font-bold mb-4 text-gray-900">{{ $post->title }}</h1>

    <p class="text-sm text-gray-500 mb-6">
        By {{ $post->author->name ?? 'Unknown' }} on {{ $post->created_at->format('M d, Y') }}
    </p>

    {{-- ✅ Show post image if it exists --}}
    @if ($post->image_path)
        <div class="w-full max-h-[500px] overflow-hidden rounded-lg mb-6 border border-gray-200">
            <img src="{{ asset('storage/' . $post->image_path) }}"
                 alt="Post Image"
                 class="w-full h-auto object-contain mx-auto rounded">
        </div>
    @endif

    {{-- 🔒 Edit/Delete Buttons (only if authorized) --}}
    @can('update', $post)
        <div class="mb-6 flex space-x-3">
            <a href="{{ route('posts.edit', $post->slug) }}"
               class="inline-block bg-yellow-500 text-black px-4 py-2 rounded hover:bg-yellow-600 transition">
                ✏️ Edit
            </a>

            <form action="{{ route('posts.destroy', $post->slug) }}" method="POST"
                  onsubmit="return confirm('Are you sure you want to delete this post?');">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition">
                    🗑️ Delete
                </button>
            </form>
        </div>
    @endcan

    <div class="prose max-w-none text-gray-800 leading-relaxed">
        {!! nl2br(e($post->content)) !!}
    </div>
</div>
@endsection
