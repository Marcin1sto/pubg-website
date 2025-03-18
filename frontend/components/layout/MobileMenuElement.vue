<script setup lang="ts">
defineProps<{
  text: string;
  href?: string;
  items?: Array<{
    title: string;
    route: string;
  }>;
}>();

const isOpen = ref(false);
</script>

<template>
  <div v-if="!items" class="mobile-menu-item">
    <NuxtLink :to="href" class="text-[#fff] text-[18px] font-medium hover:text-[#45f882] transition-all duration-500">
      {{ text }}
    </NuxtLink>
  </div>
  <div v-else class="mobile-menu-item">
    <div @click="isOpen = !isOpen" class="flex items-center justify-between cursor-pointer">
      <span class="text-[#fff] text-[18px] font-medium hover:text-[#45f882] transition-all duration-500">{{ text }}</span>
      <i class="fas text-[#45f882]" :class="isOpen ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
    </div>
    <div v-if="isOpen" class="mt-2 pl-4 border-l-2 border-[#45f882]">
      <NuxtLink v-for="item in items" :key="item.title" :to="item.route"
                class="block text-[#fff] text-[16px] font-medium hover:text-[#45f882] transition-all duration-500 mb-2">
        {{ item.title }}
      </NuxtLink>
    </div>
  </div>
</template>

<style scoped>
.mobile-menu-item {
  @apply mb-4;
}
</style> 