@extends('layouts.main')

@section('container')
    @include('partials.headerHome')

    <div class="container mx-auto px-4 py-8 ">
        <h1 class="text-3xl font-bold text-center mb-10 text-secondary mt-3">Semua Artikel</h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($artikels as $artikel)
                <div class="bg-white shadow-md rounded overflow-hidden hover:shadow-xl  transition-shadow duration-300">
                    <!-- Image -->
                    <img src="{{ asset('storage/' . $artikel->image) }}" alt="{{ $artikel->title }}"
                        class="w-full h-48 object-cover">

                    <!-- Content -->
                    <div class="p-4">
                        <div class="flex items-start justify-between mb-1">
                            <h2 class="text-xl font-bold mb-2 truncate">{{ $artikel->title }}</h2>
                            <span>({{ $artikel->kategori_artikel->name }})</span>
                        </div>
                        <p class="text-gray-600 text-sm mb-4 truncate">
                            {{ Str::limit(strip_tags($artikel->body), 100) }}
                        </p>
                        <div class="flex items-center justify-between text-sm text-gray-500">
                            <span>By {{ $artikel->author }}</span>
                            <span>{{ $artikel->published_at ? $artikel->published_at->format('d M Y') : 'Not Published' }}</span>
                        </div>
                    </div>

                    <!-- Read More Button -->
                    <div class="p-4">
                        <a href="/artikel/{{ $artikel->slug }}"
                            class="block bg-secondary/80 hover:bg-secondary text-white text-center font-bold py-2 px-4 rounded transition-colors duration-300">
                            Read More
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-8 flex justify-end">
            {{ $artikels->links('pagination::tailwind') }}
        </div>
    </div>
@endsection
