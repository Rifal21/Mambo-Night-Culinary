@extends('layouts.main')

@section('container')
@include('partials.headerHome')

<div class="flex justify-center mt-5 mb-5">
  <div class="w-full max-w-3xl mx-5">
    <div class="bg-white rounded-lg shadow-md p-3 flex items-center space-x-3 mb-3">
      <img src="/image/icon/tenant.svg" class="material-icons"/>
      <span class="font-semibold text-secondary">Tenant</span>
    </div>
    <!-- Menu Items Grid -->
    @if ($tenant->isEmpty())
      <!-- Display Message If No Results Are Found -->
      <div class="bg-white rounded-lg shadow p-3 text-center text-gray-600">
        <p> Pencarian untuk tenant {{ request('search') }} tidak ditemukan.</p>
      </div>
    @else
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
      @foreach ($tenant as $item)
      <div class="bg-white rounded-lg shadow p-3">
        <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->name }}" class="rounded-lg w-full h-40 object-cover mb-3">
        <h2 class="text-gray-800 font-semibold text-md mb-1">{{ $item->name }}</h2>
        <hr class="text-sm text-gray-200"></hr>
        <div class="flex items-center space-x-1 text-gray-600 mt-2">
          <img src="/image/icon/place.svg" class="w-4 h-4">
          <span class="text-sm font-semibold">{{ $item->alamat}}</span>
        </div>
      </div>
      @endforeach
    </div>
    <div class="flex justify-center mt-4 mb-5">
      {{ $tenant->links() }} <!-- Render pagination links here -->
    </div>
    @endif
  </div>
</div>
@endSection