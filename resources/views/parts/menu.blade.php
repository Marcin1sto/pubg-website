<nav class="flex justify-center px-2 sm:px-4 py-2.5 bg-gray-800 sticky w-full z-20 top-0 left-0 border-b border-green-500" style="height: 100px">
    <div class="container flex flex-wrap justify-between items-center mx-auto">
        <a href="/" class="flex items-center">
            <img src="{{ env('APP_URL') }}/images/logo.png" class="mr-3 h-14" alt="PUBG polska Logo">

        </a>
        <div class="flex md:order-2">
            <div class="hidden lg:block">
                <a href="https://discord.gg/8hZAt7DXdA"
                   target="_blank"
                   class="relative inline-flex items-center justify-center p-0.5 overflow-hidden text-sm font-medium text-white rounded-lg group bg-gradient-to-br from-green-400 to-blue-600 hover:text-white focus:ring-4 focus:outline-none focus:ring-green-800">
              <span
                  class="relative px-5 py-2.5 bg-gray-800 transition-all ease-in duration-75 dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                  {{ __('layout/menu.join_to_discord') }}
              </span>
                </a>
            </div>
            <button data-collapse-toggle="navbar-sticky"
                    type="button"
                    class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg lg:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                    aria-controls="navbar-sticky" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                     xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                          d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                          clip-rule="evenodd"></path>
                </svg>
            </button>
        </div>
        <div class="hidden justify-between items-center w-full lg:flex md:w-auto md:order-1" id="navbar-sticky">
            <ul class="flex flex-col p-4 mt-4 md:flex-row md:space-x-8 md:mt-0 md:text-sm md:font-medium md:items-center">
                <li>
                    <a href="/" class="py-2 pr-4 pl-3 text-white hover:text-blue-700 text-lg">{{ __('layout/menu.home') }}</a>
                </li>
                <li>
                    <a href="/stats"
                       class="py-2 pr-4 pl-3 text-white hover:text-blue-700 text-lg">{{ __('layout/menu.stats') }}</a>
                </li>
                <li>
                    <a href="/ranking"
                       class="py-2 pr-4 pl-3 text-white hover:text-blue-700 text-lg">{{ __('layout/menu.ranking') }}</a>
                </li>
                <li>
                    <a href="/tournament"
                       class="py-2 pr-4 pl-3 text-white hover:text-blue-700 text-lg">{{ __('layout/menu.tournament') }}</a>
                </li>
                <li class="mt-2 lg:mt-0">
                    <a href="https://discord.gg/pubgpolska"
                       target="_blank"
                       class="lg:hidden relative inline-flex items-center justify-center p-0.5  overflow-hidden text-sm font-medium text-white rounded-lg group bg-gradient-to-br from-green-400 to-blue-600 hover:text-white focus:ring-4 focus:outline-none focus:ring-green-800">
                          <span
                              class="relative px-5 py-2.5 bg-gray-800 transition-all ease-in duration-75 dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                              {{ __('layout/menu.join_to_discord') }}
                          </span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
