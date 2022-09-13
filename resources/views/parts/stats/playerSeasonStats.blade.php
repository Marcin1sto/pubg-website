<div class="w-full mt-10">
    <div class="h-max mb-2 flex items-center">
        <div class="w-1/2 flex justify-start">
            <h1 class="text-white font-bold text-xl">{{ __('layout/stats.actual_season_stats') }} {{ $player->playerName }}</h1>
        </div>
        <div class="w-1/2 flex justify-end">
            <button id="updateSeason" type="button" class="text-blue-700 border border-blue-700 hover:bg-blue-700 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center mr-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:focus:ring-blue-800">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                <span class="sr-only">Icon description</span>
            </button>
        </div>
    </div>

    <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="myTab" data-tabs-toggle="#myTabContent" role="tablist">
            <li class="mr-2 text-white" role="presentation">
                <button class="inline-block p-4 rounded-t-lg border-b-2 text-white" id="tpp-tab" data-tabs-target="#tpp" type="button" role="tab" aria-controls="tpp" aria-selected="false">TPP</button>
            </li>
            <li class="mr-2" role="presentation">
                <button class="inline-block p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 hover:text-gray-300" id="fpp-tab" data-tabs-target="#fpp" type="button" role="tab" aria-controls="fpp" aria-selected="false">FPP</button>
            </li>
        </ul>
    </div>

    <div id="myTabContent">
        <div class="hidden p-4  rounded-lg bg-gray-800" id="tpp" role="tabpanel" aria-labelledby="tpp-tab">
            <div class="grid grid-cols-3 gap-2">
                <div class="rounded rounded-t-lg border-2 border-sky-500">
                    <div class="overflow-x-auto relative shadow-md">
                        <div class="flex justify-center items-center">
                            <p class="p-2 font-bold">SOLO TPP</p>
                        </div>
                        @include('parts.stats.seasonStatsTable', ['details' => $season['solo'], 'type' => 'solo'])
                    </div>
                </div>
                <div class="rounded border-2 border-sky-500">
                    <div class="overflow-x-auto relative shadow-md">
                        <div class="flex justify-center items-center">
                            <p class="p-2 font-bold">DUO TPP</p>
                        </div>
                        @include('parts.stats.seasonStatsTable', ['details' => $season['duo'], 'type' => 'duo'])
                    </div>
                </div>
                <div class="rounded border-2 border-sky-500">
                    <div class="overflow-x-auto relative shadow-md">
                        <div class="flex justify-center items-center">
                            <p class="p-2 font-bold">SQUAD TPP</p>
                        </div>
                        @include('parts.stats.seasonStatsTable', ['details' => $season['squad'], 'type' => 'squad'])
                    </div>
                </div>
            </div>
        </div>
        <div class="hidden p-4 rounded-lg bg-gray-800" id="fpp" role="tabpanel" aria-labelledby="fpp-tab">
            <div class="grid grid-cols-3 gap-2">
                <div class="rounded rounded-t-lg border-2 border-sky-500">
                    <div class="overflow-x-auto relative shadow-md">
                        <div class="flex justify-center items-center">
                            <p class="p-2 font-bold">SOLO FPP</p>
                        </div>
                        @include('parts.stats.seasonStatsTable', ['details' => $season['solo-fpp'], 'type' => 'solo-fpp'])
                    </div>
                </div>
                <div class="rounded border-2 border-sky-500">
                    <div class="overflow-x-auto relative shadow-md">
                        <div class="flex justify-center items-center">
                            <p class="p-2 font-bold">DUO FPP</p>
                        </div>
                        @include('parts.stats.seasonStatsTable', ['details' => $season['duo-fpp'], 'type' => 'duo-fpp'])
                    </div>
                </div>
                <div class="rounded border-2 border-sky-500">
                    <div class="overflow-x-auto relative shadow-md">
                        <div class="flex justify-center items-center">
                            <p class="p-2 font-bold">SQUAD FPP</p>
                        </div>
                        @include('parts.stats.seasonStatsTable', ['details' => $season['squad-fpp'], 'type' => 'squad-fpp'])
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
