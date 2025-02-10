<script setup lang="ts">
import usePageStore from "~/stores/usePageStore";
import {required, email, minLength, helpers, requiredIf} from '@vuelidate/validators'
import {useVuelidate} from "@vuelidate/core";
import {ref} from "vue";
import {useTheFetch} from "~/composables/useTheFetch";
import {storeToRefs} from "pinia";
import {useAuthStore} from "~/stores/useAuthStore";
import {useReCaptcha} from "vue-recaptcha-v3";

const {t} = useI18n();
const { setPageValues } = usePageStore();
const { successMessage, successMessageShow, errorMessageShow, errorMessage } = storeToRefs(usePageStore());
const { startLoadingAsyncData, getExternalUserData, saveUserProfile, sendForUserVerificationSMS, saveApiKey, fetchGusData, updateGusData } = useUserStore();
const { userExternalData, loading, verificationSmsResponse, verificationSmsErrorMessage } = storeToRefs(useUserStore());
const { setNewToken } = useAuthStore();
const { isSemiUser } = storeToRefs(useAuthStore());
const loaderMsg = ref('')

setPageValues(
    t('page.panel.user.profile.title'),
);

await getExternalUserData();

const form = {
  vat_nip: '',
  account: '',
  iban_czk: '',
  iban_eur: '',
  iban_ron: '',
  iban_huf: '',
  iban_bgn: '',
  custom_pickup: null,
  notify_off: '',
  email: '',
  username: '',
  vat_name: '',
  phone: '',
  pickup_name: '',
  pickup_phone: '',
  pickup_street: '',
  pickup_postal: '',
  pickup_city: '',
  pickup_house_no: '',
  pickup_locum_no: '',
  vat_company: '',
  vat_postal: '',
  vat_city: '',
  vat_street: '',
  vat_house_no: '',
  vat_locum_no: '',
  email_invoice: '',
  email_cod: '',
  api_key: '',
  default_printer_type: '',
  low_bank_saldo_notify: '',
  low_bank_saldo_amount: '',
  low_bank_saldo_email: '',
  consumer_account: false,
  rodo: ''
};
const state_vat = reactive({...form});
const state_consumer = reactive({...form});

let dataChangeForceSmsVerification = {
  phone: '',
  iban_czk: '',
  iban_eur: '',
  iban_ron: '',
  iban_huf: '',
  iban_bgn: '',
  account: '',
};
const dataChangeForceSmsVerificationTranslation = {
  phone: 'Numer telefonu',
  iban_czk: 'Korona Czeska (CZK)',
  iban_eur: 'Euro (EUR)',
  iban_ron: 'Lej Rumuński (RON)',
  iban_huf: 'Forint Węgierski (HUF)',
  iban_bgn: 'Lew Bułgarski (BGN)',
  account: 'Złoty Polski (PLN)',
};

const showSmsVerificationModal = ref(false);
const userType = ref(false);
const state = computed(() => (userType.value ? state_consumer : state_vat));

watch(() => userType.value, () => {
  v$.value.$reset()
})

const fullFillFormData = () => {
  state_vat.phone = userExternalData.value?.Broker.phone;
  state_vat.email = userExternalData.value?.Broker.email;
  state_consumer.phone = userExternalData.value?.Broker.phone;
  state_consumer.email = userExternalData.value?.Broker.email;

  state.value.vat_nip = userExternalData.value?.Broker.vat_nip;
  state.value.account = userExternalData.value?.Broker.account;
  state.value.iban_czk = userExternalData.value?.Broker.iban_czk;
  state.value.iban_eur = userExternalData.value?.Broker.iban_eur;
  state.value.iban_ron = userExternalData.value?.Broker.iban_ron;
  state.value.iban_huf = userExternalData.value?.Broker.iban_huf;
  state.value.iban_bgn = userExternalData.value?.Broker.iban_bgn;
  state.value.custom_pickup = userExternalData.value?.Broker.custom_pickup;
  state.value.notify_off = userExternalData.value?.Broker.notify_off;
  state.value.email = userExternalData.value?.Broker.email;
  state.value.phone = userExternalData.value?.Broker.phone;
  state.value.pickup_name = userExternalData.value?.Broker.pickup_name;
  state.value.pickup_phone = userExternalData.value?.Broker.pickup_phone;
  state.value.pickup_street = userExternalData.value?.Broker.pickup_street;
  state.value.pickup_postal = userExternalData.value?.Broker.pickup_postal;
  state.value.pickup_city = userExternalData.value?.Broker.pickup_city;
  state.value.pickup_house_no = userExternalData.value?.Broker.pickup_house_no;
  state.value.pickup_locum_no = userExternalData.value?.Broker.pickup_locum_no;
  state.value.email_invoice = userExternalData.value?.Broker.email_invoice;
  state.value.email_cod = userExternalData.value?.Broker.email_cod;
  state.value.api_key = userExternalData.value?.Broker.api_key;
  state.value.default_printer_type = userExternalData.value?.Broker.default_printer_type;
  state.value.low_bank_saldo_notify = userExternalData.value?.Broker.low_bank_saldo_notify;
  state.value.low_bank_saldo_amount = userExternalData.value?.Broker.low_bank_saldo_amount;
  state.value.low_bank_saldo_email = userExternalData.value?.Broker.low_bank_saldo_email;
  state.value.consumer_account = userExternalData.value?.Broker.consumer_account;
  state.value.rodo = userExternalData.value?.Broker.rodo;

  if (!userExternalData.value.Broker.consumer_account) {
    state.value.vat_company = userExternalData.value?.Broker.vat_company;
    state.value.vat_postal = userExternalData.value?.Broker.vat_postal;
    state.value.vat_city = userExternalData.value?.Broker.vat_city;
    state.value.vat_street = userExternalData.value?.Broker.vat_street;
    state.value.vat_house_no = userExternalData.value?.Broker.vat_house_no;
    state.value.vat_locum_no = userExternalData.value?.Broker.vat_locum_no;
    state.value.vat_name = userExternalData.value?.Broker.vat_name;
  } else {
    state.value.vat_postal = userExternalData.value?.Broker.postal;
    state.value.vat_city = userExternalData.value?.Broker.city;
    state.value.vat_street = userExternalData.value?.Broker.street;
    state.value.vat_house_no = userExternalData.value?.Broker.house_no;
    state.value.vat_locum_no = userExternalData.value?.Broker.locum_no;
    state.value.vat_name = userExternalData.value?.Broker.name;
  }

  dataChangeForceSmsVerification = {
    phone: userExternalData.value?.Broker.phone,
    iban_czk: userExternalData.value?.Broker.iban_czk,
    iban_eur: userExternalData.value?.Broker.iban_eur,
    iban_ron: userExternalData.value?.Broker.iban_ron,
    iban_huf: userExternalData.value?.Broker.iban_huf,
    iban_bgn: userExternalData.value?.Broker.iban_bgn,
    account: userExternalData.value?.Broker.account,
  }
}

