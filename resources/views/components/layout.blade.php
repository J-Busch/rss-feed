<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>My RSS List</title>

  <link rel="icon" href="{{ asset('rss.png') }}">

  <!-- STYLES -->
  <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
  <script src="https://cdn.tailwindcss.com"></script>

</head>

<body>

  @if (!request()->is('/'))
  <nav class="bg-gray-800">
    <div class="mx-auto 2xl:max-w-screen-2xl xl:max-w-screen-xl lg:max-w-screen-lg md:max-w-screen-md sm:max-w-screen-sm px-2 sm:px-6 lg:px-8">
      <div class="relative flex flex-col md:flex-row h-16 items-center justify-between">
        <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
          <div class="flex flex-shrink-0 items-center">
            <img class="h-8 w-auto" src="{{ URL('/images/rss-icon.png') }}" alt="Your Company">
          </div>
          <div class="hidden sm:ml-6 sm:block">
            <div class="flex space-x-4">
              <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
              <a href="/feed" class="{{ request()->is('feed') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} rounded-md px-3 py-2 text-sm font-medium">My List</a>
              <a href="/articles" class="{{ request()->is('articles') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} rounded-md px-3 py-2 text-sm font-medium">Feed</a>
              <form method="POST" action="/logout">
                @csrf
                <button type="submit" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Logout</button>
              </form>
            </div>
          </div>
        </div>
        <div>
          <p class="text-white">Welcome {{ Auth::user()->name }}</p>
        </div>
      </div>
    </div>

    <!-- Mobile menu, show/hide based on menu state. -->
    <div class="sm:hidden" id="mobile-menu">
      <div class="space-y-1 px-2 pb-3 pt-2">
        <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
        <a href="/feed" class="{{ request()->is('feed') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} block rounded-md px-3 py-2 text-base font-medium" aria-current="page">My List</a>
        <a href="/articles" class="{{ request()->is('articles') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} block rounded-md px-3 py-2 text-base font-medium">Feed</a>
        <a href="logout" class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium">Logout</a>
      </div>
    </div>
  </nav>
  @endif

  <div class="container mx-auto px-4 my-5">
    {{ $slot }}
  </div>
</body>

</html>