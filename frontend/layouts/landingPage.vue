<template>
  <navigation-landing-page />
  <slot />
  <footer-landing-page />
</template>

<script setup lang="ts">
useHead({
  titleTemplate: (titleChunk) => {
    return titleChunk ? `${ titleChunk } - BLPaczka` : 'BLPaczka';
  },
});
</script>

<style scoped></style>