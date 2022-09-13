<div class="w-full bg-gray-800 text-white h-[90px] flex items-center p-5">
    <div class="w-full grid grid-cols-2">
        <div class="logo flex items-center justify-start">
            <h1 class="px-5 font-medium text-3xl">PUBG <span class="font-bold italic text-2xl">POLSKA</span></h1>
        </div>

        <div class="menu px-6 flex justify-end items-center">
            <a href="/" class="px-5">{{ __('layout/menu.home') }}</a>
            <a href="/stats" class="px-5">{{ __('layout/menu.stats') }}</a>
            <a href="/ranking" class="px-5">{{ __('layout/menu.ranking') }}</a>
            <a href="https://discord.gg/pubgpolska"
               target="_blank"
               class="ml-3 relative inline-flex items-center justify-center p-0.5 mb-2 mr-2 overflow-hidden text-sm font-medium text-white rounded-lg group bg-gradient-to-br from-green-400 to-blue-600 hover:text-white focus:ring-4 focus:outline-none focus:ring-green-800">
              <span class="relative px-5 py-2.5 bg-gray-800 transition-all ease-in duration-75 dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                  {{ __('layout/menu.join_to_discord') }}
              </span>
            </a>
        </div>
    </div>
</div>
