<?php
    $stats = $season[$type]->first();
?>
<table class="w-full text-sm text-left text-white">
    <tbody>
    <tr class="border-b border-t dark:bg-gray-900 ">
        <th scope="row"
            class="py-4 px-6 font-medium whitespace-nowrap ">
            K/D
        </th>
        <td class="py-4 px-6 border-r">
{{--            {{ dd($stats) }}--}}
        </td>
        <td class="py-4 px-6">
            Avg. Damage
        </td>
        <td class="py-4 px-6">

        </td>
    </tr>
    <tr class="border-b dark:bg-gray-900 ">
        <th scope="row"
            class="py-4 px-6 font-medium whitespace-nowrap ">
            Wins
        </th>
        <td class="py-4 px-6 border-r">
            {{ $stats->wins }}
        </td>
        <td class="py-4 px-6">
            Top 10%
        </td>
        <td class="py-4 px-6">
            {{ $stats->top10s }}
        </td>
    </tr>
    <tr class="border-b dark:bg-gray-900 ">
        <th scope="row"
            class="py-4 px-6 font-medium whitespace-nowrap ">
            Longest kill
        </th>
        <td class="py-4 px-6 border-r">
            {{ $stats->longestKill }}
        </td>
        <td class="py-4 px-6">
            Headshot
        </td>
        <td class="py-4 px-6">
            {{ $stats->headshotKills }}
        </td>
    </tr>
    <tr class="border-b dark:bg-gray-900 ">
        <th class="py-4 px-6 font-medium whitespace-nowrap ">
            Avg. Rank
        </th>
        <td class="py-4 px-6 border-r">

        </td>
        <td class="py-4 px-6">
            Avg. survived time
        </td>
        <td class="py-4 px-6">
            {{ $stats->timeSurvived }} min.
        </td>
    </tr>
    <tr class="">
        <th scope="row"
            class="py-4 px-6 font-medium whitespace-nowrap ">
            KDA
        </th>
        <td class="py-4 px-6 border-r">

        </td>
        <td class="py-4 px-6">
            Most Kills
        </td>
        <td class="py-4 px-6">
            {{ $stats->roundMostKills }}
        </td>
    </tr>
    </tbody>
</table>