onMounted(() => {
  verificationSmsResponse.value = {}
  loaderMsg.value = 'Ładowanie danych...';
  startLoadingAsyncData();
  if (userExternalData.value) {
    if (userExternalData.value?.Broker.consumer_account) {
      userType.value = true;
    } else {
      userType.value = false;
    }

    fullFillFormData();
  }

  if (isSemiUser.value) {
    state.notify_off = String(true);
  }

});

const printerTypes = [
  {name: 'A4', code: '1'},
  {name: 'A6', code: '2'},
  {name: 'ZPL', code: '3'},
]

const nipValidator = helpers.withMessage(
    "Nieprawidłowy numer NIP",
    (value) => {
      if (userType.value) return true;

      if (!value || typeof value !== "string") return false;

      // Usuń myślniki, jeśli są wprowadzone, aby umożliwić weryfikację z i bez myślników
      const nip = value.replace(/-/g, "");

      // Sprawdź, czy NIP ma dokładnie 10 cyfr
      if (nip.length !== 10 || !/^\d{10}$/.test(nip)) {
        return false;
      }

      // Wagi dla kolejnych cyfr NIP-u
      const weights = [6, 5, 7, 2, 3, 4, 5, 6, 7];

      // Oblicz sumę kontrolną
      const checksum =
          nip
              .split("")
              .slice(0, 9)
              .reduce((acc, digit, index) => acc + parseInt(digit, 10) * weights[index], 0) % 11;

      // Sprawdź, czy ostatnia cyfra jest równa sumie kontrolnej
      return checksum === parseInt(nip[9], 10);
    }
);


const rules = computed(() => {
  return {
    vat_nip: {requiredIf: requiredIf(() => userType.value == false), minLength: minLength(10), nipValidator: nipValidator},
    account: {},
    iban_czk: {},
    iban_eur: {},
    iban_ron: {},
    iban_huf: {},
    iban_bgn: {},
    custom_pickup: {},
    notify_off: {},
    email: {required, email},
    email_invoice: {},
    email_cod: {email},
    vat_name: {required},
    phone: {required, minLength: minLength(9)},
    pickup_name: {},
    pickup_phone: {},
    pickup_street: {},
    pickup_postal: {},
    pickup_city: {},
    pickup_house_no: {},
    pickup_locum_no: {},
    vat_company: {requiredIf: requiredIf(() => userType.value == false)},
    vat_postal: {required},
    vat_city: {required},
    vat_street: {required},
    vat_house_no: {required},
    vat_locum_no: {},
    api_key: {},
    default_printer_type: {},
    low_bank_saldo_notify: {},
    low_bank_saldo_amount: {},
    low_bank_saldo_email: {},
    consumer_account: {},
    rodo: { requiredIf: requiredIf(() => userType.value == true)},
  };
});
const v$ = useVuelidate(rules, state);
const gusLoadingError = ref(false);
const gusLoadingErrorMessage = ref('');

const fullFillGusData = async () => {
  gusLoadingError.value = false;

  if (v$.value.vat_nip.nipValidator.$invalid) {
    return;
  }

  if (state.value.vat_nip.length === 10) {
    startLoadingAsyncData();
    let result = await fetchGusData(state.value.vat_nip)

    if (result?.data?.gusData) {
      let gusData = JSON.parse(result?.data?.gusData)

      if (gusData?.root?.dane?.ErrorMessagePl) {
        gusLoadingError.value = true;
        gusLoadingErrorMessage.value = gusData?.root?.dane?.ErrorMessagePl;
        return;
      }

      if (!gusData?.root?.dane) {
        gusLoadingError.value = true;
        return;
      }
    }

    if (result.success) {
      result = JSON.parse(result.data.gusData)
      result = result.root.dane
      checkEmptyFieldsFromGus(result)
      state.value.vat_company = result.Nazwa;
      state.value.vat_postal = result.KodPocztowy;
      state.value.vat_city = result.Miejscowosc;
      state.value.vat_street = result.Ulica;
      state.value.vat_house_no = result?.NrNieruchomosci;
      state.value.vat_locum_no = typeof result?.NrLokalu == 'object' && result?.NrLokalu.length == 0 ? '' : result?.NrLokalu;
      gusLoadingError.value = false;

      successMessageShow.value = true;
      successMessage.value = {
        title: 'Dane z GUS zostały wczytane do formularza',
        message: 'Możesz teraz zapisać formularz, aby zapisać zmiany.',
      }
    } else {
      gusLoadingError.value = true;
      gusLoadingErrorMessage.value = result.message;
    }
  }
}

