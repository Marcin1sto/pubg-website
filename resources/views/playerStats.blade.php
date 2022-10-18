@extends('layout')

@section('content')
    <div class="flex flex-col" style="
        height: 400px;
        background: url('/images/playerprofile1.jpg') no-repeat center;
        background-size: cover;
        background-position: top">
        <div class="flex justify-start items-start">
            <p class="text-white font-bold p-5 font-medium" style="font-size: 36px">{{ $player->playerName }}</p>
        </div>
        @if($player->discordRanking)
            <div class="flex grow justify-end items-end">
                <div class="flex justify-center items-center p-5">
                    <p class="text-white font-bold uppercase p-5 font-medium"
                       style="font-size: 25px">{{ $player->discordRanking->rang->name }}</p>
                    <img height="104" width="104" src="/images/rangs/{{ $player->discordRanking->rang->name }}.png">
                </div>
            </div>
        @endif
    </div>
{{--  TODO  --}}
{{--    <div class="bg-gray-700 h-12">--}}
{{--        <div class="container mx-auto h-full text-white flex items-center">--}}
{{--            <div class="flex h-full items-center">--}}
{{--                <div class="flex items-center border-x border-gray-500 h-full hover:bg-blue-700">--}}
{{--                    <a href="#" class="px-3">Historia</a>--}}
{{--                </div>--}}
{{--                <div class="flex items-center border-r border-gray-500 h-full hover:bg-blue-700">--}}
{{--                    <a href="#" class="px-3">Mecze</a>--}}
{{--                </div>--}}
{{--                <div class="flex items-center border-r border-gray-500 h-full hover:bg-blue-700">--}}
{{--                    <a href="#" class="px-3">Bronie</a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
    <div class="container mx-auto h-screen">
        @include('parts.stats.playerDiscordStats')
        <div class="mt-2" style="margin-bottom: 50px;">
            <div class="grid grid-cols-2 p-3 lg:p-0">
                <div class="flex items-center">
                    <h1 class="text-white font-bold text-xl">{{ __('layout/stats.matches') }}: ({{ $countMatches }})</h1>
                </div>
                <div class="flex justify-end items-center">
                    @if($player->canUpdateMatches())
                        <button id="updateMatches" type="button"
                                class="animate-bounce text-blue-700 border border-blue-700 hover:bg-blue-700 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm p-1.5 text-center inline-flex items-center mr-2">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                            <span class="sr-only">Icon description</span>
                        </button>
                    @endif
                    @include('parts.stats.matchesPagination')
                </div>
            </div>
            <div class="overflow-x-auto relative">
                <table class="w-full text-sm text-left text-white font-bold">
                    <thead class="text-xs text-gray-100 uppercase bg-gray-800 border-b border-gray-700">
                    <tr>
                        <th scope="col" class="py-3 px-6">
                            {{ __('layout/stats.place') }}
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Typ
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Mapa
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Sezon
                        </th>
                        <th scope="col" class="py-3 px-6">
                            {{ __('layout/stats.kills') }}
                        </th>
                        <th scope="col" class="py-3 px-6">
                            {{ __('layout/stats.damage') }}
                        </th>
                        <th scope="col" class="py-3 px-6">
                            {{ __('layout/stats.alive_time') }}
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($matches as $match)
                        <tr class="border-b bg-gray-800 border-gray-700">
                            <th scope="row" class="py-4 px-6 font-medium text-white whitespace-nowrap">
                                @if($match->winPlace == 1)
                                    <span
                                        class="bg-yellow-100 text-yellow-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded">#{{$match->winPlace}}</span>
                                @elseif ($match->winPlace >= 1 && $match->winPlace <= 5)
                                    <span
                                        class="bg-green-100 text-yellow-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded">#{{$match->winPlace}}</span>
                                @else
                                    <span
                                        class="bg-red-100 text-gray-900 text-sm font-medium mr-2 px-2.5 py-0.5 rounded">#{{$match->winPlace}}</span>
                                @endif
                            </th>
                            <td class="py-4 px-6 uppercase">
                                @if($match->gameMode == 'normal-squad') custom @else {{ $match->gameMode }} @endif
                            </td>
                            <td>
                                {{ \App\Enums\PubgMapEnum::getName($match->mapName) }}
                            </td>
                            <td>
                                {{ $match->season->name }}
                            </td>
                            <td class="py-4 px-6">
                                {{ $match->kills }}
                            </td>
                            <td class="py-4 px-6">
                                {{ $match->damageDealt }} dmg.
                            </td>
                            <td class="py-4 px-6">
                                {{ (int)($match->timeSurvived / 60) }} min.
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="p-3 lg:p-0">
                @include('parts.stats.matchesPagination')
            </div>
        </div>
        <div class="mb-5">
            @include('parts.stats.playerSeasonStats', ['player' => $player, 'season' => $season])
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('#updateMatches').on('click', function () {
            $('#loader').removeClass('hidden');
            $.ajax({
                url: <?php env('APP_URL') ?>'/api/matches/<?php echo $player->playerName ?>',
                method: 'GET'
            }).done(function () {
                location.reload();
            })
        })

        $('#updateSeason').on('click', function () {
            $('#loader').removeClass('hidden');
            $.ajax({
                url: <?php env('APP_URL') ?>'/api/season/<?php echo $player->playerName ?>',
                method: 'GET'
            }).done(function () {
                location.reload();
            })
        })
    </script>
@append
