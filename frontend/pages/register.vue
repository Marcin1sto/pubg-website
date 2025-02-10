<template>
  <div class="container">
    <div class="row">
      <h1 class="signin_header signin_header--desktop">Rejestracja do <NuxtImg src="icons/blpLogoMain.png" width="200px" height="50px" class="signin_headerImg" /></h1>
      <h1 class="signin_header signin_header--mobile">Rejestracja</h1>
    </div>

    <div class="row row--centeredMobile row--centered row--signin">
<!--      <div class="signin_card">-->
<!--        <nuxt-link-locale to="#" class="signin_ghostButton"><NuxtImg src="/icons/signin/google.png" width="22px" height="22px" class="signin_ghostButtonImg" /> Zaloguj się przez Google</nuxt-link-locale>-->
<!--        <nuxt-link-locale to="#" class="signin_ghostButton"><NuxtImg src="/icons/signin/apple.png" width="22px" height="27px" class="signin_ghostButtonImg" /> Zaloguj się przez Apple</nuxt-link-locale>-->
<!--        <nuxt-link-locale to="#" class="signin_ghostButton"><NuxtImg src="/icons/signin/microsoft.png" width="22px" height="22px" class="signin_ghostButtonImg" /> Zaloguj się przez Microsoft</nuxt-link-locale>-->
<!--        <nuxt-link-locale to="#" class="signin_ghostButton"><NuxtImg src="/icons/signin/allegro.png" width="22px" height="25px" class="signin_ghostButtonImg" /> Zaloguj się przez Allegro</nuxt-link-locale>-->
<!--      </div>-->

      <div class="signin_card">
        <div class="signin_row signin_row--marginBottom">
          <h2 class="signin_cardHeader">Załóż konto</h2>
