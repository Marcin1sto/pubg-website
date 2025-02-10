<template>
  <Transition name="modal">
    <div v-if="show" class="modal_background">
      <div class="modal_container" :style="styleMaxContent ? 'width: max-content; max-width: 80%; max-height: 80%;' : ''">
        <div class="modal_header">
          <slot name="header">
            <h1 class="modal_title">Wymiary dla przesyłki</h1>
          </slot>

          <button
              class="modal-default-button"
              @click="$emit('close')"
          >
            <NuxtImg src="icons/close.png" width="23px" height="23px" class="modal_close"/>
          </button>
        </div>

        <div class="modal_content">
          <slot name="body">
            <p class="modal_txt">Jestem niedokończonym modalem. Uzupełnij mnie Adminie danymi.</p>
          </slot>
        </div>
        <div class="modal_buttons">
          <slot name="buttons"></slot>
        </div>
      </div>
    </div>
  </Transition>
</template>

<script setup>
const props = defineProps({
  show: Boolean,
  styleMaxContent: {
    type: Boolean,
    default: false,
  },
})
</script>

<style>
.modal-enter-from {
  opacity: 0;
}

.modal-leave-to {
  opacity: 0;
}

.modal-enter-from .modal-container,
.modal-leave-to .modal-container {
  -webkit-transform: scale(1.1);
  transform: scale(1.1);
}
</style>