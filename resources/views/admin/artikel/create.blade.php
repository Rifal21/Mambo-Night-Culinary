@extends('layouts.adminLayouts')

@section('container')
    <div class="flex justify-center mx-5">
        <form action="/admin/artikel" method="POST" enctype="multipart/form-data"
            class="w-full max-w-3xl bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf
            <h1 class="text-2xl font-bold mb-4">Create Article</h1>
            <!-- Title -->
            <div class="mb-4">
                <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Title</label>
                <input type="text" id="title" name="title"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    placeholder="Enter article title" oninput="generateSlug()" required>
            </div>

            <!-- Slug -->
            <div class="mb-4">
                <label for="slug" class="block text-gray-700 text-sm font-bold mb-2">Slug</label>
                <input type="text" id="slug" name="slug"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    placeholder="Generated slug" readonly required>
            </div>

            <!-- Kategori Artikel -->
            <div class="mb-4">
                <label for="kategori_artikel_id" class="block text-gray-700 text-sm font-bold mb-2">Category</label>
                <select id="kategori_artikel_id" name="kategori_artikel_id"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    required>
                    <option value="" disabled selected>Select category</option>
                    @foreach ($kategori as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Body -->
            <div class="mb-4">
                <label for="body" class="block text-gray-700 text-sm font-bold mb-2">Body</label>
                <input id="body" type="hidden" name="body" required>
                <trix-editor input="body"
                    class="trix-content shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </trix-editor>
            </div>

            <!-- Image -->
            <div class="mb-4">
                <label for="image" class="block text-gray-700 text-sm font-bold mb-2">Image</label>
                <input type="file" id="image" name="image"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    onchange="previewImage()" required>
                <img id="image-preview" class="mt-4 max-h-64 rounded shadow-md hidden" />
            </div>

            <!-- Author -->
            <div class="mb-4">
                <label for="author" class="block text-gray-700 text-sm font-bold mb-2">Author</label>
                <input type="text" id="author" name="author"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    placeholder="Enter author name" required>
            </div>

            <!-- Published At -->
            <div class="mb-4">
                <label for="published_at" class="block text-gray-700 text-sm font-bold mb-2">Published At</label>
                <input type="datetime-local" id="published_at" name="published_at"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <!-- Attachment -->
            <div class="mb-4">
                <label for="attachment" class="block text-gray-700 text-sm font-bold mb-2">Attachment (Optional)</label>
                <input type="file" id="attachment" name="attachment"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <p class="text-red-500 text-xs mt-1">Maksimum file size: 5MB</p>
            </div>

            <!-- Submit Button -->
            <div class="flex items-center justify-between">
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Submit
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

        function previewImage() {
            const image = document.getElementById('image').files[0];
            const preview = document.getElementById('image-preview');

            if (image) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                };
                reader.readAsDataURL(image);
            }
        }
    </script>
@endsection
