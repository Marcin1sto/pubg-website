<script setup lang="ts">
const props = defineProps({
  color: {
    type: String,
    default: '#4285F4',
  },
});
</script>

<template>
  <div class="badge" :style="`background-color: ${color}`"><slot></slot></div>
</template>

<style scoped lang="scss">
.badge {
  color: white;
  border-radius: 4px;
  font-size: 10px;
  font-weight: 600;
  line-height: 10px;
  padding: 4px;
}
</style>