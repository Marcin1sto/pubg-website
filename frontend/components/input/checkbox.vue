<script setup lang="ts">
  const emit = defineEmits(['change'])

  const props = defineProps({
    selected: {
      type: Boolean as PropType<boolean>,
      default: false,
    },
  });

  const emitChange = (event: Event) => {
    emit('change', event.target?.checked)
  }
</script>

<template>
  <label class="checkbox-container">
    <input type="checkbox" :checked="selected" @change="emitChange">
    <span class="checkmark"></span>
  </label>
</template>

<style scoped>
/* Container for custom checkbox */
.checkbox-container {
  display: inline-block;
  position: relative;
  cursor: pointer;
  font-size: 20px;
  user-select: none;
  height: 20px;
  width: 20px;
}

/* Hide the default checkbox */
.checkbox-container input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
}

/* Create a custom checkmark */
.checkmark {
  position: absolute;
  height: 20px;
  width: 20px;
  background-color: #fff;
  border: 2px solid #D2CBCB;
  border-radius: 4px;
}

/* When the checkbox is checked, add a blue background and display the checkmark */
.checkbox-container input:checked ~ .checkmark {
  color: #3b82f6;
  border: 2px solid #3b82f6;
}

/* Create the checkmark/indicator (hidden when not checked) */
.checkmark:after {
  content: "";
  position: absolute;
  display: none;
  color: #3b82f6;
}

/* Show the checkmark when checked */
.checkbox-container input:checked ~ .checkmark:after {
  content: '\2713';
  display: flex;
}

/* Style the checkmark/indicator */
.checkbox-container .checkmark:after {
  left: 8px;
  top: 6px;
  width: 3px;
  height: 0;
  border: solid white;
  border-width: 0 2px 2px 0;
  display: flex;
  align-items: center;
  justify-content: center;
}
</style>