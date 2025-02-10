<template>
  <div class="container">
    <div class="calc_inputContainer calc_inputContainer--fullWidth">
      <div style="display: flex; width: 100%;">
        <h3 class="calc_subtitle" style="width: max-content; cursor: pointer" @click="showConfigurationApi = !showConfigurationApi">Konfiguracja API</h3>
        <NuxtImg src="icons/tooltipIcon.png" style="margin-left: 5px; width: 11px; height: 11px" width="11px" height="11px" @click.prevent="showInfoModalType = 'api_configuration'; showInfoModal = true"/>
      </div>
      <label v-show="showConfigurationApi" for="" class="calc_label">Klucz autoryzacji do API (api_key)</label>
      <div v-show="showConfigurationApi" class="calc_inputWithUnit calc_inputWithUnit--wrap" style="margin-bottom: 16px !important;">
        <input type="text" id="" name="api_key" :value="userExternalData.Broker.api_key"
               class="calc_inputTxt calc_inputTxt--withoutUnit calc_inputTxt--fullWidth" />
        <button class="filters_buttonSecondary" @click.prevent="generateNewKey" style="margin-top: 10px">Generuj nowy</button>
      </div>
      <span v-if="apiKeyGenerateMessage" :class="[
                        apiKeyGenerateSuccess ? 'calc_successMsg' : 'calc_errorMsg',
                        apiKeyGenerateMessage ? 'calc_successMsg--show' : 'calc_errorMsg--show'

                    ]">{{ apiKeyGenerateMessage }}</span>
    </div>

    <div id="swagger-ui"></div>
  </div>
  <Teleport to="body">
    <Modal :show="showInfoModal" @close="showInfoModal = false">
      <template #header>
        <h1 class="modal_title">{{ contentTypes[showInfoModalType].title }}</h1>
      </template>
      <template #body>
        <p class="modal_txt" v-html="contentTypes[showInfoModalType].content"></p>
      </template>
    </Modal>
  </Teleport>
</template>

<script setup lang="ts">
import 'swagger-ui-dist/swagger-ui.css';
import SwaggerUI from 'swagger-ui-dist/swagger-ui-es-bundle';
import {ref} from "vue";

const showInfoModal = ref(false);
const showInfoModalType = ref('');

const contentTypes = {
  api_configuration: {
    title: 'Konfiguracja API',
    content: 'Jeśli masz dodatkowe pytania dotyczące konfiguracji skontaktuj się z nami pod adresem - tools@blpaczka.com'
  },
}
const showConfigurationApi = ref(true);
const apiKeyGenerateMessage = ref('');
const apiKeyGenerateSuccess = ref(null);
const { userExternalData } = storeToRefs(useUserStore());
const { saveApiKey } = useUserStore();
const generateNewKey = async () => {
  let apiKey = Math.random().toString(36).substr(2) + Math.random().toString(36).substr(2);
  let result = await saveApiKey(apiKey);

  apiKeyGenerateSuccess.value = result.success;
  if (result.success) {
    userExternalData.value.Broker.api_key = apiKey;
    apiKeyGenerateMessage.value = 'Klucz został wygenerowany poprawnie';
  } else {
    apiKeyGenerateMessage.value = 'Wystąpił błąd podczas generowania klucza';
  }
}

onMounted(() => {
  SwaggerUI({
    url: '/output.json',
    dom_id: '#swagger-ui',
  });
});

definePageMeta({
  middleware: 'auth',
  layout: 'panel',
})
</script>

<style>
/* Opcjonalne style */
</style>