const emptyFieldsFromGus = ref([])
const mapEmptyFieldsGus = ref([])
const gusMapToForm = {
  Regon: "vat_regon",
  Nip: "vat_nip",
  Nazwa: "vat_company",
  KodPocztowy: "vat_postal",
  Miejscowosc: "vat_city",
  Ulica: "vat_street",
  NrNieruchomosci: "vat_house_no",
  NrLokalu: "vat_locum_no",
  Telefon: "phone",
  Email: "email",
}
const isNotEmptyDataGus = (key: string) => {
  if (state.vat_nip == '') {
    return true;
  }

  if (!mapEmptyFieldsGus.value.includes(key)) {
    return true;
  }

  return false;
}
const checkEmptyFieldsFromGus = (data) => {
  let keys = Object.keys(data);
  keys.forEach((key) => {
    if (data[key] == '' || data[key] == null || data[key] == '[]') {
      emptyFieldsFromGus.value.push(key);
    }
  })

  emptyFieldsFromGus.value.forEach((key) => {
    if (gusMapToForm[key]) {
      mapEmptyFieldsGus.value.push(gusMapToForm[key])
    }
  })
}
const updateGusDataFunction = async () => {
  gusLoadingError.value = false;

  if (v$.value.vat_nip.nipValidator.$invalid) {
    return;
  }

  if (state.value.vat_nip.length === 10) {
    startLoadingAsyncData();
    let result = await updateGusData()

    if (result?.data?.gusData) {
      let gusData = JSON.parse(result?.data?.gusData)

      if (gusData?.root?.dane?.ErrorMessagePl) {
        gusLoadingError.value = true;
        gusLoadingErrorMessage.value = gusData?.root?.dane?.ErrorMessagePl;
        return;
      }

      if (!gusData?.root?.dane) {
        gusLoadingError.value = true;
        return;
      }
    }

    if (result.success) {
      result = JSON.parse(result.data.gusData)
      result = result.root.dane
      checkEmptyFieldsFromGus(result)
      state.value.vat_company = result.Nazwa;
      state.value.vat_postal = result.KodPocztowy;
      state.value.vat_city = result.Miejscowosc;
      state.value.vat_street = result.Ulica;
      state.value.vat_house_no = result?.NrNieruchomosci;
      state.value.vat_locum_no = result?.NrLokalu == '[]' ? '' : result?.NrLokalu;
      gusLoadingError.value = false;

      successMessageShow.value = true;
      successMessage.value = {
        title: 'Dane z GUS zostały wczytane do formularza',
        message: 'Możesz teraz zapisać formularz, aby zapisać zmiany.',
      }
    } else {
      gusLoadingError.value = true;
      gusLoadingErrorMessage.value = result.message;
    }
  }
}

const smsCode = ref('');
const saveResultErrors = ref({});
const submit = async (e) => {
  e.preventDefault();
  v$.value.$touch();

  loaderMsg.value = 'Zapisywanie danych...';

  if (v$.value.$invalid) {
    return;
  }

  const data = {
    Broker: {
      ...(userType.value ? state_consumer : state_vat),
      consumer_account: userType.value,
    },
  }
  console.log(checkVerificationSmsIsNeeded.value)
  if (checkVerificationSmsIsNeeded.value && !smsCode.value && showSmsVerificationModal.value === false) {
    showSmsVerificationModal.value = true;
    await sendVerificationSMS();
    return;
  }

  if (smsCode.value === '' && checkVerificationSmsIsNeeded.value) {
    return;
  }

  if (checkVerificationSmsIsNeeded.value && smsCode.value) {
    data.UserTemp = {
      sms_code: smsCode.value,
    }
  }

  startLoadingAsyncData();
  const result = await saveUserProfile(data);

  if (result.success) {
    if (isSemiUser.value) {
      const token = useCookie('token');
      token.value = state.value.email + '/' + result.data.sess_id;
      await setNewToken(token.value);
      isSemiUser.value = false;
      await getExternalUserData();
      successMessageShow.value = true;
      successMessage.value = {
        title: 'Dane zostały zapisane',
        message: 'Prawidłowo zapisano Twoje dane. Możesz teraz korzystać z pełni funkcjonalności panelu.',
      }

      return;
    }

    successMessageShow.value = true;
    successMessage.value = {
      title: 'Dane zostały zapisane',
      message: 'Prawidłowo zapisano Twoje dane.',
    }

    showSmsVerificationModal.value = false;
    smsCode.value = '';
    saveResultErrors.value = {};
  } else {
    successMessageShow.value = false;
    successMessage.value = {
      title: '',
      message: '',
    }
    errorMessageShow.value = true;
    errorMessage.value = {
      title: 'Błąd podczas zapisywania danych',
      message: result.message,
    }
    saveResultErrors.value = result.errors;
    showSmsVerificationModal.value = false;

    errorMessageShow.value = true;
    errorMessage.value = {
      title: 'Błąd podczas zapisywania danych',
      message: result.message,
    }

    if (result.message == 'Nieprawidłowy kod weryfikacyjny') {
      verificationSmsErrorMessage.value = result.message;
      verificationSmsResponse.value.success = false;
      verificationSmsResponse.value.message = result.message;
      showSmsVerificationModal.value = true;

    }
  }
}

let errorKeys = [];
const checkVerificationSmsIsNeeded = computed(() => {
  let status = false;

  if (isSemiUser.value) {
    return status;
  }

  for (const [key, value] of Object.entries(dataChangeForceSmsVerification)) {
    console.log(state.value[key], key, state[key])
    if (state.value[key]) {
      if (value != state.value[key].trim()) {
        status = true;

        if (!errorKeys.includes(key)) {
          errorKeys.push(key);
        }
      } else {
        if (errorKeys.includes(key)) {
          errorKeys = errorKeys.filter(item => item !== key);
        }
      }
    }
  }

  return status;
})

const recaptchaInstance = useReCaptcha();
const errorPhoneBackendValidation = ref(null)
const sendVerificationSMS = async () => {
  const tokenSms = await recaptchaInstance?.executeRecaptcha('smsCode');

  let request = {
    phone: state.value.phone,
    'g-recaptcha-response': tokenSms
  }

  await sendForUserVerificationSMS(request);

  if (String(verificationSmsErrorMessage.value).length > 0 && !verificationSmsErrorMessage.value.success) {
    errorPhoneBackendValidation.value = verificationSmsErrorMessage.value.message;
    showSmsVerificationModal.value = false;
  } else {
    errorPhoneBackendValidation.value = null;
    showSmsVerificationModal.value = true;
  }
}

const showEmailBalance = ref(false);

