@extends('layout')

@section('content')
    <div class="container mx-auto h-screen">
        <div class="text-white flex justify-center w-full">
            @include('parts.stats.playerSeasonStats', ['player' => $player, 'season' => $season])
        </div>

        <div class=" mt-[25px]" style="margin-bottom: 50px;">
            <div class="grid grid-cols-2">
                <div class="flex items-center">
                    <h1 class="text-white font-bold text-xl">Matches: {{ count($player->matches) }}</h1>
                </div>
                <div class="flex justify-end items-center">
                    @include('parts.stats.matchesPagination')
                </div>
            </div>
            <div class="overflow-x-auto relative mt-[25px]">
                <table class="w-full text-sm text-left text-white font-bold">
                    <thead class="text-xs text-gray-100 uppercase bg-gray-800 border-b border-gray-700">
                    <tr>
                        <th scope="col" class="py-3 px-6">
                            Place
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Kills
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Damage
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Alive time.
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
            <div class="mt-[25px]">
                @include('parts.stats.matchesPagination')
            </div>
        </div>
    </div>
@endsection
