<template>
  <div class="min-h-screen bg-[#1a1d21]">
    <!-- Zielony pasek dekoracyjny -->
    <!-- <div class="relative w-full h-24">
      <div class="absolute w-full h-4 bg-[#4ade80] transform -skew-y-3"></div>
    </div> -->

    <div class="container mx-auto px-4 py-8">
      <NuxtLink to="/players" class="text-gray-400 hover:text-gray-200 mb-8 inline-flex items-center">
        <span class="mr-2">←</span> Powrót do listy graczy
      </NuxtLink>

      <!-- Stan ładowania -->
      <div v-if="loading" class="flex justify-center items-center py-8">
        <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-[#4ade80]"></div>
      </div>

      <!-- Stan błędu -->
      <div v-else-if="error" class="bg-red-500/10 text-red-400 p-4 rounded-lg">
        {{ error }}
      </div>

      <!-- Dane gracza -->
      <div v-else-if="player" class="bg-[#2a2d35] rounded-lg p-8 mt-4">
        <div class="flex items-start space-x-6">
          <!-- Avatar -->
          <div class="w-24 h-24 bg-[#353840] rounded-full flex items-center justify-center">
            <span class="text-4xl font-bold text-gray-300">
              {{ player.display_name.charAt(0) }}
            </span>
          </div>

          <!-- Informacje podstawowe -->
          <div class="flex-1">
            <h1 class="text-3xl font-bold text-gray-200 mb-2">{{ player.display_name }}</h1>
            
            <!-- Lista gier -->
            <div class="flex flex-wrap gap-2 mt-4">
              <div 
                v-for="game in player.games" 
                :key="game.id"
                class="flex items-center space-x-2 bg-[#353840] rounded-lg px-4 py-2"
              >
                <span class="text-gray-200">{{ game.name }}</span>
                <span class="text-gray-400 text-sm">({{ game.pivot.platform }})</span>
<!--                <span -->
<!--                  :class="[-->
<!--                    'px-2 py-1 rounded-full text-xs',-->
<!--                    game.pivot.is_active ? 'bg-green-500/20 text-green-400' : 'bg-gray-500/20 text-gray-400'-->
<!--                  ]"-->
<!--                >-->
<!--                  {{ game.pivot.is_active ? 'Aktywny' : 'Nieaktywny' }}-->
<!--                </span>-->
              </div>
            </div>
          </div>
        </div>

        <!-- Statystyki -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
          <div class="bg-[#353840] rounded-lg p-6">
            <h3 class="text-gray-400 text-sm mb-2">K/D Ratio</h3>
            <p class="text-2xl font-bold text-gray-200">{{ player.kd }}</p>
          </div>
          <div class="bg-[#353840] rounded-lg p-6">
            <h3 class="text-gray-400 text-sm mb-2">Win Rate</h3>
            <p class="text-2xl font-bold text-gray-200">{{ player.winRate }}%</p>
          </div>
          <div class="bg-[#353840] rounded-lg p-6">
            <h3 class="text-gray-400 text-sm mb-2">Rozegrane mecze</h3>
            <p class="text-2xl font-bold text-gray-200">{{ player.matches }}</p>
          </div>
        </div>

        <!-- Historia meczy -->
        <div class="mt-8">
          <h2 class="text-xl font-bold text-gray-200 mb-4">Historia meczy</h2>
          <div class="bg-[#353840] rounded-lg overflow-hidden">
            <table class="w-full">
              <thead>
                <tr class="border-b border-gray-700">
                  <th class="px-6 py-4 text-left text-sm font-semibold text-gray-300">Data</th>
                  <th class="px-6 py-4 text-left text-sm font-semibold text-gray-300">Mapa</th>
                  <th class="px-6 py-4 text-left text-sm font-semibold text-gray-300">K/D</th>
                  <th class="px-6 py-4 text-left text-sm font-semibold text-gray-300">Wynik</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="match in recentMatches" 
                    :key="match.id"
                    class="border-b border-gray-700">
                  <td class="px-6 py-4 text-gray-300">{{ match.date }}</td>
                  <td class="px-6 py-4 text-gray-300">{{ match.map }}</td>
                  <td class="px-6 py-4 text-gray-300">{{ match.kd }}</td>
                  <td class="px-6 py-4">
                    <span :class="{
                      'px-2 py-1 rounded text-sm font-medium': true,
                      'bg-green-500/20 text-green-400': match.result === 'Wygrana',
                      'bg-red-500/20 text-red-400': match.result === 'Przegrana'
                    }">
                      {{ match.result }}
                    </span>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { usePlayerApi } from '~/composables/usePlayerApi';

const route = useRoute();
const { player, loading, error, fetchPlayer } = usePlayerApi();

onMounted(async () => {
  const id = parseInt(route.params.id as string);
  if (isNaN(id)) {
    navigateTo('/players');
    return;
  }
  await fetchPlayer(id);
});

interface Match {
  id: number;
  date: string;
  map: string;
  kd: number;
  result: 'Wygrana' | 'Przegrana';
}

// Przykładowa historia meczy
const recentMatches = ref<Match[]>([
  {
    id: 1,
    date: "2024-03-18",
    map: "Erangel",
    kd: 4.5,
    result: "Wygrana"
  },
  {
    id: 2,
    date: "2024-03-17",
    map: "Miramar",
    kd: 2.8,
    result: "Przegrana"
  },
  {
    id: 3,
    date: "2024-03-17",
    map: "Sanhok",
    kd: 3.2,
    result: "Wygrana"
  },
  {
    id: 4,
    date: "2024-03-16",
    map: "Erangel",
    kd: 1.5,
    result: "Przegrana"
  },
  {
    id: 5,
    date: "2024-03-16",
    map: "Vikendi",
    kd: 5.0,
    result: "Wygrana"
  }
]);
</script> 