const showInfoModal = ref(false);
const showInfoModalType = ref('');

const showAddress = ref(true);
const showApi = ref(false);
const showBank = ref(false);
const showNotification = ref(false);

const contentTypes = {
  company_info: {
    title: 'Dane firmowe',
    content: 'Na podstawie danych firmowych generujemy dokumenty jak np. faktura VAT. Upewnij się że dane są poprawne.'
  },
  invoice_email: {
    title: 'Adres e-mail do powiadomień o fakturach',
    content: 'Jeżeli chcesz podać kilka adresów email, przedziel je przecinkami (np.: example@domain.com, example2@domain.com). <br>Jeśli pole pozostanie nieuzupełnione, powiadomienia przyjdą na główny adres email'
  },
  invoice_notification: {
    title: 'Adres e-mail do powiadomień o pobraniach',
    content: 'Jeżeli chcesz podać kilka adresów email, przedziel je przecinkami (np.: example@domain.com, example2@domain.com). <br>Jeśli pole pozostanie nieuzupełnione, powiadomienia przyjdą na główny adres email'
  },
  bank_accounts: {
    title: 'Numery kont bankowych do zwrotu pobrań',
    content: 'Podany rachunek musi być zarejestrowany w polskim banku, również dla zwrotów w innej walucie'
  },
  api_configuration: {
    title: 'Konfiguracja API',
    content: 'Klucz API jest niezbędny do połączenia BLPaczka.com z Baselinker.com, wtyczkami na platformach sklepowych oraz do bezpośredniego połączenia twojego sklepu z API BLPaczka.com'
  },
  low_bank_saldo_notification: {
    title: 'Adres e-mail do powiadomień o niskim saldzie skarbomki',
    content: 'Jeśli pusty, powiadomienia przyjdą na główny adres email'
  },
}

const apiKeyGenerateMessage = ref('');
const apiKeyGenerateSuccess = ref(null);
const generateNewKey = async () => {
  let apiKey = Math.random().toString(36).substr(2) + Math.random().toString(36).substr(2);
  let result = await saveApiKey(apiKey);

  apiKeyGenerateSuccess.value = result.success;
  if (result.success) {
    state.api_key = apiKey;
    apiKeyGenerateMessage.value = 'Klucz został wygenerowany poprawnie';
  } else {
    apiKeyGenerateMessage.value = 'Wystąpił błąd podczas generowania klucza';
  }
}

useHead({
  title: t('page.panel.user.profile.title')
});

definePageMeta({
  middleware: 'auth',
  layout: 'panel',
})
</script>

