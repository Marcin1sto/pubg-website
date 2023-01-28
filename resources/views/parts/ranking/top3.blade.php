@if($top3->isNotEmpty() && $top3->get(0) && $top3->get(1) && $top3->get(2))
    <div class="scoreboard hidden md:block">
        <div class="scoreboard__podiums">
            <div class="scoreboard__podium js-podium" data-height="200px">
                <div class="scoreboard__podium-base scoreboard__podium-base--second">
                    <div class="scoreboard__podium-rank">2</div>
                </div>
                <div class="scoreboard__podium-number">
                    <a href="{{ env('APP_URL') }}/stats/{{ $top3->get(1)->player->playerName }}">{{ $top3->get(1)->player->playerName }}</a>
                    <small>
                        <span class="js-podium-data text-white">{{ $top3->get(1)->points }} pkt</span>
                    </small>
                </div>

            </div>
            <div class="scoreboard__podium js-podium" data-height="250px">
                <div class="scoreboard__podium-base scoreboard__podium-base--first">
                    <div class="scoreboard__podium-rank">1</div>

                </div>
                <div class="scoreboard__podium-number">
                    <a href="{{ env('APP_URL') }}/stats/{{ $top3->get(0)->player->playerName }}">{{ $top3->get(0)->player->playerName }}</a>
                    <small>
                        <span class="js-podium-data text-white">{{ $top3->get(0)->points }} pkt</span>
                    </small>
                </div>
            </div>
            <div class="scoreboard__podium js-podium" data-height="150px">
                <div class="scoreboard__podium-base scoreboard__podium-base--third">
                    <div class="scoreboard__podium-rank">3</div>
                </div>
                <div class="scoreboard__podium-number">
                    <a href="{{ env('APP_URL') }}/stats/{{ $top3->get(2)->player->playerName }}">{{ $top3->get(2)->player->playerName }}</a>
                    <small>
                        <span class="js-podium-data text-white">{{ $top3->get(2)->points }} pkt</span>
                    </small>
                </div>
            </div>
        </div>
    </div>
    <div class="mb-6 md:hidden">
        <h1 class="text-white">Top 3</h1>
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
            <?php $positionTop3 = 1 ?>
            @foreach($top3 as $key => $playerRank)
                <tr class="border-b bg-gray-800 border-gray-700">
                    <td class="py-4 px-6">
                        {{ $positionTop3++ }}
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
@endif
