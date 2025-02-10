<template>
  <navigation />
  <DefaultLayoutMobileMenu />
  <slot />
  <Footer />
</template>

<script setup lang="ts">
useHead({
  titleTemplate: (titleChunk) => {
    return titleChunk ? `${ titleChunk } - BLPaczka` : 'BLPaczka';
  },
});
</script>

<style scoped></style>