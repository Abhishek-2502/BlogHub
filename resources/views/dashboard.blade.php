@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8">

    {{-- 🔍 Search Bar --}}
    <div class="mb-8">
        <form action="{{ route('posts.index') }}" method="GET" class="flex items-center space-x-3">
            <input type="text" name="search" placeholder="Search posts..."
                   value="{{ request('search') }}"
                   class="w-full sm:w-96 border border-gray-300 rounded-lg px-4 py-2 shadow-sm focus:ring focus:ring-blue-200" />
            <button type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition ml-4">
                <span class="inline-flex items-center space-x-1">
                    <span>🔍</span>
                    <span>Search</span>
                </span>
            </button>
        </form>
    </div>

    {{-- 📋 Heading --}}
    <h1 class="text-3xl font-extrabold text-gray-800 mb-6 mt-2 tracking-tight border-b pb-2">
        📝 My Posts
    </h1>

    @if ($posts->count())
        {{-- 🧱 Grid Layout --}}
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-2">
            @foreach ($posts as $post)
                <div class="bg-white border border-gray-200 rounded-lg shadow-sm hover:shadow-md transition duration-300 p-0 overflow-hidden flex h-full">

                    {{-- 📄 Content Area --}}
                    <div class="flex-1 p-6 flex flex-col justify-between">
                        {{-- Optional Category --}}
                        @if (!empty($post->category))
                            <span class="text-xs bg-green-100 text-green-700 px-2 py-1 rounded font-medium inline-block mb-2">
                                {{ $post->category }}
                            </span>
                        @endif

                        {{-- Title --}}
                        <h2 class="text-xl font-semibold text-blue-700 mb-1">
                            <a href="{{ route('posts.show', $post->slug) }}" class="hover:underline">
                                {{ $post->title }}
                            </a>
                        </h2>

                        {{-- Meta Info --}}
                        <p class="text-sm text-gray-500 mb-3">
                            By <span class="font-medium">{{ $post->author->name ?? 'Unknown' }}</span> • {{ $post->created_at->format('M d, Y') }}
                        </p>

                        {{-- Excerpt --}}
                        <p class="text-gray-700 text-sm leading-relaxed mb-4">
                            {{ \Illuminate\Support\Str::limit(strip_tags($post->content), 120, '...') }}
                        </p>

                        {{-- Read More & Actions --}}
                        <div class="mt-auto">
                            <a href="{{ route('posts.show', $post->slug) }}"
                               class="inline-block text-sm text-blue-600 hover:underline font-medium">
                                ➡️ Read More
                            </a>

                            @can('update', $post)
                                <div class="mt-2 flex space-x-4 text-sm">
                                    <a href="{{ route('posts.edit', $post->slug) }}"
                                       class="text-yellow-600 hover:text-yellow-700 hover:underline transition">
                                        ✏️ Edit
                                    </a>
                                    <form action="{{ route('posts.destroy', $post->slug) }}" method="POST"
                                          onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-700 hover:underline">
                                            🗑️ Delete
                                        </button>
                                    </form>
                                </div>
                            @endcan
                        </div>
                    </div>

                    {{-- 🖼️ Thumbnail --}}
                    @if ($post->image_path)
                        <div class="w-40 h-full">
                            <img src="{{ asset('storage/' . $post->image_path) }}"
                                 alt="Post Thumbnail"
                                 class="object-cover h-full w-full border-l rounded-r-lg">
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    @else
        {{-- ❌ No Posts --}}
        <div class="text-center text-gray-500 mt-16">
            <p>No posts found.</p>
            <a href="{{ route('posts.create') }}" class="text-blue-600 hover:underline">
                ➕ Create your first post
            </a>
        </div>
    @endif

    {{-- 📄 Pagination --}}
    <div class="mt-10">
        {{ $posts->links() }}
    </div>
</div>
@endsection