<!--          <span class="signin_cardSubHeader">Nasza oferta jest skierowana do przedsiębiorców (b2b), czyli posługujących się Numerem Identyfikacji Podatkowej (NIP)</span>-->
        </div>

        <div v-if="Object.keys(verificationSmsResponse).length > 0" class="panel_infoContainer" :class="verificationSmsResponse.success ? 'panel_infoContainer--success' : 'panel_infoContainer--error'">
          <div class="row">
            <p class="panel_infoTxt">{{ verificationSmsResponse.message }}</p>
          </div>
        </div>

        <div class="panel_infoContainer panel_infoContainer--error"  v-if="responseError">
          <div class="row">
            <p class="panel_infoTxt">{{ responseMessage }}</p>
          </div>
        </div>

        <form class="login-form" method="post">
          <div class="signin_row">
            <label for="email" class="signin_label">E-mail<i>*</i></label>
            <input name="email" type="email" class="signin_input" @change.prevent="clearErrors('email')" :class="v$.email.$error ? 'signin_input--error' : ''" v-model="v$.email.$model"/>
            <span v-if="v$.email.$error" class="signin_errorMsg signin_errorMsg--show">Niepoprawny adres e-mail!</span>
            <span v-if="response?.errors?.email && Object.values(response?.errors?.email)[0]" class="signin_errorMsg signin_errorMsg--show">{{ Object.values(response?.errors?.email)[0]}}</span>
          </div>

          <div class="signin_row">
            <div class="row">
              <label for="password" class="signin_label">Telefon<i>*</i></label>
            </div>
            <input name="phone" type="text" class="signin_input" maxlength="9" @change.prevent="clearErrors('phone')" :class="v$.phone.$error ? 'signin_input--error' : ''" v-model="v$.phone.$model" @keyup="errorPhoneBackendValidation = null"/>
            <span v-if="v$.phone.$error" class="signin_errorMsg signin_errorMsg--show">Numer telefonu jest nieprawidłowy.</span>
            <span v-if="response?.errors?.phone && Object.values(response?.errors?.phone)[0]" class="signin_errorMsg signin_errorMsg--show">{{ Object.values(response?.errors?.phone)[0]}}</span>
            <span v-if="String(errorPhoneBackendValidation).length > 0" class="form_errorMsg form_errorMsg--negativeMargin form_errorMsg--show">{{ errorPhoneBackendValidation }}</span>
          </div>

          <div class="row row--alignStart row--baseline row--gap16" style="height: 100%">
            <div class="signin_row" style="width: 60%" v-if="registerUseSmsVerification">
              <div class="row">
                <label for="sms_code" class="signin_label">Kod SMS<i>*</i></label>
              </div>
              <input name="sms_code" type="text" class="signin_input" maxlength="91231" :class="v$.sms_code.$error ? 'signin_input--error' : ''" v-model="v$.sms_code.$model"/>
              <span v-if="v$.sms_code.$error" class="signin_errorMsg signin_errorMsg--show">To pole jest wymagane.</span>
            </div>

            <button class="filters_buttonSecondary" :style="state.phone.length == 0 ? 'cursor: not-allowed' : ''" style="margin-top: 35px; align-self: self-start; display: flex; white-space: nowrap;" @click.prevent="smsCodeSend = true; sendVerificationSMS()" :disabled="state.phone.length == 0">{{ smsCodeSend ? 'Wyślij kod ponownie' : 'Wyślij kod'}}</button>
          </div>

          <div class="signin_row">
            <div class="row">
              <label for="password" class="signin_label">Hasło<i>*</i></label>
            </div>
            <input name="password" type="password" class="signin_input signin_input--smallMargin" @change.prevent="clearErrors('password')"  :class="v$.password.$error ? 'signin_input--error' : ''" v-model="v$.password.$model"/>
            <span v-if="v$.password.$error" class="signin_errorMsg signin_errorMsg--show">Hasło jest za krótkie!</span>
            <span class="signin_infoMsg">Hasło powinno zawierać min. jedną cyfrę, małą i wielką literę oraz znak specjalny.</span>
            <span v-if="response?.errors?.password && Object.values(response?.errors?.password)[0]" class="signin_errorMsg signin_errorMsg--show">{{ Object.values(response?.errors?.password)[0]}}</span>
          </div>

          <div class="row row--checkboxContainer">
            <input type="checkbox" id="consent" name="consent" v-model="v$.accept.$model"/>
            <label for="consent" class="signin_label signin_label--checkbox" :class="v$.accept.$error ? 'signin_input--smallMargin' : ''">Akceptuję <nuxt-link-locale to="regulations" class="signin_cardLink">Regulamin</nuxt-link-locale> i oświadczam, że zapoznałem/am się z <nuxt-link-locale tabindex="-1" to="privacy-policy" class="signin_cardLink">Polityką Prywatności</nuxt-link-locale><i>*</i></label>
          </div>
          <div v-if="v$.accept.$error" class="signin_errorMsg signin_errorMsg--show">Musisz zaakceptować regulamin</div>
          <div class="row row--checkboxContainer">
            <input type="checkbox" id="consent" name="consent" v-model="v$.newsletter.$model"/>
            <label for="newsletter" class="signin_label signin_label--checkbox signin_label--pickCursor" style="max-width: 600px" @click.prevent="showNewsLatterMoreInfo = !showNewsLatterMoreInfo">
              Zgadzam się na otrzymywanie od spółek z grupy BaseLinker, w tym BaseLinker sp. z o.o. oraz BL Logistics sp. z o.o.
              działającej pod marką BL Paczka, {{ !showNewsLatterMoreInfo ? '(Pokaż więcej)' : "BaseLinker sp. z o.o. oraz Helpratchet sp. z o.o., informacji o promocjach oraz ofertach specjalnych lub innych treści marketingowych dotyczących usług oferowanych przez spółki z grupy za pośrednictwem komunikacji elektronicznej lub telefonu oraz na przetwarzanie moich danych przez spółki z grupy w związanych z tym celach marketingowych, zgodnie z przepisami prawa i przyjętą przez daną spółkę grupy Polityką Prywatności dostępną w jej serwisie. Zostałem poinformowany, że w każdej chwili mogę wycofać udzieloną zgodę.Zaznaczając tę opcję zgadzasz się na komunikowanie się z Tobą poprzez dostępne kanały komunikacji, w tym e-mail, SMS/MMS lub telefon. Wycofanie zgody pozostaje bez wpływu na zgodność z prawem wysyłanych dotychczas informacji marketingowych." }}</label>
          </div>
          <div class="row">
            <button @click="submit" class="signin_button">Zarejestruj się</button>
          </div>
          <div class="row">
            <nuxt-link-locale to="login" class="signin_button signin_button--ghost signin_button--desktop">Zaloguj się tutaj jeśli masz konto</nuxt-link-locale>
            <nuxt-link-locale to="login" class="signin_button signin_button--ghost signin_button--mobile">Zaloguj się</nuxt-link-locale>
          </div>
        </form>
        <FormSpinerLoaderWithText :loading="loading">Rejestracja...</FormSpinerLoaderWithText>
      </div>
    </div>
  </div>
</template>

<script lang="ts" setup>
import { storeToRefs } from 'pinia';
import { useAuthStore  } from '~/stores/useAuthStore';
import {required, email, minLength, sameAs, requiredIf, helpers} from '@vuelidate/validators'
import { useVuelidate } from "@vuelidate/core";
import {useReCaptcha} from "vue-recaptcha-v3";
import {toBoolean} from "@iconify/utils";
import {ref} from "vue";

const { registerUser, startLoadingAsyncData, authenticateUser } = useAuthStore();
const { authenticated, isSemiUser, responseError, responseMessage, loading } = storeToRefs(useAuthStore());
const recaptchaInstance = useReCaptcha();
const showNewsLatterMoreInfo = ref(false);
const response = ref(null);
const { sendForUserVerificationSMS } = useUserStore();
const {t} = useI18n();

