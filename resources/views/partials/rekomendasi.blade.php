<div class="mx-auto lg:px-80 px-4 py-6 bg-[#F8F8F8]">
  <div class="flex justify-between items-center mb-4">
      <h2 class="text-lg font-semibold">Rekomendasi Menu <span class="text-black">★</span></h2>
      <a href="/all-menu" class="text-sm text-secondary hover:text-primary">Lihat Semua →</a>
  </div>
  <div class="flex space-x-4 overflow-x-auto no-scrollbar">
      @foreach ($rekomendasi as $item)         
      <div class="min-w-[200px] flex-shrink-0 rounded-lg ">
          <img src="{{ asset('storage/'.$item->gambar) }}" alt="Nasi Goreng" class="w-full h-32 object-cover rounded-t-lg">
          <div class="p-4">
              <h3 class="font-bold text-gray-900">{{ $item->name }}</h3>
              <p class="text-sm text-gray-600">{{ $item->tenant ? $item->tenant->name : '' }}</p>
              <p class="text-secondary font-semibold">Rp.{{ number_format($item->harga, 0, ',', '.') }}</p>
          </div>
      </div>
      @endforeach
  </div>
</div>

