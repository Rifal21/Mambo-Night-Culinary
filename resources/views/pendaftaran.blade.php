@extends('layouts.main')

@section('container')
    @include('partials.headerHome')
    <div class="flex justify-center mt-5 mb-5">
        @if (session('success'))
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
        <div class="w-full md:w-1/4 mx-5 space-y-3">
            <div class="bg-white rounded-lg shadow-md p-3 flex items-center space-x-3 mb-3">
                <img src="/image/icon/pendaftaran.svg" class="material-icons" />
                <span class="font-semibold text-secondary">Pendaftaran Tenant</span>
            </div>
            <div class="bg-white w-full p-6 rounded-lg shadow-lg">
                <!-- Form -->
                <form action="/pendaftaran" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- Nama Pemilik Tenant -->
                    <div class="mb-4">
                        <label for="pemilik" class="block text-sm font-medium text-gray-700">Nama Pemilik Tenant</label>
                        <input type="text" id="pemilik" name="pemilik" placeholder="Masukkan nama pemilik tenant"
                            class="mt-1 w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-secondary focus:border-secondary" />
                    </div>
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">Nama Tenant</label>
                        <input type="text" id="name" name="name" placeholder="Masukkan nama tenant"
                            class="mt-1 w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-secondary focus:border-secondary" />
                    </div>
                    <div class="mb-4">
                        <label for="brand" class="block text-sm font-medium text-gray-700">Nama Brand</label>
                        <input type="text" id="brand" name="brand" placeholder="Masukkan nama brand"
                            class="mt-1 w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-secondary focus:border-secondary" />
                    </div>
                    <div class="mb-4">
                        <label for="ig" class="block text-sm font-medium text-gray-700">Instagram</label>
                        <input type="text" id="ig" name="ig" placeholder="Masukkan nama Instagram"
                            class="mt-1 w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-secondary focus:border-secondary" />
                    </div>
                    <div class="mb-4">
                        <label for="tt" class="block text-sm font-medium text-gray-700">Tiktok</label>
                        <input type="text" id="tt" name="tt" placeholder="Masukkan nama Tiktok"
                            class="mt-1 w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-secondary focus:border-secondary" />
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" id="email" name="email" placeholder="contoh@gmail.com"
                            class="mt-1 w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-secondary focus:border-secondary" />
                    </div>
                    <div class="mb-4">
                        <label for="phone" class="block text-sm font-medium text-gray-700">No. Telepon</label>
                        <input type="tel" id="phone" name="phone" placeholder="628xxxxxxx"
                            class="mt-1 w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-secondary focus:border-secondary" />
                    </div>
                    <div class="mb-4">
                        <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
                        <input type="text" id="alamat" name="alamat" placeholder="Masukan Alamat Lengkap"
                            class="mt-1 w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-secondary focus:border-secondary" />
                    </div>
                    <div class="mb-4 hidden">
                        <label for="alamat" class="block text-sm font-medium text-gray-700">Status</label>
                        <input type="hidden" id="status" name="status" value="0"
                            class="mt-1 w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-secondary focus:border-secondary" />
                    </div>
                    <div class="mb-4">
                        <label for="fileimage" class="block text-sm font-medium text-gray-700">Upload File</label>
                        <input type="file" id="fileimage" name="fileimage" placeholder=""
                            class="mt-1 w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-secondary focus:border-secondary"
                            onchange="previewFile()" />
                        <div id="filePreview" class="mt-3"></div>
                    </div>
                    <div class="mb-4">
                        <label for="asli" class="block text-sm font-medium text-gray-700 mb-1">Apakah tinggal di kota
                            Tasikmalaya?</label>
                        <div class="flex items-center space-x-4">
                            <!-- Pilihan Ya -->
                            <label class="inline-flex items-center">
                                <input type="radio" id="alamat-ya" name="asli" value="ya"
                                    class="form-radio h-4 w-4 text-secondary border-gray-300 focus:ring-secondary">
                                <span class="ml-2 text-gray-700">Ya</span>
                            </label>

                            <!-- Pilihan Tidak -->
                            <label class="inline-flex items-center">
                                <input type="radio" id="alamat-tidak" name="asli" value="tidak"
                                    class="form-radio h-4 w-4 text-secondary border-gray-300 focus:ring-secondary">
                                <span class="ml-2 text-gray-700">Tidak</span>
                            </label>
                        </div>
                    </div>


                    <!-- Jenis Makanan -->
                    <div class="mb-4">
                        <label for="id_kategori" class="block text-sm font-medium text-gray-700">Jenis Makanan</label>
                        <select id="id_kategori" name="id_kategori"
                            class="mt-1 w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-secondary focus:border-secondary">
                            <option selected>Pilih Jenis Makanan</option>
                            @foreach ($kategoriAll as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Kisaran Harga -->
                    <div class="mb-4">
                        <label for="priceRange" class="block text-sm font-medium text-gray-700">Kisaran Harga</label>
                        <div class="flex items-center justify-between text-sm text-gray-700 mb-1">
                            <span>Rp.0</span>
                            <span>Rp.100.000</span>
                        </div>
                        <input type="range" id="priceRange" name="priceRange" min="0" max="100000"
                            value="0"
                            class="w-full h-2 bg-gray-200 rounded-lg appearance-none focus:outline-none focus:ring-1 focus:ring-secondary accent-secondary">
                        <p class="text-xs text-gray-500 mt-1">Harga satuan: Rp.<span id="priceValue">0</span></p>
                    </div>



                    <!-- Submit Button -->
                    <button type="submit"
                        class="w-full py-2 mt-2 bg-secondary text-white font-semibold rounded-lg shadow hover:bg-brown-600 focus:outline-none focus:ring-2 focus:ring-brown-400">
                        Daftar
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Update displayed price as the range slider moves
        const priceRange = document.getElementById('priceRange');
        const priceValue = document.getElementById('priceValue');

        priceRange.addEventListener('input', function() {
            // Format the number as currency with thousands separator
            priceValue.textContent = new Intl.NumberFormat('id-ID').format(priceRange.value);
        });

        document.addEventListener("DOMContentLoaded", function() {
            const successMessage = document.getElementById('successMessage');

            if (successMessage) {
                // Wait for 3 seconds, then fade out
                setTimeout(() => {
                    successMessage.classList.add('opacity-0'); // Add fade-out class
                    setTimeout(() => successMessage.remove(), 300); // Remove the element after fading out
                }, 3000); // 3000ms = 3 seconds
            }
        });

        function previewFile() {
            const fileInput = document.getElementById('fileimage');
            const filePreview = document.getElementById('filePreview');
            const file = fileInput.files[0];

            // Reset preview
            filePreview.innerHTML = '';

            if (file) {
                const fileType = file.type;

                // Preview for images
                if (fileType.includes('image')) {
                    const imgPreview = document.createElement('img');
                    imgPreview.src = URL.createObjectURL(file);
                    imgPreview.alt = 'Image Preview';
                    imgPreview.classList.add('w-full', 'h-auto', 'rounded-md', 'mt-2');
                    filePreview.appendChild(imgPreview);

                    // Preview for PDFs
                } else if (fileType === 'application/pdf') {
                    const pdfPreview = document.createElement('iframe');
                    pdfPreview.src = URL.createObjectURL(file);
                    pdfPreview.width = '100%';
                    pdfPreview.height = '500px';
                    pdfPreview.classList.add('mt-2');
                    filePreview.appendChild(pdfPreview);

                    // Placeholder message for .docx files or unsupported file types
                } else if (fileType === 'application/vnd.openxmlformats-officedocument.wordprocessingml.document' ||
                    fileType === 'application/msword') {
                    const docPreview = document.createElement('p');
                    docPreview.textContent = 'File .docx telah diunggah. Pratinjau tidak tersedia.';
                    docPreview.classList.add('text-gray-700', 'italic', 'mt-2');
                    filePreview.appendChild(docPreview);

                    // Unsupported file type
                } else {
                    const unsupportedPreview = document.createElement('p');
                    unsupportedPreview.textContent = 'Format file tidak didukung untuk pratinjau.';
                    unsupportedPreview.classList.add('text-red-500', 'italic', 'mt-2');
                    filePreview.appendChild(unsupportedPreview);
                }
            }
        }
    </script>

    <style>
        /* Customize the range thumb to match the secondary color */
        input[type="range"]::-webkit-slider-thumb {
            appearance: none;
            height: 1rem;
            width: 1rem;
            background-color: #b5651d;
            /* Replace with your secondary color */
            border-radius: 50%;
            cursor: pointer;
        }

        input[type="range"]::-moz-range-thumb {
            height: 1rem;
            width: 1rem;
            background-color: #b5651d;
            /* Replace with your secondary color */
            border-radius: 50%;
            cursor: pointer;
        }

        /* Range thumb hover effect */
        input[type="range"]:hover::-webkit-slider-thumb,
        input[type="range"]:hover::-moz-range-thumb {
            background-color: #a0541c;
            /* Darker shade for hover */
        }
    </style>
@endSection
