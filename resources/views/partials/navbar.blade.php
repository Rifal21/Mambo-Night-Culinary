@php
$navItems = [
    ['name' => 'Beranda', 'link' => '/', 'icon' => '/image/icon/home.svg'],
    ['name' => 'Rekomendasi Menu', 'link' => '/all-menu', 'icon' => '/image/icon/rekomen.svg'],
    ['name' => 'Tenant', 'link' => '/all-tenant', 'icon' => '/image/icon/tenant.svg'],
    ['name' => 'Menu', 'link' => '/menu-list', 'icon' => '/image/icon/menu.svg'],
    ['name' => 'Artikel', 'link' => '#', 'icon' => '/image/icon/artikel.svg'],
    ['name' => 'Pendaftaran Tenant', 'link' => '/pendaftaran', 'icon' => '/image/icon/pendaftaran.svg'],
    ['name' => 'Login', 'link' => '/login', 'icon' => '/image/icon/login.svg'],
];
@endphp

<nav class="bg-primary px-2 sm:px-4 py-2.5 dark:bg-primary fixed w-full z-20 top-0 left-0 border-b border-primary dark:border-primary shadow-lg">
  <div class="container flex flex-wrap items-center justify-between mx-auto">
    <a href="/" class="flex items-center justify-start gap-3">
      <img src="/image/logo.png" class="w-12 rounded-full" alt="Mambo Logo">
      <div class="flex flex-col">
        <h3 class="font-bold text-secondary">Mambo Kuliner Night</h3>
        <p class="font-normal text-secondary">Tasikmalaya</p>
      </div>
    </a>
    <div class="flex md:order-2">
      <button data-collapse-toggle="navbar-sticky" type="button" class="inline-flex items-center p-2 text-sm text-secondary rounded-lg md:hidden dark:text-secondary" aria-controls="navbar-sticky" aria-expanded="false">
        <span class="sr-only">Open main menu</span>
        <svg class="w-6 h-6" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M11.25 7.5H25.3125M4.6875 15H25.3125M4.6875 22.5H25.3125M4.6875 10.3125L7.5 7.5L4.6875 4.6875" stroke="#89643D" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>          
      </button>
    </div>
    <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
      <ul class="flex flex-col mt-4 border border-primary bg-gray-50 md:flex-row md:space-x-8 md:mt-0 md:text-sm md:font-medium md:border-0 md:bg-white dark:bg-primary md:dark:bg-primary dark:border-primary">
        
        @foreach ($navItems as $item)
            <li>
              <a href="{{ $item['link'] }}" class="flex items-center gap-2 py-2 pl-3 pr-4 text-secondary rounded hover:bg-tertiary md:hover:bg-transparent md:hover:text-hov md:p-0 dark:text-secondary dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700 {{ Request::is(trim($item['link'], '/')) ? 'active' : '' }}">
                <img src="{{ $item['icon'] }}" alt="" class="w-5 h-5">
                {{ $item['name'] }}
              </a>
            </li>
        @endforeach

      </ul>
    </div>
  </div>
</nav>
