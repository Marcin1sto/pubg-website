@if($player->discordRanking)
    <div class="text-white bg-gray-800 mt-4">
        <div class="overflow-x-auto relative shadow-md">
            <div class="flex justify-center items-center">
                <p class="uppercase px-2 py-3">{{ $player->discordRanking->rang->name }} </p>
                {{ $player->discordRanking->points }} pkt.
            </div>
            <table class="w-full text-sm text-left text-white bg-gray-800">
                <tbody class="border-b bg-gray-800 border-gray-700">
                <tr class="border-b border-t">
                    <th scope="row"
                        class="py-4 px-6 font-medium whitespace-nowrap ">
                        K/D
                    </th>
                    <td class="py-4 px-6">
                        {{ $player->discordRanking->kd }}
                    </td>
                    <th scope="row"
                        class="py-4 px-6 font-medium whitespace-nowrap ">
                        KDA
                    </th>
                    <td class="py-4 px-6">
                        {{ $player->discordRanking->kda }}
                    </td>
                </tr>
                <tr class="border-b bg-gray-800 ">
                    <th scope="row"
                        class="py-4 px-6 font-medium whitespace-nowrap ">
                        Wins
                    </th>
                    <td class="py-4 px-6">
                        {{ $player->discordRanking->wins }}
                    </td>
                    <td class="py-4 px-6">
                        Wins Percent
                    </td>
                    <td class="py-4 px-6">
                        {{ $player->discordRanking->percent_wins }} %
                    </td>
                </tr>
                <tr class="border-b bg-gray-800 ">
                    <th scope="row"
                        class="py-4 px-6 font-medium whitespace-nowrap ">
                        Matches
                    </th>
                    <td class="py-4 px-6">
                        {{ $player->discordRanking->matches }}
                    </td>
                    <td class="py-4 px-6">
                        Headshot Percent
                    </td>
                    <td class="py-4 px-6">
                        {{ $player->discordRanking->percent_headshot }} %
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endif
