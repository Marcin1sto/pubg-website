<script setup lang="ts">
  const props = defineProps({
    propFunction: {
      type: Function,
      required: true
    }
  })
</script>

<template>
  <button class="buttonSecondary" @click="propFunction"><slot></slot></button>
</template>

<style scoped>
.buttonSecondary {
  font-size: 16px;
  font-weight: 700;
  line-height: 22px;
  color: #4285F4;
  padding: 16px 28px;
  border: 2px solid #4285F4;
  border-radius: 100px;
  text-decoration: none;
  white-space: nowrap;
  transition-property: all;
  transition-duration: 0.2s;
  transition-timing-function: ease;

  &:hover {
    color: #ffffff;
    background-color: #4285F4;
    border: 2px solid #4285F4;
  }
}
</style>