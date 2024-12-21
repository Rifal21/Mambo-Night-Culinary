<!doctype html>
<html class="scroll-smooth">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css','resources/js/app.js')
  {{-- <link rel="stylesheet" href="/build/assets/app-xel9GnN2.css"> --}}
  <link rel="icon" href="../image/logo.png">
  <title>Mambo Night Culinary</title>
</head>
<body>
  
  {{-- navbar --}}
  @include('partials.navbar')


  <div class="mt-16">
      @yield('container')
  </div>


  @include('partials.footer')

  
  




  <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script
      src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"
      integrity="sha256-KzZiKy0DWYsnwMF+X1DvQngQ2/FxF7MF3Ff72XcpuPs="
      crossorigin="anonymous"
    ></script>
    {{-- <script src="/build/assets/app-z-Rg4TxU.js"></script> --}}
</body>
</html>