<template>
  <form class="userData_container" style="position: relative">
    <div class="userData_card">
      <div class="userData_title" @click="showAddress = !showAddress">
        <div class="row row--alignCenter">
          <h3 class="form_subtitle form_subtitle--noMargin form_subtitle--userData">
            Dane firmowe (wypełnienie obowiązkowe)
            <NuxtImg src="icons/tooltipIcon.png" width="11px" height="11px" style="width: 11px; height: 11px;" @click.stop.prevent="showInfoModalType = 'company_info'; showInfoModal = true"/>
          </h3>

          <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg" v-show="showAddress">
            <circle cx="20" cy="20" r="20" fill="#F2F5FB"/>
            <path d="M24.8125 21.6562L20.5022 16.625L16.1875 21.6562" stroke="#4285F4" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
          <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg" v-show="!showAddress">
            <circle cx="20" cy="20" r="20" transform="matrix(1 0 0 -1 0 40)" fill="#F2F5FB"/>
            <path d="M24.8125 18.3438L20.5022 23.375L16.1875 18.3438" stroke="#4285F4" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </div>
      </div>

      <div class="userData_description" v-show="showAddress">
        <div>
          <span class="userData_dangerTxt" style="display: block; color: #262B44;">Aby uzyskać dostęp do wszystkich funkcjonalności blpaczka.com należy wypełnić i zapisać dane firmowe/adresowe.</span>
        </div>

        <div class="row row--alignStart row--baseline row--gap16" v-if="isSemiUser">
          <div class="form_inputContainer300">
            <div class="row row--checkboxContainer">
              <input type="checkbox" id="state.consumer_account_false" name="state.consumer_account_false" style="cursor: pointer" @change="(event) => {userType = false}" :checked="!userType"/>
              <label for="state.consumer_account_false" class="signin_label signin_label--checkbox signin_label--smallMargin" style="max-width: 600px; cursor: pointer">
                Klient firmowy
              </label>
            </div>
          </div>

          <div class="form_inputContainer300">
            <div class="row row--checkboxContainer">
              <input type="checkbox" id="state.consumer_account_true" name="state.consumer_account_true" style="cursor: pointer" @change="(event) => {userType = true}" :checked="userType"/>
              <label for="state.consumer_account_true" class="signin_label signin_label--checkbox signin_label--smallMargin" style="max-width: 600px; cursor: pointer">
                Klient indywidualny
              </label>
            </div>
          </div>
        </div>

        <div class="row row--alignStart row--baseline row--gap16" v-if="isSemiUser || !userType">

          <div v-if="!userExternalData?.Broker?.vat_nip"
               class="form_inputContainer300">
            <label for="" class="form_label">NIP<i v-if="!userType">*</i></label>
            <input type="text" id="" name="" class="form_inputTxt form_inputTxt--withoutUnit" :class="{'form_inputTxt--error': gusLoadingError}" v-model="v$.vat_nip.$model" @change="fullFillGusData" max="10" :disabled="userType"/>
            <span v-show="gusLoadingError" class="form_errorMsg form_errorMsg--noMarginBottom form_errorMsg--show">{{ gusLoadingErrorMessage }}</span>
            <span v-if="saveResultErrors?.vat_nip" class="form_errorMsg form_errorMsg--noMarginBottom form_errorMsg--show">{{saveResultErrors?.vat_nip[0]}}</span>
            <span v-show="v$.vat_nip.$errors?.find(error => error.$validator == 'nipValidator')" class="calc_errorMsg calc_errorMsg--show">{{ v$.vat_nip.nipValidator.$message }}</span>
          </div>

          <div v-else
               class="form_inputContainer300">
            <label for="" class="form_label">NIP</label>
            <input type="text" id="" name="" class="form_inputTxt form_inputTxt--withoutUnit" :value="state.vat_nip" disabled/>
            <span v-show="gusLoadingError" class="form_errorMsg form_errorMsg--noMarginBottom form_errorMsg--show">{{ gusLoadingErrorMessage }}</span>
            <span v-if="saveResultErrors?.vat_nip" class="form_errorMsg form_errorMsg--noMarginBottom form_errorMsg--show">{{saveResultErrors?.vat_nip[0]}}</span>
          </div>

          <button v-if="userExternalData?.Broker?.vat_nip" class="userData_buttonGUS" @click.prevent="updateGusDataFunction">Aktualizuj dane GUS</button>
        </div>

        <div class="row row--alignStart row--baseline row--gap16">
          <div class="form_inputContainer300">
            <label for="" class="form_label">Imię i nazwisko<i>*</i></label>
              <input type="text" id="" name="" class="form_inputTxt form_inputTxt--withoutUnit" :class="{'form_inputTxt--error': v$.vat_name.$error}" v-model="v$.vat_name.$model"/>
              <span v-if="v$.vat_name.$error" class="form_errorMsg form_errorMsg--negativeMargin form_errorMsg--show">Pole jest wymagane</span>
          </div>

          <div class="form_inputContainer300" v-if="isSemiUser || !userType">
            <label for="" class="form_label">Nazwa firmy<i v-if="!userType">*</i></label>
            <input type="text" id="" name="" class="form_inputTxt form_inputTxt--withoutUnit" :class="{'form_inputTxt--error': v$.vat_company.$error}" v-model="v$.vat_company.$model" :disabled="true"/>
            <span v-if="v$.vat_company.$error" class="form_errorMsg form_errorMsg--negativeMargin form_errorMsg--show">Pole jest wymagane</span>
          </div>
        </div>

        <div class="row row--alignStart row--baseline row--gap16">
          <div class="form_inputContainer300">
            <label for="" class="form_label">Telefon<i>*</i></label>
            <input type="text" id="" name="" maxlength="9" class="form_inputTxt form_inputTxt--withoutUnit" :class="{'form_inputTxt--error': v$.phone.$error}" v-model="v$.phone.$model" @keyup="errorPhoneBackendValidation = null"/>
            <span v-if="v$.phone.$error" class="form_errorMsg form_errorMsg--negativeMargin form_errorMsg--show">Pole jest wymagane, długość: 9 cyfr</span>
            <span v-if="String(errorPhoneBackendValidation).length > 0" class="form_errorMsg form_errorMsg--negativeMargin form_errorMsg--show">{{ errorPhoneBackendValidation }}</span>
          </div>

          <div v-if="!userExternalData?.Broker?.email"
               class="form_inputContainer300">
            <label for="" class="form_label">Adres e-mail</label>
            <input type="text" id="" name="" class="form_inputTxt form_inputTxt--withoutUnit" v-model="v$.email.$model"/>
            <span v-if="saveResultErrors?.email.length > 0" class="form_errorMsg form_errorMsg--negativeMargin form_errorMsg--show">{{saveResultErrors?.email[0]}}</span>
          </div>

          <div v-else
               class="form_inputContainer300">
            <label for="" class="form_label">Adres e-mail</label>
            <input type="text" id="" name="" class="form_inputTxt form_inputTxt--withoutUnit" :value="userExternalData?.Broker?.email" disabled/>
          </div>
        </div>

        <div class="row row--alignStart row--baseline row--gap16">
          <div class="form_inputContainer300">
            <label for="" class="form_label">Kod pocztowy<i>*</i></label>
            <input type="text" id="" name="" class="form_inputTxt form_inputTxt--withoutUnit" :class="{'form_inputTxt--error': v$.vat_postal.$error}" v-model="v$.vat_postal.$model" :disabled="isNotEmptyDataGus('vat_postal') || !userType"/>
            <span v-if="v$.vat_postal.$error" class="form_errorMsg form_errorMsg--negativeMargin form_errorMsg--show">Pole jest wymagane</span>
            <span v-if="saveResultErrors?.postal" class="form_errorMsg form_errorMsg--negativeMargin form_errorMsg--show">{{saveResultErrors?.postal[0]}}</span>
          </div>

          <div class="form_inputContainer300">
            <label for="" class="form_label">Miasto<i>*</i></label>
            <input type="text" id="" name="" class="form_inputTxt form_inputTxt--withoutUnit" :class="{'form_inputTxt--error': v$.vat_city.$error}" v-model="v$.vat_city.$model" :disabled="isNotEmptyDataGus('vat_city') || !userType"/>
            <span v-if="v$.vat_city.$error" class="form_errorMsg form_errorMsg--negativeMargin form_errorMsg--show">Pole jest wymagane</span>
          </div>
        </div>

        <div class="row row--alignStart row--baseline row--gap16">
          <div class="form_inputContainer300">
            <label for="" class="form_label">Ulica<i>*</i></label>
            <input type="text" id="" name="" class="form_inputTxt form_inputTxt--withoutUnit" :class="{'form_inputTxt--error': v$.vat_street.$error}" v-model="v$.vat_street.$model" :disabled="isNotEmptyDataGus('vat_street') "/>
            <span v-if="v$.vat_street.$error" class="form_errorMsg form_errorMsg--negativeMargin form_errorMsg--show">Pole jest wymagane</span>
          </div>

          <div class="form_inputContainer142">
            <label for="" class="form_label">Nr budynku<i>*</i></label>
            <input type="text" id="" name="" class="form_inputTxt form_inputTxt--withoutUnit" :class="{'form_inputTxt--error': v$.vat_house_no.$error}" v-model="v$.vat_house_no.$model" :disabled="isNotEmptyDataGus('vat_house_no') || !userType"/>
            <span v-if="v$.vat_house_no.$error" class="form_errorMsg form_errorMsg--negativeMargin form_errorMsg--show">Pole jest wymagane</span>
          </div>

          <div class="form_inputContainer142">
            <label for="" class="form_label">Nr mieszkania</label>
            <input type="text" id="" name="" class="form_inputTxt form_inputTxt--withoutUnit" v-model="v$.vat_locum_no.$model" :disabled="isNotEmptyDataGus('vat_locum_no') || !userType"/>
          </div>

          <div class="row row--alignStart row--baseline row--gap16" v-if="isSemiUser && userType">
            <div class="form_inputContainer300">
              <div class="row row--checkboxContainer">
                <input type="checkbox" id="state.rodo" name="state.rodo" style="cursor: pointer" @change="(event) => state.rodo = event.target.checked"/>
                <label for="state.rodo" class="signin_label signin_label--checkbox signin_label--smallMargin" style="max-width: 600px; cursor: pointer">
                  Fajka od RODO<i>*</i>
                </label>
                <span v-if="v$.rodo.$error" class="form_errorMsg form_errorMsg--negativeMargin form_errorMsg--show">Pole jest wymagane</span>
              </div>
            </div>
            </div>
        </div>

        <div class="row row--alignStart row--baseline row--gap16">
          <div class="calc_inputContainer calc_inputContainer--fullWidth">
            <div class="row row--checkboxContainer">
              <input type="checkbox" id="custom_pickup" name="custom_pickup" style="cursor: pointer" @change="(event) => v$.custom_pickup.$model = event.target.checked" :checked="state.custom_pickup"/>
              <label for="custom_pickup" class="signin_label signin_label--checkbox signin_label--smallMargin" style="max-width: 600px; cursor: pointer">
                Inny adres odbioru przesyłek
              </label>
            </div>
          </div>
        </div>
