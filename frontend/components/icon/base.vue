<template>
  <div>
    <component
        :is="iconComponent"
        role="img"
    />
  </div>
</template>

<script setup lang="ts">
  import { defineAsyncComponent } from 'vue';

  // Funkcja do ładowania komponentów ikon
  async function loadIcons() {
    const icons = {};
    const iconFiles = import.meta.glob('./icons/*.vue');
    for (const path in iconFiles) {
      const iconName = path.split('/').pop().replace('.vue', '');
      icons[iconName] = defineAsyncComponent(() => iconFiles[path]());
    }
    return icons;
  }

  const props = defineProps({
    name: {
      type: String,
      required: false,
      default: 'package'
    }
  });

  const icons = await loadIcons();
  const iconComponent = computed(() => icons[props.name]);
</script>