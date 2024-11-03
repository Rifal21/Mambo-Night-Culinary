<h2 class="text-sm lg:text-lg font-bold text-secondary mb-4 text-center capitalize mt-5">galeri mambo kuliner</h2>
<div id="default-carousel" class="relative w-full mb-10" data-carousel="slide">
  <!-- Carousel wrapper -->
  <div class="relative h-56 overflow-hidden rounded-lg md:h-[500px] lg:mx-10 mx-5 -z-10">
    @foreach ($banner as $item)  
        <div class="w-full duration-700 ease-in-out h-full object-cover" data-carousel-item>
            <img src="{{ asset('storage/'.$item->banner) }}" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
        </div>
    @endforeach
  </div>


</div>


