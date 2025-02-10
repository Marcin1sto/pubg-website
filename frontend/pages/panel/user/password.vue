<template>
  <div class="userData_container">
    <div class="userData_card">
      <div v-if="Object.keys(verificationSmsResponse).length > 0" class="panel_infoContainer" :class="verificationSmsResponse.success ? 'panel_infoContainer--success' : 'panel_infoContainer--error'">
        <div class="row">
          <p class="panel_infoTxt">{{ verificationSmsResponse.message }}</p>
        </div>
      </div>

      <h3 class="form_subtitle ">
        Zmiana hasła
      </h3>
      <div class="row row--alignStart row--baseline row--gap16">
        <div class="form_inputContainer300" :class="{'form_inputContainer300--error': v$.password.$error}">
          <label for="password" class="form_label">Stare hasło<i>*</i></label>
          <input type="password" id="password" name="password" v-model="v$.password.$model" :class="{'form_inputTxt--error': v$.password.$error}" class="form_inputTxt form_inputTxt--withoutUnit" max="10"/>
          <span v-if="v$.password.$error" class="form_errorMsg  form_errorMsg--show">{{v$.password.$errors[0].$message}}</span>
          <span v-if="responseErrors?.password?.checkActualPassword" class="form_errorMsg  form_errorMsg--show">{{ responseErrors.password.checkActualPassword }}</span>
          <span v-if="responseErrors?.password?.checkPasswordHasChange" class="form_errorMsg  form_errorMsg--show">{{ responseErrors.password.checkPasswordHasChange }}</span>
        </div>
      </div>

      <div class="row row--alignStart row--baseline row--gap16">
        <div class="form_inputContainer300" :class="{'form_inputContainer300--error': v$.new_password.$error}">
          <label for="new_password" class="form_label">Nowe hasło<i>*</i></label>
          <input type="password" id="new_password" name="new_password" v-model="v$.new_password.$model" :class="{'form_inputTxt--error': v$.new_password.$error}" class="form_inputTxt form_inputTxt--withoutUnit" />
          <span v-if="v$.new_password.$error" class="form_errorMsg form_errorMsg--show">{{v$.new_password.$errors[0].$message}}</span>
        </div>
      </div>

      <div class="row row--alignStart row--baseline row--gap16">
        <div class="form_inputContainer300" :class="{'form_inputContainer300--error': v$.retype_new_password.$error}">
          <label for="retype_new_password" class="form_label">Powtórz nowe hasło<i>*</i></label>
          <input type="password" id="retype_new_password" name="retype_new_password" v-model="v$.retype_new_password.$model" :class="{'form_inputTxt--error': v$.retype_new_password.$error}"  class="form_inputTxt form_inputTxt--withoutUnit"/>
          <span v-if="v$.retype_new_password.$error" class="form_errorMsg form_errorMsg--show">{{v$.retype_new_password.$errors[0].$message}}</span>
        </div>
      </div>

      <div class="row row--alignStart row--baseline row--gap16" style="height: 100%">
        <div class="form_inputContainer300" v-if="registerUseSmsVerification">
          <div class="row">
            <label for="sms_code" class="form_label">Kod SMS<i>*</i></label>
          </div>
          <input name="sms_code" type="text" class="signin_input" maxlength="91231" :class="v$.sms_code.$error ? 'signin_input--error' : ''" v-model="v$.sms_code.$model"/>
          <span v-if="v$.sms_code.$error" class="signin_errorMsg signin_errorMsg--show">To pole jest wymagane.</span>
        </div>

        <button class="filters_buttonSecondary" style="margin-top: 27px; align-self: self-start; display: flex; white-space: nowrap;" @click.prevent="smsCodeSend = true; sendVerificationSMS()">{{ smsCodeSend ? 'Wyślij kod ponownie' : 'Wyślij kod'}}</button>
      </div>

      <div class="userData_buttonWrapper userData_buttonWrapper--noMarginBottom">
        <button class="userData_button" @click="submit">Zmień hasło</button>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import usePageStore from "~/stores/usePageStore";
import {helpers, requiredIf} from '@vuelidate/validators'
import {useVuelidate} from "@vuelidate/core";
import { useI18nValidators } from '~/helpers/vuelidate-translations';
import {useReCaptcha} from "vue-recaptcha-v3";
import {storeToRefs} from "pinia";
import {ref} from "vue";

