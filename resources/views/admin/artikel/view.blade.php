@extends('layouts.adminLayouts')

@section('container')
    <div class="flex justify-end md:mr-20">
        <div class="w-full max-w-4xl bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 mx-5">
            <h1 class="text-3xl font-bold mb-6">{{ $artikel->title }}</h1>

            <!-- Author and Published Date -->
            <div class="mb-6">
                <p class="text-gray-600 text-sm">
                    <strong>Author:</strong> {{ $artikel->author }} |
                    <strong>Published at:</strong>
                    {{ $artikel->published_at ? $artikel->published_at->format('d M Y, H:i') : 'Not Published' }} |
                    <strong>Kategori:</strong>
                    {{ $artikel->kategori_artikel->name }}
                </p>
            </div>
            <!-- Image -->
            <div class="mb-6 flex justify-center">
                <img src="{{ asset('storage/' . $artikel->image) }}" alt="{{ $artikel->title }}"
                    class="w-1/2 h-auto rounded shadow-md">
            </div>


            <!-- Body -->
            <div class="mb-6">
                <div class="text-gray-800 leading-relaxed text-justify">
                    {!! $artikel->body !!}
                </div>
            </div>

            <!-- Attachment -->
            @if ($artikel->attachment)
                <div class="mb-6">
                    <h2 class="text-xl font-semibold mb-2">Lampiran</h2>
                    <a href="{{ asset('storage/' . $artikel->attachment) }}" target="_blank"
                        class="text-blue-500 hover:underline">
                        Download Lampiran
                    </a>
                </div>
            @endif


            <!-- Back Button -->
            <div class="flex justify-end">
                <a href="/admin/artikel"
                    class="bg-primary hover:bg-secondary text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Back to Articles
                </a>
            </div>
        </div>
    </div>
@endsection
