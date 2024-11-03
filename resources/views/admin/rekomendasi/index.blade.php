@extends('layouts.adminLayouts')

@section('container')
<div class="p-6 max-w-md md:max-w-[75%] md:ml-72 bg-[#F8F8F8] rounded-lg shadow-xl mt-5">
  <!-- Title -->
  <div class="flex justify-between items-center mb-4">
      <h2 class="text-lg font-bold text-gray-700 border-b-2 border-secondary">Rekomendasi Menu</h2>
      <button class="bg-green-500 hover:bg-green-600 text-white p-2 rounded-lg" onclick="openModalCreate()">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
          </svg>
      </button>
  </div>

  <!-- Slider Items -->
  <ul class="space-y-2">
    @foreach ($rekomendasi as $item)
      
    <li class="flex justify-between items-center">
        <div class="flex items-center">
            <span class="w-1 h-6 bg-secondary mr-2"></span>
            <span class="text-gray-700">{{ $item->name }}</span>
        </div>
        <div class="flex space-x-6">
            <button class="text-blue-500 hover:text-blue-600" onclick="openModalUpdateMenu({{ json_encode($item) }})">
                <i class="fas fa-pen"></i>
            </button>
            <button class="text-yellow-500 hover:text-yellow-600" onclick="openModalViewMenu({{ json_encode($item) }})">
                <i class="fas fa-eye"></i>
            </button>
            <form action="/admin/rekomendasi/{{ $item->id }}" method="POST" class="d-inline">
              @method('DELETE')
              @csrf
              <button class="text-red-500 hover:text-red-600" onclick="return confirm('Are you sure?')">
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
      <button class="border border-dashed border-secondary text-secondary px-4 py-1 rounded-md hover:bg-secondary hover:text-white transition">
          Load More
      </button>
  </div>
</div>


 <!-- Modal create -->

