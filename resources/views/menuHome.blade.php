@extends('layouts.main')

@section('container')
@include('partials.headerHome')
<div class="flex justify-center mt-5 mb-5">
  <div class="w-full md:w-1/4 mx-5 space-y-3">
    <div class="bg-white rounded-lg shadow-md p-3 flex items-center space-x-3 mb-3">
      <img src="/image/icon/menu.svg" class="material-icons"/>
      <span class="font-semibold text-secondary">Menu</span>
    </div>
    @foreach ($kategoriAll as $item)       
    <a href="/menu-by/{{ $item->id }}" class="bg-white rounded-lg shadow-md p-3 flex items-center space-x-3 mb-3 transition-transform transform hover:scale-105 hover:shadow-lg">
      <img src="{{ asset('storage/' . $item->gambar) }}" alt="">
      <span>{{ $item->name }}</span>
    </a>
    @endforeach
  </div>
</div>
@endSection