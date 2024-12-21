@extends('layouts.adminLayouts')

@section('container')
    @if (session()->has('success'))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    icon: 'success',
                    title: '{{ session('success') }}',
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true,
                    customClass: {
                        popup: 'colored-toast'
                    }
                }).then(() => {
                    // Redirect to WhatsApp after toast message
                    const whatsappLink = "{{ session('whatsappLink') }}";
                    if (whatsappLink) {
                        window.location.href = whatsappLink;
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
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true,
                    customClass: {
                        popup: 'colored-toast'
                    }
                }).then(() => {
                    // Redirect to WhatsApp after toast message
                    const whatsappLink = "{{ session('whatsappLink') }}";
                    if (whatsappLink) {
                        window.location.href = whatsappLink;
                    }
                });
            });
        </script>
    @endif

    <div class="p-3 max-w-md md:max-w-[80%] md:ml-64 overflow-hidden">
        <!-- Title -->
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-bold text-gray-700 border-b-2 border-secondary">Pendaftaran Tenant</h2>
        </div>

        <div class="overflow-x-auto">
            <!-- Table -->
            <table class="w-full bg-white rounded-lg shadow-lg overflow-x-auto">
                <thead>
                    <tr class="bg-gray-100 text-gray-600 text-xs leading-normal text-center">
                        <th class="py-3 px-4 ">Nama Pemilik Tenant</th>
                        <th class="py-3 px-4 ">Nama Tenant</th>
                        <th class="py-3 px-4 ">Nama Brand</th>
                        <th class="py-3 px-4 ">Nama Instagram</th>
                        <th class="py-3 px-4 ">Nama Tiktok</th>
                        <th class="py-3 px-4 ">No. Telepon</th>
                        <th class="py-3 px-4 ">Email</th>
                        <th class="py-3 px-4 ">Tinggal di Kota Tasikmalaya</th>
                        <th class="py-3 px-4 ">Kisaran Harga</th>
                        <th class="py-3 px-4 ">Jenis Makanan</th>
                        <th class="py-3 px-4 ">Alamat</th>
                        <th class="py-3 px-4 ">File</th>
                        <th class="py-3 px-4 ">Status</th>
                        <th class="py-3 px-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700 text-sm">
                    @foreach ($pendaftaran as $item)
                        <tr class="border-b border-gray-200 hover:bg-gray-100 text-center">
                            <td class="py-3 px-4">{{ $item->pemilik }}</td>
                            <td class="py-3 px-4">{{ $item->name }}</td>
                            <td class="py-3 px-4">{{ $item->brand }}</td>
                            <td class="py-3 px-4">{{ $item->ig }}</td>
                            <td class="py-3 px-4">{{ $item->tt }}</td>
                            <td class="py-3 px-4">{{ $item->phone }}</td>
                            <td class="py-3 px-4">{{ $item->email }}</td>
                            <td class="py-3 px-4">{{ $item->asli }}</td>
                            <td class="py-3 px-4">Rp. {{ number_format($item->priceRange, 0, ',', '.') }}</td>
                            <td class="py-3 px-4">
                                {{ $item->kategori ? $item->kategori->name : 'N/A' }}
                            </td>
                            <td class="py-3 px-4">{{ $item->alamat }}</td>
                            <td class="py-3 px-4">
                                @if ($item->fileimage)
                                    @php
                                        $fileExtension = pathinfo($item->fileimage, PATHINFO_EXTENSION);
                                    @endphp

                                    @if (in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png', 'gif']))
                                        <!-- Jika file adalah gambar, tampilkan preview gambar -->
                                        <img src="{{ asset('storage/' . $item->fileimage) }}" alt="Preview"
                                            class="w-16 h-16 object-cover rounded-md">
                                    @elseif ($fileExtension === 'pdf')
                                        <!-- Jika file adalah PDF, tampilkan ikon PDF -->
                                        <a href="{{ Storage::url($item->fileimage) }}" target="_blank">
                                            <img src="/image/icon/pdf.png" alt="PDF File" class="w-8 h-8 mx-auto">
                                        </a>
                                    @elseif (in_array($fileExtension, ['doc', 'docx']))
                                        <!-- Jika file adalah DOC atau DOCX, tampilkan ikon DOC -->
                                        <a href="{{ Storage::url($item->fileimage) }}" target="_blank">
                                            <img src="/image/icon/word.png" alt="DOC File" class="w-8 h-8 mx-auto">
                                        </a>
                                    @else
                                        <!-- Tampilkan teks atau ikon file jika format tidak dikenali -->
                                        <span class="text-gray-500">File Tidak Dikenal</span>
                                    @endif
                                @else
                                    <span class="text-gray-500">Tidak ada file</span>
                                @endif
                            </td>
                            <td class="py-3 px-4">
                                {{ $item->status === 0 ? 'Belum Verifikasi' : ($item->status === 1 ? 'Sudah Verifikasi' : 'Ditolak') }}
                            </td>
                            @if ($item->status === 0)
                                <td class="py-3 px-4 text-center space-x-2 flex">
                                    <a href="{{ route('pendaftaran.verifikasi', $item->id) }}"
                                        class="text-white bg-green-500 p-2 rounded-lg ">
                                        <i class="fas fa-check"></i> <span class="hidden sm:inline">Verifikasi</span>
                                    </a>
                                    <a href="{{ route('pendaftaran.tolak', $item->id) }}"
                                        class="text-white bg-red-500 p-2 rounded-lg">
                                        <i class="fas fa-times"></i> <span class="hidden sm:inline">Tolak</span>
                                    </a>
                                </td>
                            @else
                                <td class="py-3 px-4 text-center space-x-2 flex justify-center items-center">
                                    <a href="{{ route('pendaftaran.download', $item->id) }}"
                                        class="text-white bg-secondary p-2 rounded-lg">
                                        <i class="fas fa-download"></i> <span class="hidden sm:inline">Download</span>
                                    </a>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>

        {{-- Pagination --}}
        <div class="flex justify-end mt-4">
            {{ $pendaftaran->links() }}
        </div>
    </div>
@endsection
