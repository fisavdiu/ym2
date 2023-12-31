<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">

        <main>
            <div class="max-w-full pl-0 lg:flex">
                <nav aria-label="Components">
                    <button title="Side navigation" type="button"
                            class="fixed z-40 self-center order-10 visible block w-10 h-10 bg-white rounded opacity-100 lg:hidden left-6 top-6"
                            aria-haspopup="menu" aria-label="Side navigation" aria-expanded="false" aria-controls="nav-menu-1">
                        <div class="absolute w-6 transform -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
                    <span aria-hidden="true"
                          class="absolute block h-0.5 w-9/12 -translate-y-2 transform rounded-full bg-slate-700 transition-all duration-300"></span>
                            <span aria-hidden="true"
                                  class="absolute block h-0.5 w-6 transform rounded-full bg-slate-900 transition duration-300"></span>
                            <span aria-hidden="true"
                                  class="absolute block h-0.5 w-1/2 origin-top-left translate-y-2 transform rounded-full bg-slate-900 transition-all duration-300"></span>
                        </div>
                    </button>

                    <!-- Side Navigation -->
                    <aside id="nav-menu-1" aria-label="Side navigation"
                           class="fixed top-0 bottom-0 left-0 z-40 flex flex-col transition-transform -translate-x-full bg-white border-r w-72 sm:translate-x-0 border-r-slate-200">
                        <a aria-label="WindUI logo"
                           class="flex items-center gap-2 p-6 text-xl font-medium whitespace-nowrap focus:outline-none"
                           href="javascript:void(0)">
                            <svg width="300" height="300" viewBox="0 0 300 300" fill="none" xmlns="http://www.w3.org/2000/svg"
                                 class="w-8 h-8 bg-teal-500">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                      d="M88.1121 88.1134L150.026 150.027L150.027 150.027L150.027 150.027L150.028 150.027L150.027 150.026L88.1133 88.1122L88.1121 88.1134ZM273.878 273.877C272.038 274.974 196.128 319.957 165.52 289.349L88.1124 211.942L26.1434 273.911C26.1434 273.911 -20.3337 196.504 10.651 165.519L88.1121 88.1134L26.1417 26.1433C26.1417 26.1433 69.6778 0.00338007 104.519 0H0V300H300V0H104.533C116.144 0.00112664 126.789 2.90631 134.534 10.651L211.941 88.1123L273.877 26.177C274.974 28.0159 319.957 103.926 289.349 134.535L211.942 211.942L273.878 273.877ZM273.878 273.877L273.912 273.857V273.911L273.878 273.877ZM273.877 26.177L273.911 26.1429H273.857C273.857 26.1429 273.863 26.1544 273.877 26.177Z"
                                      fill="white"/>
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                      d="M0 0H300V300H0V0ZM150.026 150.025C121.715 99.731 88.1131 88.1122 88.1131 88.1122L10.6508 165.519C10.6508 165.519 26.143 150.027 150.026 150.027H150.027C150.026 150.027 150.026 150.027 150.026 150.027L150.026 150.027C99.731 178.339 88.1124 211.941 88.1124 211.941L165.52 289.348C165.52 289.348 150.032 273.86 150.027 150.027H150.029C178.341 200.323 211.944 211.942 211.944 211.942L289.352 134.535C289.352 134.535 273.864 150.023 150.027 150.027V150.027L150.027 150.027C200.322 121.715 211.941 88.1125 211.941 88.1125L134.534 10.651C134.534 10.651 150.026 26.1431 150.026 150.025ZM150.027 150.027L150.026 150.027C150.026 150.026 150.026 150.026 150.026 150.025C150.026 150.025 150.027 150.026 150.027 150.027ZM150.027 150.027L150.027 150.026L150.027 150.027C150.027 150.027 150.027 150.027 150.027 150.027L150.027 150.027ZM150.027 150.027C150.027 150.027 150.027 150.027 150.027 150.027H150.027L150.027 150.027Z"
                                      fill="rgba(255,255,255,.2)"/>
                            </svg>
                            WindUI
                        </a>
                        <nav aria-label="side navigation" class="flex-1 overflow-auto divide-y divide-slate-100">
                            <div>
                                <ul class="flex flex-col flex-1 gap-1 py-3">
                                    <li class="px-3">
                                        <!-- Component: Large primary button with leading icon  -->
                                        <button
                                            class="inline-flex w-full items-center justify-center h-12 gap-1 px-6 text-sm font-medium tracking-wide text-white transition duration-300 rounded focus-visible:outline-none whitespace-nowrap bg-teal-500 hover:bg-teal-600 focus:bg-teal-700 disabled:cursor-not-allowed disabled:border-teal-300 disabled:bg-teal-300 disabled:shadow-none">
                                            <span class="order-2">New discussion</span>
                                            <span class="relative only:-mx-6">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M12 4.5v15m7.5-7.5h-15"/>
                                    </svg>
                                    </span>
                                        </button>
                                        <!-- End Large primary button with leading icon  -->
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    </aside>

                    <!-- Backdrop -->
                    <div class="fixed top-0 bottom-0 left-0 right-0 z-30 transition-colors bg-slate-900/20 sm:hidden"></div>
                    <!-- End Side navigation menu with content separator -->
                </nav>


                <div class="lg:w-full lg:ml-72 px-8 py-8">

                    <div class="container flex pl-14 gap-10">
                        <div class="flex-1 min-w-0">

                            {{ $slot }}

                        </div>
                        <nav class="hidden text-sm w-60 2xl:block py-28">
                        </nav>

                    </div>
                    <!-- End Rounded large search input-->
                </div>
            </div>
        </main>
    </div>
    </body>
{{--    <body class="font-sans text-gray-900 antialiased">--}}
{{--        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">--}}
{{--            <div>--}}
{{--                <a href="/" wire:navigate>--}}
{{--                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />--}}
{{--                </a>--}}
{{--            </div>--}}

{{--            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">--}}
{{--                {{ $slot }}--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </body>--}}
</html>
