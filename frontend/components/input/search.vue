<script setup lang="ts">
const isFocused = ref(false);
</script>

<template>
  <div class="input_withIcon">
    <input type="text" id="" :value="isFocused" class="input_txt" :class="isFocused ? 'input_txtFocused' : ''" @focusin="isFocused = true" @focusout="isFocused = false"/>
    <span class="input_icon" :class="isFocused ? 'input_txtFocused' : ''">
      <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M12.998 13L19.9996 20.0015" stroke="#C6C6C6" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"
              stroke-linejoin="round"/>
        <path
            d="M8.02177 15.0435C11.8998 15.0435 15.0435 11.8998 15.0435 8.02177C15.0435 4.14375 11.8998 1 8.02177 1C4.14375 1 1 4.14375 1 8.02177C1 11.8998 4.14375 15.0435 8.02177 15.0435Z"
            stroke="#C6C6C6" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    </span>
  </div>
</template>

<style lang="scss" scoped>
.input_icon {
  width: 38px;
  height: 40px;
  display: flex;
  align-items: center;
  justify-content: center;
  background-color: #ffffff;
  border-radius: 0 8px 8px 0;
  border: 2px solid #F2F2F2;
  border-left: none;
  font-family: Open Sans;
  font-size: 13px;
  font-weight: 400;
  line-height: 18px;
  color: #262B44;

  &--error {
    border: 2px solid #D92222;
    border-left: 0;
  }
}

.input_withIcon {
  display: flex;
  align-items: center;
  width: 100%;
  margin-bottom: 36px;


  &--error {
    margin-bottom: 0;
  }

  &--noMargin {
    margin-bottom: 0;
  }

  &--wrap {
    flex-wrap: wrap;
  }
}

.input_txt {
  height: 40px;
  border-radius: 8px 0 0 8px;
  border-left: 2px solid #F2F2F2;
  border-top: 2px solid #F2F2F2;
  border-bottom: 2px solid #F2F2F2;
  font-family: Open Sans;
  font-size: 13px;
  font-weight: 400;
  line-height: 18px;
  color: #262B44;
  background-color: #FFFFFF;
  width: 100%;
  padding: 0 11px;

  &--withoutUnit {
    border-radius: 8px;
    max-width: 129px;
  }

  &--error {
    border: 2px solid #D92222;
  }

  &--large {
    max-width: 300px;
  }

  &--marginBottom {
    margin-bottom: 16px;
  }
}

.input_txtFocused {
  border: 2px solid #4285F4;
}

input:focus {
  outline: none;
}
</style>