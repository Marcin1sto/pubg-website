<template>
  <nuxt-link-locale :to="item.route" class="blp-button">
    <div class="btn-content">
      <div class="left-side-button">
        <IconBase :name="item.icon" class="icon"/>
        <span v-if="openedMenu"><slot></slot></span>
      </div>
    </div>
  </nuxt-link-locale>
</template>

<script setup lang="ts">
  import useLeftMenuStore from "~/stores/useLeftMenuStore";

  const { openedMenu } = storeToRefs(useLeftMenuStore());

  const props = defineProps({
    item: Object,
    required: true,
  });

</script>

<style scoped lang="scss">
.blp-button:hover {
  color: rgba(66, 133, 244, 1);
  border: 2px solid rgba(66, 133, 244, 1);
  rotate: 0deg;

  .icon {
    color: rgba(66, 133, 244, 1) !important;
  }
}

.btn-content {
  display: flex;
  justify-content: space-between;
  height: 100%;

  .left-side-button {
    display: flex;
    align-items: center;
  }
}

.blp-button {
  display: block;
  text-decoration: none;
  background-color: rgba(255, 255, 255, 1);
  color: rgba(38, 43, 68, 1);
  width: 100%;
  height: 40px;
  top: 196px;
  left: 32px;
  border-radius: 8px 8px 8px 8px;
  border: 2px solid #F2F2F2;
  padding-inline: 10px;
  margin-bottom: 16px;

  .icon {
    height: 20px;
    width: 20px;
    display: flex;
    align-items: center;
  }

  span {
    margin-left: 16px;
  }
}

.router-link-active {
  color: rgba(66, 133, 244, 1);
  border: 2px solid rgba(66, 133, 244, 1);
}
</style>