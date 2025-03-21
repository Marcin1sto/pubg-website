<template>
  <div class="mt-12">
    <!-- Stan ładowania -->
    <div v-if="loading" class="flex justify-center items-center py-8">
      <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-[#4ade80]"></div>
    </div>

    <!-- Stan błędu -->
    <div v-else-if="error" class="bg-red-500/10 text-red-400 p-4 rounded-lg">
      {{ error }}
    </div>

    <!-- Tabela graczy -->
    <div v-else class="bg-[#2a2d35] rounded-lg overflow-hidden">
      <table class="w-full">
        <thead>
          <tr class="border-b border-gray-700">
            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-300">Nickname</th>
            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-300">Gry</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="player in players" 
              :key="player.id"
              class="border-b border-gray-700 hover:bg-[#353840] transition-colors cursor-pointer"
              @click="navigateToPlayer(player.id)">
            <td class="px-6 py-4">
              <div class="flex items-center space-x-3">
                <div class="w-8 h-8 bg-[#353840] rounded-full flex items-center justify-center">
                  <span class="text-sm font-medium text-gray-300">
                    {{ player.display_name.charAt(0) }}
                  </span>
                </div>
                <span class="text-gray-200">{{ player.display_name }}</span>
              </div>
            </td>
            <td class="px-6 py-4">
              <div class="flex flex-wrap gap-2">
                <span 
                  v-for="game in player.games" 
                  :key="game.id"
                  class="px-2 py-1 text-xs rounded-full bg-[#353840] text-gray-300"
                >
                  {{ game.name }}
                </span>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Paginacja -->
    <div v-if="!loading && !error && pagination" class="mt-6 flex justify-between items-center text-gray-300">
      <div class="text-sm">
        Pokazuje {{ pagination.from }}-{{ pagination.to }} z {{ pagination.total }} wyników
      </div>
      
      <div class="flex space-x-2">
        <button 
          v-if="links?.prev"
          @click="changePage(pagination.current_page - 1)"
          class="px-4 py-2 rounded-lg text-sm font-medium transition-colors bg-[#353840] hover:bg-[#404450]"
        >
          Poprzednia
        </button>
        
        <button 
          v-for="page in pageNumbers" 
          :key="page"
          @click="changePage(page)"
          :class="[
            'px-4 py-2 rounded-lg text-sm font-medium transition-colors',
            page === pagination.current_page ? 'bg-[#4ade80] text-gray-900' : 'bg-[#353840] hover:bg-[#404450]'
          ]"
        >
          {{ page }}
        </button>

        <button 
          v-if="links?.next"
          @click="changePage(pagination.current_page + 1)"
          class="px-4 py-2 rounded-lg text-sm font-medium transition-colors bg-[#353840] hover:bg-[#404450]"
        >
          Następna
        </button>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, onMounted, computed } from 'vue';
import { useRouter } from 'vue-router';
import { usePlayersApi } from '~/composables/usePlayersApi';

const router = useRouter();
const { players, loading, error, pagination, links, fetchPlayers } = usePlayersApi();

const navigateToPlayer = (playerId: number) => {
  router.push(`/players/${playerId}`);
};

// Generowanie numerów stron do wyświetlenia
const pageNumbers = computed(() => {
  if (!pagination.value) return [];
  
  const current = pagination.value.current_page;
  const last = pagination.value.last_page;
  const delta = 2;
  const range = [];
  
  for (let i = Math.max(2, current - delta); i <= Math.min(last - 1, current + delta); i++) {
    range.push(i);
  }
  
  if (current - delta > 2) {
    range.unshift('...');
  }
  range.unshift(1);
  
  if (current + delta < last - 1) {
    range.push('...');
  }
  if (last > 1) {
    range.push(last);
  }
  
  return range;
});

const changePage = (page: number) => {
  if (typeof page === 'number') {
    fetchPlayers(page);
  }
};

onMounted(() => {
  fetchPlayers();
});
</script> 