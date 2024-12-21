@php
    $navItems = [
        ['name' => 'Dashboard', 'link' => '/admin/dashboard', 'icon' => '/image/icon/home.svg'],
        // ['name' => 'Rekomendasi Menu', 'link' => '/admin/rekomendasi', 'icon' => '/image/icon/rekomen.svg'],
        ['name' => 'Tenant', 'link' => '/admin/tenant', 'icon' => '/image/icon/tenant.svg'],
        ['name' => 'Menu', 'link' => '/admin/menu', 'icon' => '/image/icon/menu.svg'],
        ['name' => 'Kategori Artikel', 'link' => '/admin/kategori-artikel', 'icon' => '/image/icon/artikel.svg'],
        ['name' => 'Artikel', 'link' => '/admin/artikel', 'icon' => '/image/icon/artikel.svg'],
        ['name' => 'Pendaftaran Tenant', 'link' => '/admin/pendaftaran', 'icon' => '/image/icon/pendaftaran.svg'],
    ];
@endphp

<nav class="fixed top-0 z-50 w-full bg-secondary border-b border-gray-200 dark:bg-secondary dark:border-secondary">
    <div class="px-3 py-3 lg:px-5 lg:pl-3">
        <div class="flex items-center justify-between">
            <div class="flex items-center justify-start rtl:justify-end">
                <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar"
                    type="button"
                    class="inline-flex items-center p-2 text-sm text-white rounded-lg sm:hidden hover:bg-secondary">
                    <span class="sr-only">Open sidebar</span>
                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path clip-rule="evenodd" fill-rule="evenodd"
                            d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                        </path>
                    </svg>
                </button>
                <a href="/" class="flex ms-2 md:me-24" target="_blank">
                    <img src="/image/logo.png" class="h-8 me-3 rounded-full" alt="Mambo Logo" />
                    <span class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-white">Mambo
                        Kuliner</span>
                </a>
            </div>
            <div class="flex items-center">
                <div class="flex items-center ms-3">
                    <div>
                        <button type="button"
                            class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
                            aria-expanded="false" data-dropdown-toggle="dropdown-user">
                            <span class="sr-only">Open user menu</span>
                            <img class="w-8 h-8 rounded-full"
                                src="{{ Auth::user()->foto ? Auth::user()->foto : '/image/profil.png' }}"
                                alt="user photo">
                        </button>
                    </div>
                    <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-secondary dark:divide-gray-600"
                        id="dropdown-user">
                        <div class="px-4 py-3" role="none">
                            <p class="text-sm text-gray-900 dark:text-white" role="none">
                                {{ Auth::user()->name }}
                            </p>
                            <p class="text-sm font-medium text-gray-900 truncate dark:text-gray-300" role="none">
                                {{ Auth::user()->email }}
                            </p>
                        </div>
                        <ul class="py-1" role="none">
                            <li>
                                <form action="/logout" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="block w-full px-4 py-2 text-sm text-secondary hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-100 dark:hover:text-secondary"
                                        role="menuitem">Keluar</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

<aside id="logo-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-primary dark:border-primary"
    aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-primary dark:bg-primary">
        <ul class="space-y-2 font-medium">
            @foreach ($navItems as $item)
                <li>
                    <a href="{{ $item['link'] }}"
                        class="flex items-center p-2 text-secondary rounded-lg dark:text-secondary hover:bg-gray-100 dark:hover:bg-secondary/20 group">
                        <img src="{{ $item['icon'] }}" alt="" class="w-6 h-6">
                        <span class="ms-3">{{ $item['name'] }}</span>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</aside>

<div class="p-4 sm:ml-64">

</div>
