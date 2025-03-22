<template>
  <div class="min-h-screen bg-[#1a1d21]">
    <!-- Zielony pasek dekoracyjny -->
    <!-- <div class="relative w-full h-24">
      <div class="absolute w-full h-4 bg-[#4ade80] transform -skew-y-3"></div>
    </div> -->

    <div class="container mx-auto px-4 py-8">
<!--      <h1 class="text-3xl font-bold mb-8 text-white">TOP GRACZE</h1>-->
<!--      <TopPlayers />-->
<!--      -->
      <h2 class="text-2xl font-bold mb-6 text-white mt-16">LISTA GRACZY</h2>
      <PlayersTable />
    </div>
  </div>
</template>

<script setup lang="ts">
import TopPlayers from '~/components/TopPlayers.vue'
import PlayersTable from '~/components/PlayersTable.vue'
</script>

<style>

</style>