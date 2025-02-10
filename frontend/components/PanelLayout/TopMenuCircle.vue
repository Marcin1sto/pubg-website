<template>
  <div class="circle">
    <slot></slot>
    <div :class="[
        'circle-badge',
        { 'circle-badge--right': props.isRight },
        { 'circle-badge--left': props.isLeft }
    ]">
      <slot name="badge" :style="[{ 'background-color: red;': props.isRed },]"></slot>
    </div>
  </div>
</template>

<style scoped lang="scss">
.circle {
  position: relative;
  width: 40px;
  height: 40px;
  background-color: #F2F5FB;
  border-radius: 100%;
  display: flex;
  justify-content: center;
  align-items: center;
  font-size: 14px;
  color: #4285F4;
  line-height: 18px;
}

.circle-badge {
  position: absolute;
  top: -15px;
  width: max-content;
  z-index: 200;

  &--right {
    right: -6px;
  }

  &--left {
    left: -6px;
  }
}
</style>
<script setup lang="ts">
const props = defineProps({
  isRight: {
    type: Boolean,
    default: false,
  },
  isLeft: {
    type: Boolean,
    default: false,
  },
  isRed: {
    type: Boolean,
    default: false,
  },
});
</script>