<!--gi7mmls1%40example.com%2F4ue09j7p6781pc1bhogqcf9g89-->
        <div v-show="v$.custom_pickup.$model">
          <div class="row row--alignStart row--baseline row--gap16">
            <div class="form_inputContainer300">
              <label for="" class="form_label">Imię i nazwisko/firma</label>
              <input type="text" id="" name="" class="form_inputTxt form_inputTxt--withoutUnit" v-model="v$.pickup_name.$model"/>
            </div>

            <div class="form_inputContainer300">
              <label for="" class="form_label">Telefon</label>
              <input type="text" id="" name="" class="form_inputTxt form_inputTxt--withoutUnit" v-model="v$.pickup_phone.$model"/>
            </div>
          </div>

          <div class="row row--alignStart row--baseline row--gap16">
            <div class="form_inputContainer300">
              <label for="" class="form_label">Kod pocztowy</label>
              <input type="text" id="" name="" class="form_inputTxt form_inputTxt--withoutUnit" v-model="v$.pickup_postal.$model"/>
            </div>

            <div class="form_inputContainer300">
              <label for="" class="form_label">Miasto</label>
              <input type="text" id="" name="" class="form_inputTxt form_inputTxt--withoutUnit" v-model="v$.pickup_city.$model"/>
            </div>
          </div>

          <div class="row row--alignStart row--baseline row--gap16">
            <div class="form_inputContainer300">
              <label for="" class="form_label">Ulica</label>
              <input type="text" id="" name="" class="form_inputTxt form_inputTxt--withoutUnit" v-model="v$.pickup_street.$model"/>
            </div>

            <div class="form_inputContainer142">
              <label for="" class="form_label">Nr budynku</label>
              <input type="text" id="" name="" class="form_inputTxt form_inputTxt--withoutUnit" v-model="v$.pickup_house_no.$model"/>
            </div>

            <div class="form_inputContainer142">
              <label for="" class="form_label">Nr mieszkania</label>
              <input type="text" id="" name="" class="form_inputTxt form_inputTxt--withoutUnit" v-model="v$.pickup_locum_no.$model"/>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="userData_card" v-if="!userType">
      <div class="userData_title" @click="showApi = !showApi">
        <div class="row row--alignCenter">
          <h3 class="form_subtitle form_subtitle--noMargin form_subtitle--userData">Konfiguracja API</h3>

          <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg" v-show="showApi">
            <circle cx="20" cy="20" r="20" fill="#F2F5FB"/>
            <path d="M24.8125 21.6562L20.5022 16.625L16.1875 21.6562" stroke="#4285F4" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
          <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg" v-show="!showApi">
            <circle cx="20" cy="20" r="20" transform="matrix(1 0 0 -1 0 40)" fill="#F2F5FB"/>
            <path d="M24.8125 18.3438L20.5022 23.375L16.1875 18.3438" stroke="#4285F4" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </div>
      </div>

      <div class="userData_description" v-show="showApi">
        <div class="row row--alignStart row--baseline row--gap16">
          <div class="form_inputContainer300">
            <label for="" class="form_label">
              Klucz autoryzacji do API (api_key)
              <NuxtImg src="icons/tooltipIcon.png" style="margin-left: 5px; width: 11px; height: 11px" width="11px" height="11px" @click.prevent="showInfoModalType = 'api_configuration'; showInfoModal = true"/>
            </label>
            <input type="text" id="" name="" class="form_inputTxt form_inputTxt--withoutUnit" v-model="v$.api_key.$model" readonly/>
            <span v-if="apiKeyGenerateMessage" :class="[
                    apiKeyGenerateSuccess ? 'form_successMsg form_successMsg--negativeMargin' : 'form_errorMsg form_errorMsg--negativeMargin',
                    apiKeyGenerateMessage ? 'form_successMsg--show' : 'form_errorMsg--show'

                ]">{{ apiKeyGenerateMessage }}</span>
          </div>
          <button class="filters_buttonSecondary filters_buttonSecondary--api" @click.prevent="generateNewKey">Generuj nowy</button>

          <span class="userData_dangerTxt userData_dangerTxt--showMobile">Uwaga, po wygenerowaniu nowego klucza dotychczasowy straci ważność</span>

          <div class="form_inputContainer300 form_inputContainer300--printer">
            <label for="" class="form_label">Domyślny typ drukarki</label>
            <InputFilterSelect
                :options="printerTypes"
                @change="state.default_printer_type = $event"
                :base-value="state.default_printer_type"
                v-no-letters
            />
          </div>
        </div>

        <div class="row">
          <span class="userData_dangerTxt userData_dangerTxt--hideMobile">Uwaga, po wygenerowaniu nowego klucza dotychczasowy straci ważność</span>
        </div>
      </div>
    </div>

    <div class="userData_card">
      <div class="userData_title" @click="showBank = !showBank">
        <div class="row row--alignCenter">
          <h3 class="form_subtitle form_subtitle--noMargin form_subtitle--userData">
            Numery kont bankowych do zwrotu pobrań
            <NuxtImg src="icons/tooltipIcon.png"  style="margin-left: 5px; width: 11px; height: 11px" width="11px" height="11px" @click.stop.prevent="showInfoModalType = 'bank_accounts'; showInfoModal = true"/>
          </h3>

          <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg" v-show="showBank">
            <circle cx="20" cy="20" r="20" fill="#F2F5FB"/>
            <path d="M24.8125 21.6562L20.5022 16.625L16.1875 21.6562" stroke="#4285F4" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
          <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg" v-show="!showBank">
            <circle cx="20" cy="20" r="20" transform="matrix(1 0 0 -1 0 40)" fill="#F2F5FB"/>
            <path d="M24.8125 18.3438L20.5022 23.375L16.1875 18.3438" stroke="#4285F4" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </div>
      </div>

      <div class="userData_description" v-show="showBank">

        <div>
          <span class="userData_dangerTxt" style="display: block; color: #262B44;">Wymagane do obsługi przesyłek za pobraniem (COD)</span>
        </div>
        <div class="row row--alignStart row--baseline row--gap16">
          <div class="form_inputContainer300">
            <label for="" class="form_label">Dla: Złoty Polski (PLN)</label>
            <input type="text" id="" name="" class="form_inputTxt form_inputTxt--withoutUnit" :class="{'form_inputTxt--error': saveResultErrors?.account}" v-model="v$.account.$model"/>
            <span v-if="saveResultErrors?.account" class="form_errorMsg form_errorMsg--negativeMargin form_errorMsg--show">{{ saveResultErrors?.account[0] }}</span>
          </div>

          <div class="form_inputContainer300">
            <label for="" class="form_label">Dla: Euro (EUR)</label>
            <input type="text" id="" name="" class="form_inputTxt form_inputTxt--withoutUnit" :class="{'form_inputTxt--error': saveResultErrors?.iban_eur}" v-model="v$.iban_eur.$model"/>
            <span v-if="saveResultErrors?.iban_eur" class="form_errorMsg form_errorMsg--negativeMargin form_errorMsg--show">{{ saveResultErrors?.iban_eur[0] }}</span>
          </div>
        </div>

        <div class="row row--alignStart row--baseline row--gap16">
          <div class="form_inputContainer300">
            <label for="" class="form_label">Dla: Korona Czeska (CZK)</label>
            <input type="text" id="" name="" class="form_inputTxt form_inputTxt--withoutUnit" :class="{'form_inputTxt--error': saveResultErrors?.iban_czk}" v-model="v$.iban_czk.$model"/>
            <span v-if="saveResultErrors?.iban_czk" class="form_errorMsg form_errorMsg--negativeMargin form_errorMsg--show">{{ saveResultErrors?.iban_czk[0] }}</span>
          </div>

          <div class="form_inputContainer300">
            <label for="" class="form_label">Dla: Lej Rumuński (RON)</label>
            <input type="text" id="" name="" class="form_inputTxt form_inputTxt--withoutUnit" :class="{'form_inputTxt--error': saveResultErrors?.iban_ron}" v-model="v$.iban_ron.$model"/>
            <span v-if="saveResultErrors?.iban_ron" class="form_errorMsg form_errorMsg--negativeMargin form_errorMsg--show">{{ saveResultErrors?.iban_ron[0] }}</span>
          </div>
        </div>

        <div class="row row--alignStart row--baseline row--gap16">
          <div class="form_inputContainer300">
            <label for="" class="form_label">Dla: Forint Węgierski (HUF)</label>
            <input type="text" id="" name="" class="form_inputTxt form_inputTxt--withoutUnit" :class="{'form_inputTxt--error': saveResultErrors?.iban_huf}" v-model="v$.iban_huf.$model"/>
            <span v-if="saveResultErrors?.iban_huf" class="form_errorMsg form_errorMsg--negativeMargin form_errorMsg--show">{{ saveResultErrors?.iban_huf[0] }}</span>
          </div>
        </div>

        <div class="row row--alignStart row--baseline row--gap16">
          <div class="form_inputContainer300">
            <label for="" class="form_label">Dla: Lew Bułgarski (BGN)</label>
            <input type="text" id="" name="" class="form_inputTxt form_inputTxt--withoutUnit" :class="{'form_inputTxt--error': saveResultErrors?.iban_bgn}" v-model="v$.iban_bgn.$model"/>
            <span v-if="saveResultErrors?.iban_bgn" class="form_errorMsg form_errorMsg--negativeMargin form_errorMsg--show">{{ saveResultErrors?.iban_bgn[0] }}</span>
          </div>
        </div>
      </div>
    </div>

    <div class="userData_card">
      <div class="userData_title" @click="showNotification = !showNotification">
        <div class="row row--alignCenter">
          <h3 class="form_subtitle form_subtitle--noMargin form_subtitle--userData">
            Powiadomienia
          </h3>

          <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg" v-show="showNotification">
            <circle cx="20" cy="20" r="20" fill="#F2F5FB"/>
            <path d="M24.8125 21.6562L20.5022 16.625L16.1875 21.6562" stroke="#4285F4" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
          <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg" v-show="!showNotification">
            <circle cx="20" cy="20" r="20" transform="matrix(1 0 0 -1 0 40)" fill="#F2F5FB"/>
            <path d="M24.8125 18.3438L20.5022 23.375L16.1875 18.3438" stroke="#4285F4" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </div>
      </div>

      <div class="userData_description" v-show="showNotification">
        <div class="row row--alignStart row--baseline row--gap16">
          <div class="form_inputContainer616">
            <label for="" class="form_label">Adres/y e-mail do powiadomień o fakturach<NuxtImg src="icons/tooltipIcon.png" width="11px" height="11px" @click.prevent="showInfoModalType = 'invoice_email'; showInfoModal = true"/></label>
            <input type="text" id="" name="" class="form_inputTxt form_inputTxt--withoutUnit" v-model="v$.email_invoice.$model"/>
          </div>
        </div>

        <div class="row row--alignStart row--baseline row--gap16">
          <div class="form_inputContainer616">
            <label for="" class="form_label">Adres/y e-mail do powiadomień o pobraniach<NuxtImg src="icons/tooltipIcon.png" width="11px" height="11px" @click.prevent="showInfoModalType = 'invoice_notification'; showInfoModal = true"/></label>
            <input type="text" id="" name="" class="form_inputTxt form_inputTxt--withoutUnit" v-model="v$.email_cod.$model"/>
          </div>
        </div>

        <div class="row row--alignStart row--baseline row--gap16">
          <div class="row row--checkboxContainer">
            <input type="checkbox" id="low_bank_saldo_notify" name="low_bank_saldo_notify" @change="(event) => v$.low_bank_saldo_notify.$model = event.target.checked" :checked="v$.low_bank_saldo_notify.$model" @click="showEmailBalance = !showEmailBalance"/>
            <label for="low_bank_saldo_notify" class="signin_label signin_label--checkbox signin_label--smallMargin" style="max-width: 600px">
              Włącz powiadomienia e-mail o niskim saldzie skarbonki
            </label>
          </div>
        </div>

        <div v-show="showEmailBalance">
          <div class="row row--alignStart row--baseline row--gap16">
            <div class="form_inputContainer300">
              <label for="" class="form_label">Adres e-mail do powiadomień o niskim saldzie<NuxtImg src="icons/tooltipIcon.png" width="11px" height="11px" @click.prevent="showInfoModalType = 'low_bank_saldo_notification'; showInfoModal = true"/></label>
              <input type="text" id="" name="" class="form_inputTxt form_inputTxt--withoutUnit" :class="{'form_inputTxt--error': saveResultErrors?.low_bank_saldo_email}" v-model="v$.low_bank_saldo_email.$model"/>
              <span v-if="saveResultErrors?.low_bank_saldo_email" class="form_errorMsg form_errorMsg--negativeMargin form_errorMsg--show">{{ saveResultErrors?.low_bank_saldo_email[0] }}</span>
            </div>

            <div class="form_inputContainer300">
              <label for="" class="form_label">Kwota dla powiadomienia</label>
              <input type="text" id="" name="" class="form_inputTxt form_inputTxt--withoutUnit" :class="{'form_inputTxt--error': saveResultErrors?.low_bank_saldo_amount}" v-model="v$.low_bank_saldo_amount.$model"/>
              <span v-if="saveResultErrors?.low_bank_saldo_amount" class="form_errorMsg form_errorMsg--negativeMargin form_errorMsg--show">{{ saveResultErrors?.low_bank_saldo_amount[0] }}</span>
            </div>
          </div>
        </div>

        <div class="row row--checkboxContainer" v-if="!state.consumer_account">
          <input type="checkbox" id="notify_off" name="notify_off" @change="(event) => v$.notify_off.$model = event.target.checked" :checked="v$.notify_off.$model"/>
          <label for="notify_off" class="signin_label signin_label--checkbox signin_label--smallMargin" style="max-width: 600px">
            Wyłącz powiadomienia e-mail dotyczące zamówień/paczek/statusów
          </label>
        </div>
      </div>
    </div>

