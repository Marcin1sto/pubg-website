<script setup lang="ts">
import {storeToRefs} from "pinia";
import usePageStore from "~/stores/usePageStore";
import {useAuthStore} from "~/stores/useAuthStore";
import {useReCaptcha} from "vue-recaptcha-v3";


const props = defineProps({
  showModal: {
    type: Boolean,
    required: true,
  },
  errors: {
    type: Array,
    required: false,
  },
  phone: {
    type: String,
    required: true,
  },
});
const emit = defineEmits(['update:smsCode', 'update:showModal', 'hide']);
const { userExternalData, loading, verificationSmsResponse, verificationSmsErrorMessage } = storeToRefs(useUserStore());
const { startLoadingAsyncData, getExternalUserData, saveUserProfile, sendForUserVerificationSMS, saveApiKey } = useUserStore();
const { isSemiUser } = storeToRefs(useAuthStore());
const { successMessage, successMessageShow } = storeToRefs(usePageStore());
const dataChangeForceSmsVerificationTranslation = {
  phone: 'Numer telefonu',
  iban_czk: 'Korona Czeska (CZK)',
  iban_eur: 'Euro (EUR)',
  iban_ron: 'Lej Rumuński (RON)',
  iban_huf: 'Forint Węgierski (HUF)',
  iban_bgn: 'Lew Bułgarski (BGN)',
  account: 'Złoty Polski (PLN)',
};

const closeModal = () => {
  emit('hide', true)
}

onMounted(() => {
  verificationSmsErrorMessage.value = '';
  verificationSmsResponse.value = {
    success: true,
  };
})

const recaptchaInstance = useReCaptcha();
const sendVerificationSMS = async () => {
  const tokenSms = await recaptchaInstance?.executeRecaptcha('smsCode');

  let request = {
    phone: props.phone,
    'g-recaptcha-response': tokenSms
  }

  await sendForUserVerificationSMS(request);

  if (String(verificationSmsResponse.value).length > 0 && !verificationSmsResponse.value.success) {
    closeModal()
  }
}

const smsCode = ref(null)
const submit = async () => {
  emit('update:smsCode', smsCode.value)
  closeModal()
}
</script>

<template>
  <Teleport to="body">
    <Modal :show="showModal" @close="showModal = false; closeModal()">
      <template #header>
        <h1 class="modal_title">Zweryfikuj dane kodem SMS</h1>
      </template>
      <template #body>
        <div class="row" v-if="Object.keys(verificationSmsResponse).length > 0 && !verificationSmsResponse?.success">
          <div class="modal_errorInfoContainer">
              <span class="modal_errorInfoTxt">
                {{ verificationSmsErrorMessage || verificationSmsResponse.message }}
              </span>
          </div>
        </div>
        <div>
          <div class="row" v-if="verificationSmsResponse?.success">
            <div class="modal_specialInfoContainer">
              <span class="modal_specialInfoTxt">
                {{ verificationSmsResponse.message }}
              </span>
            </div>
          </div>

          <div class="row" v-if="typeof errors == 'object' && Object.keys(errors).length > 0">
            <p class="modal_txt">Zmieniłeś wrażliwe dane:</p>
          </div>

          <div class="row">
            <ul class="modal_list">
              <li class="modal_txt" v-for="(value, key) in errors" :key="key">{{ dataChangeForceSmsVerificationTranslation[value] }}</li>
            </ul>
          </div>

          <div class="row">
            <p class="modal_txt">Aby zatwierdzić zmiany, wprowadź kod SMS wysłany na numer: {{ phone }}</p>
          </div>

          <div class="row" style="margin-top: 10px">
            <div class="form_inputContainer300">
              <label for="" class="form_label">Kod SMS</label>
              <input type="text" id="" name="" v-model="smsCode"
                     class="form_inputTxt form_inputTxt--withoutUnit"
                     @change.prevent="smsCode = $event.target.value"
              />
            </div>
          </div>

          <div class="filters_contentButtonsContainer">
            <button class="filters_buttonPrimary" @click="submit">Zapisz</button>
            <button class="filters_buttonSecondary"  @click="sendVerificationSMS">Wyślij kod ponownie</button>
          </div>
        </div>
      </template>
    </Modal>
  </Teleport>
</template>

<style scoped>

</style>