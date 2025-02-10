<script setup lang="ts">
defineProps({
  loading: Boolean,
  withText: {
    type: Boolean,
    default: true
  }
})

/**
 * Pamietaj aby kontener na loader mial position: relative
 */
</script>

<template>
  <div class="loader" :style="loading ? 'display: block;' : 'display: none;'">
    <div class="loader-spinner">
      <div class="spinner-content">
        <span v-if="withText" class="spinner-content--text"><slot></slot></span>
        <NuxtImg src="gif/animation-02.gif" class="img"/>
      </div>
    </div>
  </div>
</template>

<style lang="scss" scoped>
.loader {
  z-index: 1;
  position: absolute;
  background-color: white;
  height: 100%;
  width: 100%;
  top: 0;
  bottom: 0;
  left: 0;
  border-radius: 8px;
}

.img {
  //width: 80px;
}

.loader-spinner {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100%;
}

.spinner-content {
  display: flex;
  flex-direction: column;
  align-items: center;

  &--text {
    gap: 20px;
  }
}
</style>