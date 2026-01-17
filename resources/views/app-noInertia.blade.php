<?php 
    //$maxWidth = $maxWidth ?? '';
    if(!isset($maxWidth)){
        $maxWidth = '';
    }
?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"  @class(['dark' => ($appearance ?? 'system') == 'dark'])>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        {{-- Inline script to detect system dark mode preference and apply it immediately --}}
        <script>
            (function() {
                const appearance = '{{ $appearance ?? "system" }}';

                if (appearance === 'system') {
                    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

                    if (prefersDark) {
                        document.documentElement.classList.add('dark');
                    }
                }
            })();
        </script>

        <title>{{ config('app.name') }}</title>

        <link rel="icon" href="/favicon.ico" sizes="any">
        <link rel="icon" href="/favicon.svg" type="image/svg+xml">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">


        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        @vite(['resources/js/app.ts'])
        
    </head>
    <body class="font-sans antialiased h-full bg-background default-text-color ">
        
        @include('layouts.navbar')

        <div class="sm:px-6 px-4">
            <div class="mx-auto {{$maxWidth}} sm:my-6 my-4">
                <h1 class="text-4xl text-bold"> @yield('title')</h1>
            </div>
            
            <div class="">
                <div class="mx-auto block bg-white sm:p-6 xs:p-4 p-2 {{$maxWidth}}">
                    @yield('content')
                </div>
            </div>
        </div>
            
    </body>
</html>
