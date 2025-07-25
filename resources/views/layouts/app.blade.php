<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

  <!-- Scripts & Styles -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100">
  <div class="min-h-screen flex flex-col">
    @include('layouts.navigation')

    <!-- Header -->
    <header class="bg-white shadow">
      <div class="w-full max-w-full mx-auto px-2 sm:px-4 md:px-6 lg:px-8 py-4">
        @isset($header)
          {{ $header }}
        @endisset
      </div>
    </header>

    <!-- Main Content -->
    <main class="flex-1">
      <div class="w-full max-w-full mx-auto px-2 sm:px-4 md:px-6 lg:px-8 py-4">
        {{ $slot }}
      </div>
    </main>
  </div>
</body>
</html>