<!--    <div class="userData_card">-->
<!--      <div class="userData_title">-->
<!--        <div class="row row&#45;&#45;alignCenter" @click="showOthers = !showOthers">-->
<!--          <h3 class="form_subtitle form_subtitle&#45;&#45;noMargin">Pozostałe</h3>-->

<!--          <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg" v-show="showOthers">-->
<!--            <circle cx="20" cy="20" r="20" fill="#F2F5FB"/>-->
<!--            <path d="M24.8125 21.6562L20.5022 16.625L16.1875 21.6562" stroke="#4285F4" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>-->
<!--          </svg>-->
<!--          <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg" v-show="!showOthers">-->
<!--            <circle cx="20" cy="20" r="20" transform="matrix(1 0 0 -1 0 40)" fill="#F2F5FB"/>-->
<!--            <path d="M24.8125 18.3438L20.5022 23.375L16.1875 18.3438" stroke="#4285F4" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>-->
<!--          </svg>-->
<!--        </div>-->
<!--      </div>-->

<!--      <div class="userData_description" v-show="showOthers">-->
<!--        <div class="row">-->
<!--          <div class="row row&#45;&#45;alignStart row&#45;&#45;baseline row&#45;&#45;gap16">-->
<!--            <label for="" class="form_label">Domyślny typ drukarki</label>-->
<!--            <InputFilterSelect-->
<!--                :options="printerTypes"-->
<!--                @change="state.default_printer_type = $event"-->
<!--                :base-value="state.default_printer_type"-->
<!--                v-no-letters-->
<!--            />-->
<!--          </div>-->
<!--        </div>-->
<!--      </div>-->
<!--    </div>-->

    <div class="userData_buttonWrapper userData_buttonWrapper--fixedBottom">
      <button class="userData_button" @click="submit">Zapisz</button>
    </div>
    <FormSpinerLoaderWithText :loading="loading">{{ loaderMsg ?? 'Procesowanie...' }}</FormSpinerLoaderWithText>
  </form>

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

  <ModalSmsVerification
      :show-modal="showSmsVerificationModal"
      @hide="showSmsVerificationModal = false"
      :phone="state.phone" @update:smsCode="smsCode = $event;"
      :errors="errorKeys"
  />
</template>

<style scoped>

</style>