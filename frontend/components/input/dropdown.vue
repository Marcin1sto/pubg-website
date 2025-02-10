<script setup lang="ts">

import {onClickOutside} from "@vueuse/core";

const isOpened = ref(false);

const props = defineProps({
  options: {
    type: Array,
    required: true
  },
  labelText: {
    type: String,
    required: false
  },
  elementId: {
    type: String,
    required: true
  },
  placeholder: {
    type: String,
    default: 'Wybierz temat'
  },
  isRequired: {
    type: Boolean,
    default: false
  },
  validationErrorMessage: {
    type: String,
    required: false
  }
})

const selected = ref({});

const emit = defineEmits(['change'])
watch(selected, () => {
  emit('change', selected.value)
})

const target = ref(null);
const clickOutside = (e) => {
  if (!isOpened.value) return;

  if (!e.target.closest('.calc_countryList')) {
    isOpened.value = false;
  }
}
onClickOutside(target, event => clickOutside(event));

</script>

<template>
  <div ref="target" class="dropdown_container" @click.prevent="isOpened = !isOpened">
    <label v-if="labelText" :for="elementId" class="label">{{ labelText }}<i v-if="isRequired">*</i></label>
    <button class="dropdown" :class="isOpened ? 'dropdown--open' : '' ">
      <span class="dropdown_text">{{ selected?.name ? selected.name : placeholder}}</span>
      <span class="dropdown_ButtonArrow">
      <NuxtImg v-if="!isOpened" src="icons/selectCountry/arrowDown.png" width="23px" height="23px"/>
      <NuxtImg v-if="isOpened" src="icons/selectCountry/arrowUp.png" width="23px" height="23px"/>
    </span>
    </button>
    <div v-if="validationErrorMessage" class="errorMsg errorMsg--show">{{ validationErrorMessage }}</div>
    <div class="dropdown_openContent" :class="!labelText ? 'dropdown_openContent--noLabel' : ''" :style="isOpened ? 'display: block' : 'display: none'">
      <div class="dropdown_openContent--item" v-for="(item, index) in options" :key="index" @click.stop="selected = options[index]; isOpened = false">
        <span>{{ item.name }}</span>
      </div>
    </div>
  </div>
</template>

<style scoped lang="scss">

.errorMsg {
  font-family: Open Sans;
  font-size: 11px;
  font-weight: 400;
  line-height: 15px;
  color: #D92222;
  display: none;

  &--show {
    display: block;
  }
}

.label {
  font-family: Open Sans;
  font-size: 11px;
  font-weight: 400;
  line-height: 15px;
  margin-bottom: 4px;
  color: #262B44;
  width: 100%;
}

.dropdown_container {
  min-width: 210px;
  display: flex;
  flex-direction: column;
  position: relative;
  z-index: 1;
}
.dropdown_openContent {
  height: max-content;
  border-radius: 0 0 8px 8px;
  border: 2px solid #F2F2F2;
  padding: 10px 16px 5px;
  position: absolute;
  top: 57px;
  background-color: white;
  width: 100%;
  z-index: 2;

  &--noLabel {
    top: 38px;
  }

  &--item {
    display: flex;
    align-items: center;
    gap: 16px;
    margin-bottom: 5px;
    font-size: 14px;
    font-weight: 400;
    line-height: 18px;
    color: #202020;
    cursor: pointer;
  }
}

.dropdown {
  width: 100%;
  height: 40px;
  border: 2px solid #F2F2F2;
  border-radius: 8px;
  display: flex;
  align-items: stretch;
  background-color: #ffffff;

  &--open {
    border-radius: 8px 8px 0 0;
  }
}

.dropdown_ButtonArrow {
  border-left: 2px solid #F2F2F2;
  display: flex;
  justify-content: center;
  align-items: center;
  margin-left: 10px;
  min-width: 41px;
}

.dropdown_downloadIcon {
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 0 12px;
}

.dropdown_text {
  display: flex;
  align-items: center;
  //text-align: left;
  margin-left: 10px;
  font-size: 14px;
  font-weight: 400;
  line-height: 18px;
  color: #202020;
  width: 100%;
}
</style>