{{-- <!-- home.blade.php -->
<div class="flex flex-col items-center justify-center min-h-screen/2 bg-cover bg-bottom " style="background-image: url('/image/background.png');">
  <!-- Icon Grid -->
  <div class="grid grid-cols-4 gap-5 lg:gap-10 mb-6 pt-8">
      <!-- Repeat this for each icon with a link or image source as needed -->
      @foreach ($kategoriAll as $item)       
      <a href="/menu-by/{{ $item->id }}" class="flex items-center justify-center w-16 h-16 lg:w-20 lg:h-20 bg-white rounded-lg shadow-lg transition-transform transform hover:scale-105 hover:shadow-lg" title="{{ $item->name }}">
          <img src="{{ asset('storage/' . $item->gambar) }}" alt="Icon 1" class="w-10 h-10 lg:w-14 lg:h-14">
      </a>
      @endforeach
  </div>

  <!-- Title -->
  <h2 class="text-2xl lg:text-3xl font-bold text-white mb-4">{{ $title }}</h2>

  <!-- Radio Buttons -->
  <div class="flex items-center gap-8 mb-6">
      <label class="flex items-center text-white">
          <input type="radio" name="menu" class="mr-2">
          Menu
      </label>
      <label class="flex items-center text-white">
          <input type="radio" name="menu" class="mr-2">
          Restoran
      </label>
  </div>

  <!-- Search Bar -->
  <div class="relative w-64 lg:w-96 mb-6">
    <!-- Search Bar -->
    <form action="/all-menu" method="GET" class="relative w-64 lg:w-96 mb-6">
      <input type="search" name="search" id="search" placeholder="Cari..." class="w-full px-4 py-2 text-gray-700 bg-white rounded-full shadow focus:outline-none">
      <button type="submit" class="absolute top-1/2 right-3 transform -translate-y-1/2">
          <svg class="w-5 h-5 text-primary" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M12.9 14.32a8 8 0 111.42-1.42l4.83 4.83a1 1 0 01-1.42 1.42l-4.83-4.83zM14 8a6 6 0 11-12 0 6 6 0 0112 0z" clip-rule="evenodd"></path>
          </svg>
      </button>
    </form>
  </div>
</div> --}}



<div class="flex flex-col items-center justify-center min-h-screen/2 bg-cover bg-bottom "
    style="background-image: url('/image/background.png');">
    <!-- Icon Grid -->
    <div class="grid grid-cols-4 gap-5 lg:gap-10 mb-6 pt-8">
        @foreach ($kategoriAll as $item)
            <a href="/menu-by/{{ $item->id }}"
                class="flex items-center justify-center w-16 h-16 lg:w-20 lg:h-20 bg-white rounded-lg shadow-lg transition-transform transform hover:scale-105 hover:shadow-lg"
                title="{{ $item->name }}">
                <img src="{{ asset('storage/' . $item->gambar) }}" alt="Icon 1" class="w-10 h-10 lg:w-14 lg:h-14">
            </a>
        @endforeach
    </div>

    <!-- Title -->
    <h2 class="text-2xl lg:text-3xl font-bold text-white mb-4">{{ $title }}</h2>

    <!-- Search Form with Radio Buttons -->
    <form action="/all-menu" method="GET" id="searchForm" class="flex flex-col items-center">
        <!-- Radio Buttons -->
        <div class="flex items-center gap-8 mb-6">
            <label class="flex items-center text-white">
                <input type="radio" name="searchType" value="menu" class="mr-2"
                    onclick="updateFormAction('/all-menu')">
                Menu
            </label>
            <label class="flex items-center text-white">
                <input type="radio" name="searchType" value="tenant" class="mr-2"
                    onclick="updateFormAction('/all-tenant')">
                Restoran
            </label>
        </div>

        <!-- Search Bar -->
        <div class="relative w-64 lg:w-96 mb-6">
            <input type="search" name="search" id="search" placeholder="Cari..."
                class="w-full px-4 py-2 text-gray-700 bg-white rounded-full shadow focus:outline-none">
            <button type="submit" class="absolute top-1/2 right-3 transform -translate-y-1/2">
                <svg class="w-5 h-5 text-primary" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M12.9 14.32a8 8 0 111.42-1.42l4.83 4.83a1 1 0 01-1.42 1.42l-4.83-4.83zM14 8a6 6 0 11-12 0 6 6 0 0112 0z"
                        clip-rule="evenodd"></path>
                </svg>
            </button>
        </div>
    </form>
</div>

<script>
    // JavaScript function to update form action based on selected radio button
    function updateFormAction(action) {
        document.getElementById('searchForm').action = action;
    }
</script>
