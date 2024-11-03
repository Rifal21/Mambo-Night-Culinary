@extends('layouts.adminLayouts')

@section('container')

@if (session()->has('success'))
<script>
  document.addEventListener("DOMContentLoaded", function() {
    Swal.fire({
      icon: 'success',
      title: '{{ session("success") }}',
      toast: true,                // Enable toast style
      position: 'top-end',        // Position at the top-right corner
      showConfirmButton: false,
      timer: 5000,                // Display for 3 seconds
      timerProgressBar: true,     // Show progress bar during the timer
      customClass: {
        popup: 'colored-toast'    // Optional: Add custom styling class if needed
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
      title: '{{ session("loginError") }}',
      toast: true,                // Enable toast style
      position: 'top-end',        // Position at the top-right corner
      showConfirmButton: false,
      timer: 5000,                // Display for 3 seconds
      timerProgressBar: true,     // Show progress bar during the timer
      customClass: {
        popup: 'colored-toast'    // Optional: Add custom styling class if needed
      }
    });
  });
</script>
@endif


<div class="p-6 max-w-md md:max-w-[75%] md:ml-72 bg-[#F8F8F8] rounded-lg shadow-xl">
  <!-- Title -->
  <div class="flex justify-between items-center mb-4">
      <h2 class="text-lg font-bold text-gray-700 border-b-2 border-secondary">Slider</h2>
      <button class="bg-green-500 hover:bg-green-600 text-white p-2 rounded-lg" onclick="openModal()">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
          </svg>
      </button>
  </div>

  <!-- Slider Items -->
  <ul class="space-y-2">
    @foreach ($banner as $item)
      
    <li class="flex justify-between items-center hover:bg-transparent hover:shadow-lg w-full p-2 rounded-lg cursor-pointer transform hover:scale-105 transition-transform" onclick="openModalView({{ json_encode($item) }})">
        <div class="flex items-center">
            <span class="w-1 h-6 bg-secondary mr-2"></span>
            <span class="text-gray-700">@if($item->banner) Slider {{ $loop->iteration }} @endif </span>
        </div>
        <div class="flex space-x-6">
          <button class="text-blue-500 hover:text-blue-600" onclick="openModalUpdate({{ json_encode($item) }})">
            <i class="fas fa-pen"></i>
        </button>
            <button class="text-yellow-500 hover:text-yellow-600" onclick="openModalView({{ json_encode($item) }})">
                <i class="fas fa-eye"></i>
            </button>
            <form action="/admin/dashboard/{{ $item->id }}" method="POST" class="d-inline">
              @method('DELETE')
              @csrf
              <button type="submit" class="text-red-500 hover:text-red-600" onclick="return confirm('Are you sure?')">
                  <i class="fas fa-trash"></i>
              </button>
            </form>
        </div>
    </li>
    @endforeach
      <!-- Repeat for more slider items -->
  </ul>

  <!-- Load More Button -->
  <div class="flex justify-center mt-4">
    {{ $banner->links() }}
      {{-- <button class="border border-dashed border-secondary text-secondary px-4 py-1 rounded-md hover:bg-secondary hover:text-white transition">
          Load More
      </button> --}}
  </div>
</div>


 <!-- Modal create -->
 <div id="modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center hidden">
  <div class="bg-white rounded-lg shadow-lg w-80 p-6 relative">
      <button onclick="closeModal()" class="absolute top-2 right-2 text-red-500 hover:text-red-600">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M10 8.586L4.293 2.879A1 1 0 102.879 4.293L8.586 10l-5.707 5.707a1 1 0 101.414 1.414L10 11.414l5.707 5.707a1 1 0 001.414-1.414L11.414 10l5.707-5.707a1 1 0 00-1.414-1.414L10 8.586z" clip-rule="evenodd" />
          </svg>
      </button>
      <h2 class="text-xl font-bold text-center mb-4">Tambah Slider</h2>
      <form action="/admin/dashboard" method="POST" enctype="multipart/form-data">
          @csrf
          <label class="block text-gray-700 mb-2">Gambar</label>
          <input type="file" name="banner" id="banner" class="border border-gray-300 p-2 w-full mb-4" onchange="previewImage(event)"/>

          <div id="imagePreview" class="w-full h-40 bg-gray-100 rounded-lg flex justify-center items-center overflow-hidden mb-4">
              <span class="text-gray-500">No Image Selected</span>
          </div>

          <button type="submit" class="w-full bg-green-500 hover:bg-green-600 text-white font-medium rounded-lg px-4 py-2">
              Tambah
          </button>
      </form>
  </div>
</div>

 <!-- Modal View -->
<div id="modalview" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center hidden">
  <div class="bg-white rounded-lg shadow-lg w-80 p-6 relative">
      <button onclick="closeModalView()" class="absolute top-2 right-2 text-red-500 hover:text-red-600">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M10 8.586L4.293 2.879A1 1 0 102.879 4.293L8.586 10l-5.707 5.707a1 1 0 101.414 1.414L10 11.414l5.707 5.707a1 1 0 001.414-1.414L11.414 10l5.707-5.707a1 1 0 00-1.414-1.414L10 8.586z" clip-rule="evenodd" />
          </svg>
      </button>
      <h2 class="text-xl font-bold text-center mb-4">Preview Slider</h2>
      <!-- Image Preview Area -->
      <div id="modalImageContainer" class="flex justify-center items-center">
          <img id="modalImage" src="" alt="Slider Image" class="w-full h-auto rounded-lg" />
      </div>
  </div>
</div>

<!-- Modal Update -->
<div id="modalUpdate" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center hidden">
  <div class="bg-white rounded-lg shadow-lg w-80 p-6 relative">
      <button onclick="closeModalUpdate()" class="absolute top-2 right-2 text-red-500 hover:text-red-600">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M10 8.586L4.293 2.879A1 1 0 102.879 4.293L8.586 10l-5.707 5.707a1 1 0 101.414 1.414L10 11.414l5.707 5.707a1 1 0 001.414-1.414L11.414 10l5.707-5.707a1 1 0 00-1.414-1.414L10 8.586z" clip-rule="evenodd" />
      </svg>
      </button>
      <h2 class="text-xl font-bold text-center mb-4">Update Tenant</h2>
      <form action="" method="POST" enctype="multipart/form-data" id="updateForm">
          @csrf
          @method('PUT')
          <label class="block text-gray-700 mb-2">Gambar</label>
          <input type="file" name="banner" id="updateGambar" class="border border-gray-300 p-2 w-full mb-4" onchange="previewUpdateImage(event)" />

          <div id="updateImagePreview" class="w-full h-40 bg-gray-100 rounded-lg flex justify-center items-center overflow-hidden mb-4">
              <span class="text-gray-500">No Image Selected</span>
          </div>

          <button type="submit" class="w-full bg-green-500 hover:bg-green-600 text-white font-medium rounded-lg px-4 py-2">
              Update
          </button>
      </form>
  </div>
</div>

</div>

<script>
function openModal() {
  document.getElementById("modal").classList.remove("hidden");
}
function openModalView(item) {
    // Set the image source for the modal image element
    const modalImage = document.getElementById("modalImage");
    modalImage.src = item.banner ? `/storage/${item.banner}` : 'path/to/placeholder-image.jpg'; // Use a placeholder if no image

    // Show the modal
    document.getElementById("modalview").classList.remove("hidden");
}

function closeModal() {
  document.getElementById("modal").classList.add("hidden");
}
function closeModalView() {
  document.getElementById("modalview").classList.add("hidden");
}

function previewImage(event) {
        const imagePreview = document.getElementById('imagePreview');
        const file = event.target.files[0];

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.innerHTML = `<img src="${e.target.result}" class="w-full h-full object-cover rounded-lg" />`;
            }
            reader.readAsDataURL(file);
        } else {
            imagePreview.innerHTML = '<span class="text-gray-500">No Image Selected</span>';
        }
  }

  function openModalUpdate(item) {
    const modal = document.getElementById("modalUpdate");
    const updateForm = document.getElementById("updateForm");
    const updateImagePreview = document.getElementById("updateImagePreview");

    // Set form action to update route
    updateForm.action = `/admin/dashboard/${item.id}`;

    if (item.banner) {
        updateImagePreview.innerHTML = `<img src="/storage/${item.banner}" class="w-full h-full object-cover rounded-lg" />`;
    } else {
        updateImagePreview.innerHTML = '<span class="text-gray-500">No Image Selected</span>';
    }

    // Show modal
    modal.classList.remove("hidden");
}

function closeModalUpdate() {
  document.getElementById("modalUpdate").classList.add("hidden");
}

function previewUpdateImage(event) {
    const updateImagePreview = document.getElementById('updateImagePreview');
    const file = event.target.files[0];

    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            updateImagePreview.innerHTML = `<img src="${e.target.result}" class="w-full h-full object-cover rounded-lg" />`;
        }
        reader.readAsDataURL(file);
    } else {
        updateImagePreview.innerHTML = '<span class="text-gray-500">No Image Selected</span>';
    }
}

</script>

@endSection