<div id="modalCreate" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center hidden">
    <div class="bg-white rounded-lg shadow-lg w-80 h-[400px] p-6 relative overflow-hidden">
        <button onclick="closeModal()" class="absolute top-2 right-2 text-red-500 hover:text-red-600">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 8.586L4.293 2.879A1 1 0 102.879 4.293L8.586 10l-5.707 5.707a1 1 0 101.414 1.414L10 11.414l5.707 5.707a1 1 0 001.414-1.414L11.414 10l5.707-5.707a1 1 0 00-1.414-1.414L10 8.586z" clip-rule="evenodd" />
            </svg>
        </button>
        <h2 class="text-xl font-bold text-center mb-4">Tambah Menu</h2>
        
        <!-- Form Wrapper with Scroll -->
        <div class="overflow-y-auto h-[320px]">
            <form action="/admin/rekomendasi" method="POST" enctype="multipart/form-data">
                @csrf
                <label class="block text-gray-700 mb-2">Kategori Makanan</label>
                <select name="id_kategori" id="id_kategori" class="border border-gray-300 p-2 w-full mb-4">
                    <option value="">Pilih Kategori</option>
                    @foreach ($kategoriAll as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>

                <label class="block text-gray-700 mb-2">Tenant</label>
                <select name="id_tenant" id="id_tenant" class="border border-gray-300 p-2 w-full mb-4">
                    <option value="">Pilih Tenant</option>
                    @foreach ($tenant as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>

                <label class="block text-gray-700 mb-2">Nama Menu</label>
                <input type="text" name="name" id="name" class="border border-gray-300 p-2 w-full mb-4" />

                <label class="block text-gray-700 mb-2">Harga</label>
                <input type="text" name="harga" id="harga" class="border border-gray-300 p-2 w-full mb-4" />

                <label class="block text-gray-700 mb-2">Gambar</label>
                <input type="file" name="gambar" id="gambar" class="border border-gray-300 p-2 w-full mb-4" onchange="previewImage(event)" />

                <!-- Image Preview -->
                <div id="imagePreviewCreateMenu" class="w-full h-40 bg-gray-100 rounded-lg flex justify-center items-center overflow-hidden mb-4">
                    <span class="text-gray-500">No Image Selected</span>
                </div>

                <button type="submit" class="w-full bg-green-500 hover:bg-green-600 text-white font-medium rounded-lg px-4 py-2">
                    Tambah
                </button>
            </form>
        </div>
    </div>
</div>

 <!-- Modal View -->
<div id="modalviewmenu" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center hidden">
  <div class="bg-white rounded-lg shadow-lg w-80 p-6 relative">
      <button onclick="closeModalViewMenu()" class="absolute top-2 right-2 text-red-500 hover:text-red-600">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M10 8.586L4.293 2.879A1 1 0 102.879 4.293L8.586 10l-5.707 5.707a1 1 0 101.414 1.414L10 11.414l5.707 5.707a1 1 0 001.414-1.414L11.414 10l5.707-5.707a1 1 0 00-1.414-1.414L10 8.586z" clip-rule="evenodd" />
          </svg>
      </button>
      <h2 class="text-xl font-bold text-center mb-4">Preview Menu</h2>
      <!-- Image Preview Area -->
      <div class="flex flex-col justify-start items-start">
        <p id="nameImageMenu" class="text-lg font-normal text-center mb-1"></p>
        <p id="kategoriMenu" class="text-lg font-normal text-center mb-1"></p>
        <p id="tenantMenu" class="text-lg font-normal text-center mb-1"></p>
        <p id="hargaMenu" class="text-lg font-normal text-center mb-1"></p>
      </div>
      <div id="modalImageContainer" class="flex justify-center items-center">
          <img id="modalImageMenu" src="" alt="Slider Image" class="w-full h-auto rounded-lg" />
      </div>
  </div>
</div>

{{-- Modal Update --}}
 <!-- Modal Update -->
 <div id="modalUpdateMenu" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center hidden">
  <div class="bg-white rounded-lg shadow-lg w-80 p-6 relative">
      <button onclick="closeModalUpdateMenu()" class="absolute top-2 right-2 text-red-500 hover:text-red-600">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M10 8.586L4.293 2.879A1 1 0 102.879 4.293L8.586 10l-5.707 5.707a1 1 0 101.414 1.414L10 11.414l5.707 5.707a1 1 0 001.414-1.414L11.414 10l5.707-5.707a1 1 0 00-1.414-1.414L10 8.586z" clip-rule="evenodd" />
        </svg>
      </button>
      <h2 class="text-xl font-bold text-center mb-4">Update Menu</h2>
      <div class="overflow-y-auto h-[320px]">
      <form action="" method="POST" enctype="multipart/form-data" id="updateFormMenu">
          @csrf
          @method('PUT')
          <label class="block text-gray-700 mb-2">Kategori</label>
          {{-- <input type="text" name="name" id="updateNameMenu" class="border border-gray-300 p-2 w-full mb-4" /> --}}
          <select name="id_kategori" id="updateKategoriMenu" class="border border-gray-300 p-2 w-full mb-4">
              @foreach ($kategoriAll as $category)
                  <option value="{{ $category->id }}">{{ $category->name }}</option>
              @endforeach
          </select>
          <label class="block text-gray-700 mb-2">Tenant</label>
          <select name="id_tenant" id="updateTenantMenu" class="border border-gray-300 p-2 w-full mb-4">
              @foreach ($tenant as $item)
                  <option value="{{ $item->id }}">{{ $item->name }}</option>
              @endforeach
          </select>
          <label class="block text-gray-700 mb-2">Nama Menu</label>
          <input type="text" name="name" id="updateNameMenu" class="border border-gray-300 p-2 w-full mb-4" />
          <label class="block text-gray-700 mb-2">Harga</label>
          <input type="text" name="harga" id="updateHargaMenu" class="border border-gray-300 p-2 w-full mb-4" />

          <label class="block text-gray-700 mb-2">Gambar</label>
          <input type="file" name="gambar" id="updateGambarMenu" class="border border-gray-300 p-2 w-full mb-4" onchange="previewUpdateImage(event)" />

          <div id="updateImageMenuPreview" class="w-full h-40 bg-gray-100 rounded-lg flex justify-center items-center overflow-hidden mb-4">
              <span class="text-gray-500">No Image Selected</span>
          </div>

          <button type="submit" class="w-full bg-green-500 hover:bg-green-600 text-white font-medium rounded-lg px-4 py-2">
              Update
          </button>
      </form>
      </div>
  </div>
</div>


</div>



<script>
function openModalCreate() {
  document.getElementById("modalCreate").classList.remove("hidden");
}
function openModalViewMenu(item) {
    // Set the image source for the modal image element
    const modalImage = document.getElementById("modalImageMenu");
    const nameImage = document.getElementById("nameImageMenu");
    const kategori = document.getElementById("kategoriMenu");
    const tenant = document.getElementById("tenantMenu");
    const harga = document.getElementById("hargaMenu");
    const kategoriList = @json($kategoriAll);
    const k = kategoriList.find(k => k.id === item.id_kategori);
    const tenantList = @json($tenant);
    const t = tenantList.find(t => t.id === item.id_tenant);
    modalImage.src = item.gambar ? `/storage/${item.gambar}` : 'path/to/placeholder-image.jpg'; 
    nameImage.innerHTML = `<i class="fas fa-bookmark mr-2"></i>: ${item.name}`;
    kategori.innerHTML =k ? `<i class="fas fa-clipboard-list mr-2"></i>: ${k.name}`: '';
    tenant.innerHTML = t ? `<i class="fas fa-store-alt mr-2"></i> : ${t.name}` : '';
    harga.innerHTML = `<i class="fas fa-dollar-sign mr-2"></i>: ${item.harga}`;
    // Show the modal
    document.getElementById("modalviewmenu").classList.remove("hidden");
}

function closeModal() {
  document.getElementById("modalCreate").classList.add("hidden");
}
function closeModalViewMenu() {
  document.getElementById("modalviewmenu").classList.add("hidden");
}

function previewImage(event) {
        const imagePreview = document.getElementById('imagePreviewCreateMenu');
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

  function openModalUpdateMenu(item) {
    const modal = document.getElementById("modalUpdateMenu");
    const updateForm = document.getElementById("updateFormMenu");
    const updateKategori = document.getElementById("updateKategoriMenu");
    const updateTenant = document.getElementById("updateTenantMenu");
    const updateName = document.getElementById("updateNameMenu");
    const updateHarga = document.getElementById("updateHargaMenu");
    const updateImagePreview = document.getElementById("updateImageMenuPreview");

    // Set form action to update route
    updateForm.action = `/admin/rekomendasi/${item.id}`;

    // Set existing values in input fields
    updateKategori.value = item.id_kategori;
    updateTenant.value = item.id_tenant;
    updateName.value = item.name;
    updateHarga.value = item.harga;
    updateImagePreview.innerHTML = item.gambar
        ? `<img src="/storage/${item.gambar}" class="w-full h-full object-cover rounded-lg" />`
        : '<span class="text-gray-500">No Image Selected</span>';

    // if (item.gambar) {
    //     updateImagePreview.innerHTML = `<img src="/storage/${item.gambar}" class="w-full h-full object-cover rounded-lg" />`;
    // } else {
    //     updateImagePreview.innerHTML = '<span class="text-gray-500">No Image Selected</span>';
    // }

    // Show modal
    modal.classList.remove("hidden");
}

function closeModalUpdateMenu() {
  document.getElementById("modalUpdateMenu").classList.add("hidden");
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