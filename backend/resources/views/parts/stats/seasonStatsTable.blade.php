<?php
    $stats = $season[$type]->first();
?>
<table class="w-full text-sm text-left text-white border-gray-700">
    <tbody>
    <tr class="border-b-2 border-gray-700">
        <th scope="row" class="py-4 font-medium whitespace-nowrap ">
            K/D
        </th>
        <td class="py-4 px-6 border-r-2 border-gray-700">

        </td>
        <td class="py-4 px-6">
            Avg. Damage
        </td>
        <td class="py-4">

        </td>
    </tr>
    <tr class="border-b-2 border-gray-700">
        <th scope="row" class="py-4 font-medium whitespace-nowrap ">
            Wins
        </th>
        <td class="py-4 px-6 border-r-2 border-gray-700">
            {{ $stats->wins }}
        </td>
        <td class="py-4 px-6">
            Top 10%
        </td>
        <td class="py-4">
            {{ $stats->top10s }}
        </td>
    </tr>
    <tr class="border-b-2 border-gray-700">
        <th scope="row" class="py-4 font-medium whitespace-nowrap ">
            Longest kill
        </th>
        <td class="py-4 px-6 border-r-2 border-gray-700">
            {{ $stats->longestKill }}
        </td>
        <td class="py-4 px-6">
            Headshot
        </td>
        <td class="py-4">
            {{ $stats->headshotKills }}
        </td>
    </tr>
    <tr class="border-b-2 border-gray-700">
        <th class="py-4 font-medium whitespace-nowrap ">
            Avg. Rank
        </th>
        <td class="py-4 px-6 border-r-2 border-gray-700">

        </td>
        <td class="py-4 px-6">
            Avg. survived time
        </td>
        <td class="py-4 ">
            {{ $stats->timeSurvived }} min.
        </td>
    </tr>
    <tr class="">
        <th scope="row" class="py-4 font-medium whitespace-nowrap ">
            KDA
        </th>
        <td class="py-4 px-6 border-r-2 border-gray-700">

        </td>
        <td class="py-4 px-6">
            Most Kills
        </td>
        <td class="py-4 ">
            {{ $stats->roundMostKills }}
        </td>
    </tr>
    </tbody>
</table>

