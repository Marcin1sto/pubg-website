<template>
  <div class="flex flex-wrap gap-4 justify-center">
    <div v-for="player in players" :key="player.id" 
         class="bg-[#2a2d35] rounded-lg p-4 hover:shadow-lg transition-shadow h-[280px] w-[200px] flex flex-col justify-between">
      <div class="flex flex-col items-center">
        <div class="w-12 h-12 bg-[#353840] rounded-full flex items-center justify-center mb-2">
          <span class="text-xl font-bold text-gray-300">
            {{ player.name.charAt(0) }}
          </span>
        </div>
        <h2 class="text-lg font-semibold text-gray-200 text-center">{{ player.name }}</h2>
        <p class="text-sm text-gray-400">{{ player.role }}</p>
      </div>
      
      <div class="space-y-1 text-sm">
        <div class="flex justify-between">
          <span class="text-gray-400">K/D Ratio:</span>
          <span class="font-medium text-gray-200">{{ player.kdRatio }}</span>
        </div>
        <div class="flex justify-between">
          <span class="text-gray-400">Win Rate:</span>
          <span class="font-medium text-gray-200">{{ player.winRate }}%</span>
        </div>
        <div class="flex justify-between">
          <span class="text-gray-400">Matches:</span>
          <span class="font-medium text-gray-200">{{ player.matches }}</span>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
interface Player {
  id: number;
  name: string;
  role: string;
  kdRatio: number;
  winRate: number;
  matches: number;
}

const players: Player[] = [
  {
    id: 1,
    name: "JAN KOWALSKI",
    role: "Sniper",
    kdRatio: 2.5,
    winRate: 65,
    matches: 150
  },
  {
    id: 2,
    name: "ANNA NOWAK",
    role: "Support",
    kdRatio: 1.8,
    winRate: 58,
    matches: 120
  },
  {
    id: 3,
    name: "PIOTR WIŚNIEWSKI",
    role: "Assault",
    kdRatio: 3.2,
    winRate: 72,
    matches: 200
  },
  {
    id: 4,
    name: "MARIA DĄBROWSKA",
    role: "Tank",
    kdRatio: 1.5,
    winRate: 55,
    matches: 180
  },
  {
    id: 5,
    name: "TOMASZ LEWANDOWSKI",
    role: "Sniper",
    kdRatio: 2.8,
    winRate: 68,
    matches: 160
  }
];
</script> 