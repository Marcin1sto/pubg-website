<script setup lang="ts">
import useHelpModalStore from "~/stores/panel/useHelpModalStore";

const { content, selectedHelpModalKey, showHelpModal } = storeToRefs(useHelpModalStore());
</script>

<template>
  <Teleport to="body">
    <Modal :show="showHelpModal" @close="showHelpModal = false">
      <template #header>
        <h1 class="modal_title">{{ content[selectedHelpModalKey].title }}</h1>
      </template>
      <template #body>
        <p class="modal_txt" v-html="content[selectedHelpModalKey].content"></p>
      </template>
    </Modal>
  </Teleport>
</template>

<style scoped>

</style>