const clearErrors = (key) => {
  if (response.value === null) {
    return;
  }

  if (response.value?.errors) {
    response.value.errors[key] = [];
  }
}

onMounted(() => {
  responseError.value = false;
  responseMessage.value = '';

  verificationSmsResponse.value = {}

  if (config.public.APP_ENV != 'development') {
    const config = useRuntimeConfig();
    const generateStrongPassword = (length = 12) => {
      const upperCase = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
      const lowerCase = 'abcdefghijklmnopqrstuvwxyz';
      const digits = '0123456789';
      const specialChars = '!"£$%@^&*';
      const allChars = upperCase + lowerCase + digits + specialChars;

      // Upewniamy się, że każde wymaganie jest spełnione
      const getRandom = (str) => str[Math.floor(Math.random() * str.length)];
      let password = getRandom(upperCase) + getRandom(lowerCase) + getRandom(digits) + getRandom(specialChars);

      // Uzupełniamy resztę hasła losowymi znakami
      for (let i = password.length; i < length; i++) {
        password += getRandom(allChars);
      }

      // Losowe przetasowanie znaków w haśle
      return password.split('').sort(() => Math.random() - 0.5).join('');
    };

    state.phone = Array.from({ length: 9 }, () => Math.floor(Math.random() * 10)).join('');
    state.email = `${Math.random().toString(36).substring(2, 10)}@example.com`;
    state.password = generateStrongPassword(18);
    state.accept = true
  }
});

const router = useRouter();
const state = reactive({
  email: '',
  password: '',
  phone: '',
  newsletter: false,
  accept: false,
  sms_code: '',
  'g-recaptcha-response': ''
});

const passwordValidation = (value) => {
  const hasUpperCase = /[A-Z]/.test(value);     // Sprawdza czy jest wielka litera
  const hasLowerCase = /[a-z]/.test(value);     // Sprawdza czy jest mała litera
  const hasDigit = /[0-9]/.test(value);         // Sprawdza czy są cyfry od 0 do 9
  const hasSpecialChar = /[!"£$%@^&*]/.test(value);  // Sprawdza czy są dozwolone symbole
  return hasUpperCase && hasLowerCase  && hasSpecialChar && hasDigit;
};

const rules = computed(() => {
  return {
    email: { required, email },
    password: { required, minLength: minLength(8), passwordValidation: helpers.withMessage(t('validations.passwordValidation', {symbols: '!£$@%^&*'}), passwordValidation) },
    phone: { required, minLength: minLength(9) },
    newsletter: {  },
    accept: { required, sameAs: sameAs(true)},
    sms_code: { requiredIf: requiredIf(() => registerUseSmsVerification) }
  };
});
const v$ = useVuelidate(rules, state);
const nuxt = useNuxtApp();

const smsCodeSend = ref(false);

const config = useRuntimeConfig();
const { verificationSmsResponse, verificationSmsErrorMessage } = storeToRefs(useUserStore());
const registerUseSmsVerification = config.public.REGISTER_USE_SMS_VERIFICATION === 'true';
const errorPhoneBackendValidation = ref(null)
const submit = async (e) => {
  e.preventDefault();
  v$.value.$touch();
  const token = await recaptchaInstance?.executeRecaptcha('register');

  if (token) {
    state["g-recaptcha-response"] = token;
  }

  if (v$.value.$invalid) {
      return;
  }

  if (registerUseSmsVerification) {
    if (state.sms_code === null) {
      await sendForUserVerificationSMS({
        phone: state.phone,
        'g-recaptcha-response': token
      });

      if (String(verificationSmsErrorMessage.value).length > 0 && !verificationSmsErrorMessage.value.success) {
        errorPhoneBackendValidation.value = verificationSmsErrorMessage.value.message;
      } else {
        errorPhoneBackendValidation.value = null;
      }

      return;
    }
  }

  startLoadingAsyncData();

  response.value = await registerUser(state);

  if (registerUseSmsVerification) {
    if (response.value?.errors?.sms_code) {
      state.sms_code = null;
      verificationSmsResponse.value.success = false;
      verificationSmsErrorMessage.value = response.value.message;
      return;
    }
  }

  if (response.value.success) {
    loading.value = false;
    const tokenLogin = await recaptchaInstance?.executeRecaptcha('login');
    await authenticateUser({ email: state.email, password: state.password, 'g-recaptcha-response': tokenLogin });
    await router.push(nuxt.$localePath('panel'));
  }
}

const sendVerificationSMS = async () => {
  const tokenSms = await recaptchaInstance?.executeRecaptcha('smsCode');

  let request = {
    phone: state.phone,
    'g-recaptcha-response': tokenSms
  }

  await sendForUserVerificationSMS(request);

  setTimeout(() => {
    verificationSmsResponse.value = {}
  }, 6000);
}

definePageMeta({
  middleware: 'default-layout',
})
</script>