@extends('layouts.main')

@section('container')
    <div class="container mx-auto px-4 py-8">
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Artikel Detail -->
            <div class="w-full md:w-3/4 bg-white shadow-md rounded px-8 pt-6 pb-8">
                <h1 class="text-3xl font-bold mb-6">{{ $artikel->title }}</h1>

                <!-- Author and Published Date -->
                <div class="mb-6 text-gray-600 text-sm flex flex-wrap gap-2">
                    <p><strong>Author:</strong> {{ $artikel->author }}</p> | <p><strong>Published at:</strong>
                        {{ $artikel->published_at ? $artikel->published_at->format('d M Y, H:i') : 'Not Published' }}</p> |
                    <p><strong>Kategori:</strong> {{ $artikel->kategori_artikel->name }}</p>
                </div>

                <!-- Image -->
                <div class="mb-6 flex justify-center">
                    <img src="{{ asset('storage/' . $artikel->image) }}" alt="{{ $artikel->title }}"
                        class="md:w-1/2 w-full rounded shadow-md">
                </div>

                <!-- Body -->
                <div class="mb-6 text-gray-800 leading-relaxed text-justify">
                    {!! $artikel->body !!}
                </div>

                <!-- Attachment -->
                @if ($artikel->attachment)
                    <div class="mb-6">
                        <h2 class="text-xl font-semibold mb-2">Lampiran</h2>
                        <a href="{{ asset('storage/' . $artikel->attachment) }}" target="_blank"
                            class="text-primary hover:text-secondary hover:underline">
                            <i class="fas fa-download"></i>
                            Download Lampiran
                        </a>
                    </div>
                @endif

            </div>

            <!-- Artikel Terbaru -->
            <aside class="w-full lg:w-1/3">
                <h2 class="text-2xl font-bold mb-4">Artikel Terbaru</h2>
                <div class="space-y-4">
                    @foreach ($latestArtikel as $latest)
                        <div
                            class="flex items-start space-x-4 bg-white shadow-md rounded p-4 hover:shadow-lg transition-transform transform hover:scale-105  duration-300">
                            <img src="{{ asset('storage/' . $latest->image) }}" alt="{{ $latest->title }}"
                                class="w-16 h-16 object-cover rounded">
                            <div>
                                <h3 class="font-bold text-lg truncate">
                                    <a href="/artikel/{{ $latest->slug }}" class="text-secondary hover:underline">
                                        {{ $latest->title }}
                                    </a>
                                </h3>
                                <p class="text-sm text-gray-500">
                                    {{ $latest->published_at ? $latest->published_at->format('d M Y') : 'Not Published' }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </aside>
        </div>
    </div>
@endsection
