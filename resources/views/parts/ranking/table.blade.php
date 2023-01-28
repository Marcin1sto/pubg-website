@if($ranking->isNotEmpty())
    <div style="height: max-content;">
        <table class="w-full text-sm text-left text-white font-bold">
            <thead class="text-xs text-gray-100 uppercase bg-gray-800 border-b border-gray-700">
            <tr>
                <th scope="col" class="py-3 px-6">
                    Place
                </th>
                <th scope="col" class="py-3 px-6">
                    Player name
                </th>
                <th scope="col" class="py-3 px-6">
                    Points
                </th>
                <th scope="col" class="py-3 px-6">
                    Rang
                </th>
                <th scope="col" class="py-3 px-6">
                    KD/A
                </th>
                <th scope="col" class="py-3 px-6">
                    K/D
                </th>
            </tr>
            </thead>
            <tbody>
            <?php $position = 4 ?>
            @foreach($ranking as $key => $playerRank)
                <tr class="border-b bg-gray-800 border-gray-700">
                    <td class="py-4 px-6">
                        {{ $position++ }}
                    </td>
                    <td class="py-4 px-6">
                        <a href="{{ env('APP_URL') }}/stats/{{ $playerRank->player->playerName }}">{{ $playerRank->player->playerName }}</a>
                    </td>
                    <th scope="row" class="py-4 px-6 font-medium text-white whitespace-nowrap">
                                    <span
                                        class="bg-red-100 text-gray-900 text-sm font-medium mr-2 px-2.5 py-0.5 rounded">{{$playerRank->points}} pkt</span>
                    </th>
                    <td class="py-4 px-6 uppercase"> {{ $playerRank->rang->name }}</td>
                    <td class="py-4 px-6"> {{ $playerRank->kda }}</td>
                    <td class="py-4 px-6"> {{ $playerRank->kd }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@else
    <div class="mt-10 flex justify-center items-center font-medium text-white">
        Ranking nie został jeszcze ustanowiony.
    </div>
@endif
