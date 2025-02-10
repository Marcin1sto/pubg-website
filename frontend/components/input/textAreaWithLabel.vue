<script setup lang="ts">

defineProps({
  elementId: String,
  labelText: String,
  inputModelValue: String,
  validationErrorMessage: String,
  inputHeight: String,
  isRequired: Boolean,
  maxLength: {
    type: Number,
    default: 0
  }
})

const model = defineModel()
</script>

<template>
  <div class="inputContainer">
    <label :for="elementId" class="label">{{ labelText }}<i>*</i></label>
    <div class="inputText_container" >
      <textarea
        v-model="model"
        type="text"
        :id="elementId"
        name="length"
        class="textArea"
        :style="inputHeight ? `height: ${inputHeight}` : ''"
        :maxlength="maxLength === 0 ? null : maxLength"
      ></textarea>
    </div>

    <div v-if="validationErrorMessage" class="errorMsg errorMsg--show">{{ validationErrorMessage }}</div>
  </div>
</template>

<style scoped lang="scss">
.inputContainer {
  display: flex;
  flex-wrap: wrap;
  width: 100%;

  &--chooseCountry {
    position: relative;
    max-width: 82px;
  }

  &--large {
    max-width: 300px;
  }

  &--fullWidth {
    width: 100%;
    max-width: 100%;
  }

  &--orderFormChooseCountry {
    width: auto;
    max-width: initial;
  }
}

.inputText_container {
  display: flex;
  align-items: center;
  width: 100%;
  //margin-bottom: 10px;

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

.textArea {
  height: 130px;
  border-radius: 8px;
  border: 2px solid #F2F2F2;
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

  &--fullWidth {
    width: 100%;
    max-width: 100%;
  }

  &--marginBottom {
    margin-bottom: 16px;
  }
}
</style>