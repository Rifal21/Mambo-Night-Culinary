@extends('layouts.main')

@section('container')
<div class="flex justify-center items-center min-h-screen bg-primary">
  <div class="w-full max-w-md p-8 bg-white shadow-md rounded-lg mx-5">
    @if (session()->has('success'))
    {{-- <div id="alert-3" class="flex p-4 mb-4 text-green-600 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
      <svg aria-hidden="true" class="flex-shrink-0 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
      <span class="sr-only">Info</span>
      <div class="ml-3 text-sm font-medium">
        {{ session('success') }}
      </div>
      <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700" data-dismiss-target="#alert-3" aria-label="Close">
        <span class="sr-only">Close</span>
        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
      </button>
    </div> --}}
    <div class="bg-green-500 text-white p-3 rounded mb-3">
      {{ session('success') }}
  </div>
    @endif

    @if (session()->has('loginError'))
    {{-- <div id="alert-2" class="flex p-4 mb-4 text-red-600 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
      <svg aria-hidden="true" class="flex-shrink-0 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
      <span class="sr-only">Info</span>
      <div class="ml-3 text-sm font-medium">
       {{ session('loginError') }}
      </div>
      <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700" data-dismiss-target="#alert-2" aria-label="Close">
        <span class="sr-only">Close</span>
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
      </button>
    </div> --}}
    <div class="bg-red-500 text-white p-3 rounded mb-3">
      {{ session('loginError') }}
  </div>
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
