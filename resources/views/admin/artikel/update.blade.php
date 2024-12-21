@extends('layouts.adminLayouts')

@section('container')
    <div class="flex justify-center mx-5">
        <form action="/admin/artikel/{{ $artikel->id }}" method="POST" enctype="multipart/form-data"
            class="w-full max-w-3xl bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf
            @method('PUT')
            <h1 class="text-2xl font-bold mb-4">Edit Article</h1>

            <!-- Title -->
            <div class="mb-4">
                <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Title</label>
                <input type="text" id="title" name="title" value="{{ old('title', $artikel->title) }}"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    placeholder="Enter article title" oninput="generateSlug()" required>
            </div>

            <!-- Slug -->
            <div class="mb-4">
                <label for="slug" class="block text-gray-700 text-sm font-bold mb-2">Slug</label>
                <input type="text" id="slug" name="slug" value="{{ old('slug', $artikel->slug) }}"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    placeholder="Generated slug" readonly required>
            </div>

            <!-- Kategori Artikel -->
            <div class="mb-4">
                <label for="kategori_artikel_id" class="block text-gray-700 text-sm font-bold mb-2">Category</label>
                <select id="kategori_artikel_id" name="kategori_artikel_id"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    required>
                    <option value="" disabled>Select category</option>
                    @foreach ($kategori as $category)
                        <option value="{{ $category->id }}"
                            {{ $category->id == $artikel->kategori_artikel_id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Body -->
            <div class="mb-4">
                <label for="body" class="block text-gray-700 text-sm font-bold mb-2">Body</label>
                <input id="body" type="hidden" name="body" value="{{ old('body', $artikel->body) }}" required>
                <trix-editor input="body"
                    class="trix-content shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </trix-editor>
            </div>

            <!-- Image -->
            <div class="mb-4">
                <label for="image" class="block text-gray-700 text-sm font-bold mb-2">Image</label>
                <input type="file" id="image" name="image"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @if ($artikel->image)
                    <div class="mt-4">
                        <img src="{{ asset('storage/' . $artikel->image) }}" alt="Current Image"
                            class="w-48 rounded shadow-md">
                    </div>
                @endif
            </div>

            <!-- Attachment -->
            <div class="mb-4">
                <label for="attachment" class="block text-gray-700 text-sm font-bold mb-2">Attachment (Optional)</label>
                <input type="file" id="attachment" name="attachment"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @if ($artikel->attachment)
                    <div class="mt-4">
                        <a href="{{ asset('storage/' . $artikel->attachment) }}" target="_blank"
                            class="text-blue-500 hover:underline">View Current Attachment</a>
                    </div>
                @endif
            </div>

            <!-- Author -->
            <div class="mb-4">
                <label for="author" class="block text-gray-700 text-sm font-bold mb-2">Author</label>
                <input type="text" id="author" name="author" value="{{ old('author', $artikel->author) }}"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    placeholder="Enter author name" required>
            </div>

            <!-- Published At -->
            <div class="mb-4">
                <label for="published_at" class="block text-gray-700 text-sm font-bold mb-2">Published At</label>
                <input type="datetime-local" id="published_at" name="published_at"
                    value="{{ old('published_at', $artikel->published_at ? $artikel->published_at->format('Y-m-d\TH:i') : '') }}"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <!-- Submit Button -->
            <div class="flex items-center justify-end gap-3">
                <a href="/admin/artikel"
                    class="bg-slate-500 hover:bg-slate-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Kembali
                </a>
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Update
                </button>
            </div>
        </form>
    </div>

    <!-- Script for slug generation -->
    <script>
        function generateSlug() {
            const title = document.getElementById('title').value;
            const slug = title.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '');
            document.getElementById('slug').value = slug;
        }
    </script>
@endsection
