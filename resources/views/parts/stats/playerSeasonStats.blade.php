<div class="w-full mt-[25px]">
    <div class="h-5">
        <h1 class="text-white font-bold text-xl">Actual season stats: {{ $player->playerName }}</h1>
    </div>
    <div class="mt-[25px]" id="accordion-collapse" data-accordion="collapse">
        <h2 id="accordion-collapse-heading-1">
            <button type="button" class="flex items-center border-b-0 justify-between bg-gray-800 w-full p-5 font-medium text-left border border-gray-200 rounded-t-xl" data-accordion-target="#accordion-collapse-body-1" aria-expanded="true" aria-controls="accordion-collapse-body-1">
                <span style="color: white">TTP</span>
                <svg data-accordion-icon="" class="w-6 h-6 rotate-180 shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
            </button>
        </h2>
        <div id="accordion-collapse-body-1" class="hidden" aria-labelledby="accordion-collapse-heading-1">
            <div class="p-2 bg-gray-800 border-r border-b border-l border-gray-200">
                <div class="grid grid-cols-3 gap-2">
                    <div class="rounded rounded-t-lg border-2 border-sky-500">
                        <div class="overflow-x-auto relative shadow-md">
                            <div class="flex justify-center items-center">
                                <p class="p-2 font-bold">SOLO TTP</p>
                            </div>
                            @include('parts.stats.seasonStatsTable', ['details' => $season['solo'], 'type' => 'solo'])
                        </div>
                    </div>
                    <div class="rounded border-2 border-sky-500">
                        <div class="overflow-x-auto relative shadow-md">
                            <div class="flex justify-center items-center">
                                <p class="p-2 font-bold">DUO TTP</p>
                            </div>
                            @include('parts.stats.seasonStatsTable', ['details' => $season['duo'], 'type' => 'duo'])
                        </div>
                    </div>
                    <div class="rounded border-2 border-sky-500">
                        <div class="overflow-x-auto relative shadow-md">
                            <div class="flex justify-center items-center">
                                <p class="p-2 font-bold">SQUAD TTP</p>
                            </div>
                            @include('parts.stats.seasonStatsTable', ['details' => $season['squad'], 'type' => 'squad'])
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <h2 id="accordion-collapse-heading-2">
            <button type="button" class="flex items-center focus:border-b-0  justify-between bg-gray-800 w-full p-5 font-medium text-left border border-t-0 border-gray-200" data-accordion-target="#accordion-collapse-body-2" aria-expanded="true" aria-controls="accordion-collapse-body-2">
                <span style="color: white">FPP</span>
                <svg data-accordion-icon="" class="w-6 h-6 rotate-180 shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
            </button>
        </h2>
        <div id="accordion-collapse-body-2" class="hidden" aria-labelledby="accordion-collapse-heading-2">
            <div class="p-2 bg-gray-800 border border-t-0 border-gray-200">
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
</div>
