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
                @click="selectGame(game)"
                :class="[
                  'flex items-center space-x-2 bg-[#353840] rounded-lg px-4 py-2 cursor-pointer transition-colors',
                  selectedGame?.id === game.id ? 'bg-[#4ade80] text-gray-900' : 'hover:bg-[#404550]'
                ]"
              >
                <span>{{ game.name }}</span>
                <span class="text-sm opacity-75">({{ game.pivot.platform }})</span>
              </div>
            </div>
          </div>
        </div>

        <!-- Statystyki -->
        <div v-if="selectedGame" class="mt-8">
          <!-- Stan ładowania statystyk -->
          <div v-if="loadingStats" class="flex justify-center items-center py-8">
            <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-[#4ade80]"></div>
          </div>

          <!-- Błąd statystyk -->
          <div v-else-if="statsError" class="bg-red-500/10 text-red-400 p-4 rounded-lg">
            {{ statsError }}
          </div>

          <!-- Statystyki -->
          <div v-else class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-[#353840] rounded-lg p-6">
              <h3 class="text-gray-400 text-sm mb-2">K/D Ratio</h3>
              <p class="text-2xl font-bold text-gray-200">{{ gameStats.kd }}</p>
            </div>
            <div class="bg-[#353840] rounded-lg p-6">
              <h3 class="text-gray-400 text-sm mb-2">Win Rate</h3>
              <p class="text-2xl font-bold text-gray-200">{{ gameStats.winRate }}%</p>
            </div>
            <div class="bg-[#353840] rounded-lg p-6">
              <h3 class="text-gray-400 text-sm mb-2">Rozegrane mecze</h3>
              <p class="text-2xl font-bold text-gray-200">{{ gameStats.matches }}</p>
            </div>
          </div>

          <!-- Historia meczy -->
          <div v-if="!loadingStats && !statsError" class="mt-8">
            <h2 class="text-xl font-bold text-gray-200 mb-4">Historia meczy</h2>
            <div class="bg-[#353840] rounded-lg overflow-hidden">
              <table class="w-full">
                <thead>
                  <tr class="border-b border-gray-700">
                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-300">Data</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-300">Mapa</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-300">Kills</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-300">Zagrano</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-300">Wynik</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="match in gameStats.recentMatches" 
                      :key="match.id"
                      class="border-b border-gray-700">
                    <td class="px-6 py-4 text-gray-300">{{ match.date }}</td>
                    <td class="px-6 py-4 text-gray-300">{{ match.mapName }}</td>
                    <td class="px-6 py-4 text-gray-300">{{ match.kills }}</td>
                    <td class="px-6 py-4 text-gray-300">{{ match.played_at }}</td>
                    <td class="px-6 py-4">
                      <span :class="{
                        'px-2 py-1 rounded text-sm font-medium': true,
                        'bg-green-500/20 text-green-400': match.winPlace === 1,
                        'bg-red-500/20 text-red-400': match.winPlace !== 1
                      }">
                        {{ match.winPlace === 1 ? 'Wygrana' : 'Przegrana' }}
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
  </div>
</template>

<script setup lang="ts">
import { usePlayerApi } from '~/composables/usePlayerApi';
import {useRuntimeConfig} from "#app";

interface Game {
  id: number;
  name: string;
  pivot: {
    platform: string;
    is_active: boolean;
  };
}

interface Match {
  id: number;
  date: string;
  map: string;
  kd: number;
  result: 'Wygrana' | 'Przegrana';
}

interface GameStats {
  kd: number;
  winRate: number;
  matches: number;
  recentMatches: Match[];
}

const route = useRoute();
const { player, loading, error, fetchPlayer } = usePlayerApi();
const config = useRuntimeConfig()

const selectedGame = ref<Game | null>(null);
const gameStats = ref<GameStats>({
  kd: 0,
  winRate: 0,
  matches: 0,
  recentMatches: []
});

const loadingStats = ref(false);
const statsError = ref<string | null>(null);

const selectGame = async (game: Game) => {
  selectedGame.value = game;
  loadingStats.value = true;
  statsError.value = null;
  
  try {
    const response = await fetch(`${config.public.apiBaseUrl}/api/player/${route.params.id}/game/${game.slug}`);
    const data = await response.json();
    
    if (!response.ok) {
      throw new Error(data.message || 'Wystąpił błąd podczas pobierania statystyk');
    }
    
    if (data.correct) {
      gameStats.value = data.data;
    } else {
      throw new Error(data.message || 'Nie udało się pobrać statystyk');
    }
  } catch (err) {
    console.error('Błąd podczas pobierania statystyk:', err);
    statsError.value = err instanceof Error ? err.message : 'Wystąpił błąd podczas pobierania statystyk';
  } finally {
    loadingStats.value = false;
  }
};

onMounted(async () => {
  const id = parseInt(route.params.id as string);
  if (isNaN(id)) {
    navigateTo('/players');
    return;
  }
  await fetchPlayer(id);
});
</script> 