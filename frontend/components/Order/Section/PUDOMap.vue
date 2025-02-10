<script setup lang="ts">
import useOrderFormV2Store from "~/stores/panel/useOrderFormStore";

const showMap = ref(false);

const {mapUrl, showRecipientMap, form, previewPoint, selectedPoint} = storeToRefs(useOrderFormV2Store());
const {updateMapUrl} = useOrderFormV2Store();

watch(() => showRecipientMap.value, (value) => {
  if (value) {
    updateMapUrl();
  }
});

watch(() => form.value.taker_point, (value) => {
  if (value) {
    updateMapUrl()
  }
});

watch(() => form.value.recipient.taker_postal, (value) => {
  if (value) {
    updateMapUrl()
  }
});
</script>

<template>
  <div class="form_card" v-show="form.package.delivery_type === 'to_point'">
    <div class="row">
    <div class="form_deliveryContainer">
      <div v-if="selectedPoint">
        <h3 class="form_subtitle">Wybrany punkt:</h3>
        <div style="margin-bottom: 16px">
          <span class="form_deliveryTxt">Nazwa punktu: {{ previewPoint?.pointApiName ?? '-' }}</span>
          <span class="form_deliveryTxt">Miasto: {{ previewPoint?.city ?? '-' }}</span>
          <span class="form_deliveryTxt">Kod punktu: {{ selectedPoint ?? '-' }}</span>
        </div>
      </div>
      <button class="form_buttonSecondary form_buttonSecondary--marginBottom16" v-show="selectedPoint"
              @click.prevent="showRecipientMap = true; form.taker_point = null; selectedPoint = null">Wybierz inny punkt
      </button>

      <div class="form_iframe" v-show="showRecipientMap">
        <div class="form_inputContainer300">
          <label for="" class="form_label">Wyszukaj kod punktu</label>
          <input type="text" id="" name="" :value="form.taker_point"
                 @change="form.taker_point = $event.target.value"
                 class="form_inputTxt form_inputTxt--withoutUnit"/>
<!--          <span v-if="v$.recipient.taker_city.$error" class="signin_errorMsg signin_errorMsg&#45;&#45;show">Pole jest wymagane</span>-->
        </div>
        <iframe v-show="showRecipientMap" :src="mapUrl" style="width: 100%; height: 400px" class="form_iframe"/>
      </div>
    </div>
  </div>
  </div>
</template>

<style scoped>

</style>