const {t} = useI18n();
const { setPageValues } = usePageStore();
const { successMessageShow, successMessage, errorMessageShow, errorMessage } = storeToRefs(usePageStore());
const { userExternalData } = storeToRefs(useUserStore());
const { sendForUserVerificationSMS } = useUserStore();
const config = useRuntimeConfig();
const recaptchaInstance = useReCaptcha();
const smsCodeSend = ref(false);

const passwordValidation = (value) => {
  const hasUpperCase = /[A-Z]/.test(value);     // Sprawdza czy jest wielka litera
  const hasLowerCase = /[a-z]/.test(value);     // Sprawdza czy jest mała litera
  const hasDigit = /[0-9]/.test(value);         // Sprawdza czy są cyfry od 0 do 9
  const hasSpecialChar = /[!"£$%@^&*]/.test(value);  // Sprawdza czy są dozwolone symbole
  return hasUpperCase && hasLowerCase  && hasSpecialChar && hasDigit;
};
const registerUseSmsVerification = config.public.REGISTER_USE_SMS_VERIFICATION === 'true';
const { required, sameAs, minLength } = useI18nValidators();

const rules = computed(() => {
  return {
    password: { required, minLength: minLength(8) },
    new_password: { required, minLength: minLength(8), passwordValidation: helpers.withMessage(t('validations.passwordValidation', {symbols: '!£$@%^&*'}), passwordValidation)},
    retype_new_password: { required, sameAs: sameAs(state.new_password, 'Nowe hasło'), minLength: minLength(8), passwordValidation: helpers.withMessage(t('validations.passwordValidation'), passwordValidation) },
    sms_code: { requiredIf: requiredIf(() => registerUseSmsVerification) }
  }
})

const state = reactive({
  password: '',
  new_password: '',
  retype_new_password: '',
  sms_code: ''
});

const v$ = useVuelidate(rules, state);

const { resetUserPassword } = useUserStore();
const responseStatus = ref(null);
const responseErrors = ref(null);
const { verificationSmsResponse, verificationSmsErrorMessage } = storeToRefs(useUserStore());

const submit = async (e) => {
  e.preventDefault();
  v$.value.$touch();


  if (v$.value.$invalid) {
    return;
  }

  const token = await recaptchaInstance?.executeRecaptcha('change_password');

  if (token) {
    state["g-recaptcha-response"] = token;
  }

  // if (state.sms_code === null && config.public.REGISTER_USE_SMS_VERIFICATION === 'true') {
  //   await sendForUserVerificationSMS({
  //     phone: userExternalData.value?.Broker.phone,
  //     'g-recaptcha-response': token
  //   });
  //   return;
  // }

  // if (state.sms_code !== null) {
  //   if (String(verificationSmsErrorMessage.value).length > 0 && !verificationSmsResponse.value.success) {
  //     await sendForUserVerificationSMS({
  //       phone: userExternalData.value?.Broker.phone,
  //       'g-recaptcha-response': token
  //     });
  //     state.sms_code = null;
  //     return;
  //   }
  // }

  let result = await resetUserPassword(state)
  responseStatus.value = result.success

  if (result.errors?.sms_code) {
    verificationSmsResponse.value.success = false;
    verificationSmsResponse.value.message = result.value.message;
    return;
  }

  if (result.success) {
    state.password = '';
    state.new_password = '';
    state.retype_new_password = '';
    state.sms_code = '';
    v$.value.$reset();

    successMessageShow.value = true;
    errorMessageShow.value = false;
    successMessage.value = {
      title: t('page.userResetPasswordPage.success'),
      message: t('page.userResetPasswordPage.successDescription'),
    };
    responseErrors.value = null;
  } else {
    errorMessageShow.value = true;
    successMessageShow.value = false;
    errorMessage.value = {
      title: t('page.userResetPasswordPage.error'),
      message: result.message
    };
    responseErrors.value = result.errors;
  }

}

setPageValues(
    t('page.panel.user.password.title'),
);

useHead({
  title: t('page.panel.user.password.title')
});

definePageMeta({
  middleware: 'auth',
  layout: 'panel',
})

onMounted(() => {
  verificationSmsResponse.value = {}
});

// TODO: wydzielic do osobnego pliku
const sendVerificationSMS = async () => {
  const tokenSms = await recaptchaInstance?.executeRecaptcha('smsCode');

  let request = {
    phone: userExternalData.value?.Broker.phone,
    'g-recaptcha-response': tokenSms
  }

  await sendForUserVerificationSMS(request);

  setTimeout(() => {
    verificationSmsResponse.value = {}
  }, 6000);
}

</script>

<style scoped>

</style>