<div class="mx-auto lg:px-80 px-4 py-6 bg-[#F8F8F8]">
  <div class="flex justify-between items-center mb-4">
      <h2 class="text-lg font-semibold inline-flex items-center">Tenant <span class="text-black"><img src="/image/icon/tenant.svg" alt="" class="w-6 h-6 ml-3"></span></h2>
      <a href="/all-tenant" class="text-sm text-secondary hover:text-primary">Lihat Semua →</a>
  </div>
  <div class="flex space-x-4 overflow-x-auto no-scrollbar">
      <!-- Item Card 1 -->
      @foreach ($tenant as $item)        
      <div class="min-w-[200px] flex-shrink-0 rounded-lg ">
          <img src="{{ asset('storage/'.$item->gambar) }}" alt="Nasi Goreng" class="w-full h-32 object-cover rounded-t-lg">
          <div class="p-4">
              <h3 class="font-bold text-gray-900">{{ $item->name }}</h3>
          </div>
      </div>
      @endforeach
  </div>
</div>