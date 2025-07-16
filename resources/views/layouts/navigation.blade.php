<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
  <!-- Верхняя панель -->
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between h-16">
      <!-- Логотип + desktop-ссылки -->
      <div class="flex">
        <div class="shrink-0 flex items-center">
          <a href="{{ route('dashboard') }}">
            <x-application-logo class="block h-9 w-auto text-gray-800"/>
          </a>
        </div>
        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
          <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
            Dashboard
          </x-nav-link>
          <x-nav-link :href="route('articles.create')" :active="request()->routeIs('articles.create')">
            Создать статью
          </x-nav-link>
          <x-nav-link :href="route('articles.index')" :active="request()->routeIs('articles.index')">
            Мои статьи
          </x-nav-link>
        </div>
      </div>

      <!-- Профиль dropdown -->
      <div class="hidden sm:flex sm:items-center sm:ml-6">
        <x-dropdown align="right" width="48">
          <x-slot name="trigger">
            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition">
              <div>{{ Auth::user()->name }}</div>
              <svg class="ml-1 h-4 w-4 fill-current" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                      d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0
                         111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0
                         010-1.414z"
                      clip-rule="evenodd"/>
              </svg>
            </button>
          </x-slot>

          <x-slot name="content">
            <x-dropdown-link :href="route('profile.edit')">
              Profile
            </x-dropdown-link>
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <x-dropdown-link
                :href="route('logout')"
                onclick="event.preventDefault(); this.closest('form').submit();"
              >
                Log Out
              </x-dropdown-link>
            </form>
          </x-slot>
        </x-dropdown>
      </div>

      <!-- Hamburger для mobile -->
      <div class="-mr-2 flex items-center sm:hidden">
        <button @click="open = !open"
                class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none transition">
          <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
            <path :class="{'hidden': open, 'inline-flex': !open}"
                  class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M4 6h16M4 12h16M4 18h16"/>
            <path :class="{'hidden': !open, 'inline-flex': open}"
                  class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M6 18L18 6M6 6l12 12"/>
          </svg>
        </button>
      </div>
    </div>
  </div>

  <!-- Mobile-меню -->
  <div x-show="open" class="sm:hidden border-t border-gray-200">
    <div class="pt-2 pb-3 space-y-1">
      <x-responsive-nav-link
        :href="route('dashboard')"
        :active="request()->routeIs('dashboard')"
        class="block w-full text-center py-3 text-base"
      >
        Dashboard
      </x-responsive-nav-link>
      <x-responsive-nav-link
        :href="route('articles.create')"
        :active="request()->routeIs('articles.create')"
        class="block w-full text-center py-3 text-base"
      >
        Создать статью
      </x-responsive-nav-link>
      <x-responsive-nav-link
        :href="route('articles.index')"
        :active="request()->routeIs('articles.index')"
        class="block w-full text-center py-3 text-base"
      >
        Мои статьи
      </x-responsive-nav-link>
    </div>

    <div class="border-t border-gray-200 my-2"></div>

    <div class="pt-2 pb-3 space-y-1">
      <x-responsive-nav-link
        :href="route('profile.edit')"
        class="block w-full text-center py-3 text-base"
      >
        Profile
      </x-responsive-nav-link>

      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <x-responsive-nav-link
          :href="route('logout')"
          class="block w-full text-center py-3 text-base"
          onclick="event.preventDefault(); this.closest('form').submit();"
        >
          Log Out
        </x-responsive-nav-link>
      </form>
    </div>
  </div>
</nav>
