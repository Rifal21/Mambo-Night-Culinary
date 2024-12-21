@extends('layouts.adminLayouts')

@section('container')
    @if (session()->has('success'))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    icon: 'success',
                    title: '{{ session('success') }}',
                    toast: true, // Enable toast style
                    position: 'top-end', // Position at the top-right corner
                    showConfirmButton: false,
                    timer: 5000, // Display for 3 seconds
                    timerProgressBar: true, // Show progress bar during the timer
                    customClass: {
                        popup: 'colored-toast' // Optional: Add custom styling class if needed
                    }
                });
            });
        </script>
    @endif

    @if (session()->has('loginError'))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    icon: 'error',
                    title: '{{ session('loginError') }}',
                    toast: true, // Enable toast style
                    position: 'top-end', // Position at the top-right corner
                    showConfirmButton: false,
                    timer: 5000, // Display for 3 seconds
                    timerProgressBar: true, // Show progress bar during the timer
                    customClass: {
                        popup: 'colored-toast' // Optional: Add custom styling class if needed
                    }
                });
            });
        </script>
    @endif

    <div class="p-6 max-w-md md:max-w-[75%] md:ml-72 bg-[#F8F8F8] rounded-lg shadow-xl">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-bold text-gray-700 border-b-2 border-secondary">Artikel</h2>
            <a href="/admin/artikel/create" class="bg-green-500 hover:bg-green-600 text-white p-2 rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d=" M12 4v16m8-8H4" />
                </svg>
            </a>
        </div>

        <ul class="space-y-2">
            @foreach ($artikel as $item)
                <li
                    class="flex justify-between items-center hover:bg-transparent hover:shadow-lg w-full p-2 rounded-lg cursor-pointer transform hover:scale-105 transition-transform">
                    <div class="flex items-center">
                        <span class="w-1 h-6 bg-secondary mr-2"></span>
                        <span class="text-gray-700">{{ $item->title }}</span>
                    </div>
                    <div class="flex space-x-6">
                        <a href="/admin/artikel/{{ $item->id }}/edit" class="text-blue-500 hover:text-blue-600">
                            <i class="fas fa-pen"></i>
                        </a>
                        <a href="/admin/artikel/{{ $item->id }}" class="text-yellow-500 hover:text-yellow-600">
                            <i class="fas fa-eye"></i>
                        </a>
                        <form action="/admin/artikel/{{ $item->id }}" method="POST" class="d-inline">
                            @method('DELETE')
                            @csrf
                            <button class="text-red-500 hover:text-red-600" onclick="return confirm('Are you sure?')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>

        <div class="flex justify-center mt-4">
            {{ $artikel->links() }}
        </div>
    </div>

    <div id="modalCreateKategori" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center hidden">
        <div class="bg-white rounded-lg shadow-lg w-80 max-h-[70vh] p-6 relative">
            <button onclick="closeModalCreateKategori()" class="absolute top-2 right-2 text-red-500 hover:text-red-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M10 8.586L4.293 2.879A1 1 0 102.879 4.293L8.586 10l-5.707 5.707a1 1 0 101.414 1.414L10 11.414l5.707 5.707a1 1 0 001.414-1.414L11.414 10l5.707-5.707a1 1 0 00-1.414-1.414L10 8.586z"
                        clip-rule="evenodd" />
                </svg>
            </button>
            <h2 class="text-xl font-bold text-center mb-4">Tambah Kategori Artikel</h2>
            <div class="overflow-y-auto no-scrollbar ">
                <form action="/admin/kategori-artikel" method="POST" enctype="multipart/form-data">
                    @csrf
                    <label class="block text-gray-700 mb-2">Nama Kategori</label>
                    <input type="text" name="name" class="border w-full px-3 py-2 rounded-lg mb-4"
                        placeholder="Nama Kategori" required>
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg w-full">Simpan</button>
                </form>
            </div>
        </div>
    </div>

    <div id="modalviewkategori" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center hidden">
        <div class="bg-white rounded-lg shadow-lg w-80 p-6 relative">
            <button onclick="closeModalViewKategori()" class="absolute top-2 right-2 text-red-500 hover:text-red-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M10 8.586L4.293 2.879A1 1 0 102.879 4.293L8.586 10l-5.707 5.707a1 1 0 101.414 1.414L10 11.414l5.707 5.707a1 1 0 001.414-1.414L11.414 10l5.707-5.707a1 1 0 00-1.414-1.414L10 8.586z"
                        clip-rule="evenodd" />
                </svg>
            </button>
            <h2 class="text-xl font-bold text-center mb-4">Preview Kategori</h2>
            <div class="overflow-y-auto no-scrollbar ">
                <h2 id="nameImageKategori" class="text-xl font-normal text-center mb-4"></h2>
            </div>
        </div>
    </div>

    <div id="modalUpdateKategori" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center hidden">
        <div class="bg-white rounded-lg shadow-lg w-80 max-h-[70vh] p-6 relative">
            <button onclick="closeModalUpdateKategori()" class="absolute top-2 right-2 text-red-500 hover:text-red-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M10 8.586L4.293 2.879A1 1 0 102.879 4.293L8.586 10l-5.707 5.707a1 1 0 101.414 1.414L10 11.414l5.707 5.707a1 1 0 001.414-1.414L11.414 10l5.707-5.707a1 1 0 00-1.414-1.414L10 8.586z"
                        clip-rule="evenodd" />
                </svg>
            </button>
            <h2 class="text-xl font-bold text-center mb-4">Update Kategori Makanan</h2>
            <div class="overflow-y-auto no-scrollbar ">
                <form action="" method="POST" enctype="multipart/form-data" id="updateForm">
                    @csrf
                    @method('PUT')
                    <label class="block text-gray-700 mb-2">Nama Kategori</label>
                    <input type="text" name="name" id="updateNameKategori"
                        class="border w-full px-3 py-2 rounded-lg mb-4" required>
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg w-full">Update</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openModalCreateKategori() {
            document.getElementById("modalCreateKategori").classList.remove("hidden");
        }

        function openModalViewKategori(item) {
            const modalImage = document.getElementById("modalImageKategori");
            const nameImage = document.getElementById("nameImageKategori");
            modalImage.src = item.gambar ? `/storage/${item.gambar}` : 'path/to/placeholder-image.jpg';
            nameImage.innerHTML = "Kategori : " + item.name;
            document.getElementById("modalviewkategori").classList.remove("hidden");
        }

        function closeModalCreateKategori() {
            document.getElementById("modalCreateKategori").classList.add("hidden");
        }

        function closeModalViewKategori() {
            document.getElementById("modalviewkategori").classList.add("hidden");
        }


        function openModalUpdateKategori(item) {
            const modal = document.getElementById("modalUpdateKategori");
            const updateForm = document.getElementById("updateForm");
            const updateName = document.getElementById("updateNameKategori");
            updateForm.action = `/admin/kategori-artikel/${item.id}`;
            updateName.value = item.name;
            modal.classList.remove("hidden");
        }

        function closeModalUpdateKategori() {
            document.getElementById("modalUpdateKategori").classList.add("hidden");
        }
    </script>
@endSection
