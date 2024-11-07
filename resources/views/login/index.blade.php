@extends('layouts.main')

@section('container')
<div class="flex justify-center items-center min-h-screen bg-primary">
  <div class="w-full max-w-md p-8 bg-white shadow-md rounded-lg mx-5">
    @if (session()->has('success'))
    <script>
      document.addEventListener("DOMContentLoaded", function() {
          Swal.fire({
              icon: 'success',
              title: '{{ session("success") }}',
              toast: true,
              position: 'top-end',
              showConfirmButton: false,
              timer: 3000,
              timerProgressBar: true,
              customClass: {
                  popup: 'colored-toast'
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
              toast: true,
              position: 'top-end',
              showConfirmButton: false,
              timer: 3000,
              timerProgressBar: true,
              customClass: {
                  popup: 'colored-toast'
              }
          });
      });
  </script>
    @endif
    <form class="space-y-8" action="/login" method="POST">
      @csrf
      <h2 class="text-2xl font-bold text-center text-gray-900">Login</h2>

      <div>
        {{-- <label for="username" class="block text-sm font-medium text-gray-500">Username</label> --}}
        <div class="relative mt-1">
          <span class="absolute inset-y-0 left-0 pl-2 flex items-center">
            <i class="fa fa-user"></i>
          </span>
          <input type="text" name="email" id="email" placeholder="Email" required
                 class="pl-10 w-full bg-transparent border-b-2 border-secondary text-gray-900 text-sm focus:outline-none focus:border-brown-700 p-2" />
        </div>
      </div>

      <div>
        {{-- <label for="password" class="block text-sm font-medium text-gray-500">Password</label> --}}
        <div class="relative mt-1">
          <span class="absolute inset-y-0 left-0 pl-2 flex items-center">
            <i class="fa fa-lock"></i>
          </span>
          <input type="password" name="password" id="password" placeholder="Password" required
                 class="pl-8 w-full bg-transparent border-b-2 border-secondary text-gray-900 text-sm focus:outline-none focus:border-brown-700 p-2" />
        </div>
      </div>

      <button type="submit" class="w-full bg-secondary hover:bg-brown-600 text-white font-medium rounded-lg text-sm px-5 py-2.5 text-center">
        Masuk
      </button>
    </form>
  </div>
</div>
@endsection
