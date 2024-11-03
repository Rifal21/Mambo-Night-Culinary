@extends('layouts.main')

@section('container')
@include('partials.headerHome')

<div class="flex justify-center mt-5 mb-5">
  <div class="w-full max-w-3xl mx-5">
    @if($kategori)
      <!-- Display Category Name -->
      <div class="bg-white border-l-4 border-blue-500 p-4 shadow rounded-lg flex items-center space-x-3 mb-5">
        <img src="/image/icon/menu.svg" class="w-6 h-6"/>
        <h1 class="text-lg font-semibold text-gray-800">Menu {{ $kategori->name }}</h1>
      </div>

      <!-- Menu Items Grid -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach ($menus as $menu)
        <div class="bg-white rounded-lg shadow p-3">
          <img src="{{ asset('storage/' . $menu->gambar) }}" alt="{{ $menu->name }}" class="rounded-lg w-full h-40 object-cover mb-3">
          <h2 class="text-gray-800 font-semibold text-md mb-1">{{ $menu->name }}</h2>
          <div class="flex items-center space-x-1 text-gray-600">
            <img src="/image/icon/price-tag.svg" class="w-4 h-4">
            <span class="text-sm font-semibold">Rp.{{ number_format($menu->harga, 0, ',', '.') }}</span>
          </div>
        </div>
        @endforeach
      </div>
    @else
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <p>Category not found.</p>
      </div>
    @endif
    </div>
  </div>
  <div class="flex justify-center mb-5">
    {{ $menus->links() }}
  </div>
  
@endsection
