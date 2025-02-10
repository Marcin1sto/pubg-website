<script setup lang="ts">
import {useReCaptcha} from "vue-recaptcha-v3";
import {email, required} from "@vuelidate/validators";
import {useVuelidate} from "@vuelidate/core";

const props = defineProps({
  formTypes: Array,
  useCheckboxSection: {
    type: Boolean,
    default: false
  }
})
const recaptchaInstance = useReCaptcha();
const { userExternalData } = storeToRefs(useUserStore())

const formTypes = ref([]);

const formIsLoading = ref(false)
const {getApiRoute} = useApiRoutes();
const form = reactive({
  Form: {
    name: '',
    type: '',
    phone: '',
    email: '',
    body: ''
  },
  'g-recaptcha-response': ''
})

const rules = computed(() => {
  return {
    Form: {
      email: {required, email},
      name: {required},
      phone: {required},
      type: {required},
      body: {required}
    }
  };
});

const v$ = useVuelidate(rules, form);

form.Form.name = userExternalData.value?.Broker?.name ?? '';
form.Form.phone = userExternalData.value?.Broker?.phone ?? '';
form.Form.email = userExternalData.value?.Broker?.email ?? '';

const successMessage = ref(false);

const fetchContactTypes = async () => {
  const {data, pending, error}: any = await useTheFetch(getApiRoute('contact.staticTypes'), {});

  if (error?.value) {
    data.value = JSON.parse(error.value.data)
  }

  if (data.value.success && data.value.data) {
    formTypes.value = data.value.data;
  }
}

onMounted(async () => {
  await fetchContactTypes()
})

const submit = async () => {
  if (formIsLoading.value) return

  v$.value.$touch();

  if (v$.value.$invalid) {
    return;
  }

  formIsLoading.value = true
  const token = await recaptchaInstance?.executeRecaptcha('contact');

  if (token) {
    form["g-recaptcha-response"] = token ?? '';
  }

  form.Form.subject = 'Formularz kontaktowy -' + formTypes.value.find((type) => type.code === form.Form.type)?.name ?? '';

  const {data, pending, error}: any = await useTheFetch(getApiRoute('contact.send'), {
    method: 'POST',
    body: form,
  });

  if (error?.value) {
    formIsLoading.value = false;
    data.value = JSON.parse(error.value.data)
  }

  if (data.value.success) {
    successMessage.value = true;
    formIsLoading.value = false;
    form.Form = {
      name: '',
      type: '',
      phone: '',
      email: '',
      body: ''
    }

    form.Form.name = userExternalData.value?.Broker?.name ?? '';
    form.Form.phone = userExternalData.value?.Broker?.phone ?? '';
    form.Form.email = userExternalData.value?.Broker?.email ?? '';
  }
}

const showNewsLatterMoreInfo = ref(false)
</script>

<template>
  <div class="formElements">
    <div class="successMsg" v-show="successMessage">
      <div class="successMsg--title"><NuxtImg src="icons/orderForm/checkGreen.png"/> <span>Dziękujemy za kontakt</span></div>
      <div class="successMsg--text">Dziękujemy za przesłanie wiadomości. Skontaktujemy się z Tobą wkrótce.</div>
    </div>

    <h3 class="title">Formularz kontaktowy</h3>
    <div class="form_inputs">
      <InputTextWithLabel
          :is-required="true"
          :input-model-value="form.Form.name ?? ''"
          element-id="brokerName"
          label-text="Imię i Nazwisko"
          @change="form.Form.name = $event"
          :validation-error-message="v$.Form.name.$error ? 'Pole jest wymagane' : ''"
      />
      <InputFilterSelect
          :is-required="true"
          :options="formTypes"
          label="Temat wiadomości"
          container-class="inputContainer"
          :base-value="form.Form.type"
          @change="form.Form.type = $event"
          :validation-error-message="v$.Form.type.$error ? 'Pole jest wymagane' : ''"
      />
      <InputTextWithLabel
          :is-required="true" element-id="formPhone"
          :input-model-value="form.Form.phone ?? ''"
          @change="form.Form.phone = $event"
          label-text="Numer telefonu"
          :validation-error-message="v$.Form.phone.$error ? 'Pole jest wymagane' : ''"
      />
      <InputTextWithLabel
          :is-required="true" element-id="formEmail"
          :input-model-value="form.Form.email ?? ''"
          v-model="form.Form.email"
          @change="form.Form.email = $event"
          label-text="Adres e-mail"
          :validation-error-message="v$.Form.email.$error ? 'Pole jest wymagane' : ''"
      />
      <InputTextAreaWithLabel
          :is-required="true"
          element-id="formMessage"
          label-text="Treść wiadomości"
          v-model="form.Form.body"
          @change="form.Form.body = $event.target.value"
          :validation-error-message="v$.Form.body.$error ? 'Pole jest wymagane' : ''"
      />
    </div>
    <div v-if="useCheckboxSection">
      <div class="row row--checkboxContainer">
        <input type="checkbox" id="consent" name="consent"/>
        <label for="consent" class="signin_label signin_label--checkbox">Akceptuję <nuxt-link-locale to="regulations" class="signin_cardLink">Regulamin</nuxt-link-locale> i oświadczam, że zapoznałem/am się z <nuxt-link-locale tabindex="-1" to="privacy-policy" class="signin_cardLink">Polityką Prywatności</nuxt-link-locale><i>*</i></label>
      </div>
      <div class="row row--checkboxContainer">
        <input type="checkbox" id="newsletter" name="newsletter"/>
        <label for="newsletter" class="signin_label signin_label--checkbox signin_label--pickCursor" style="max-width: 600px" @click.prevent="showNewsLatterMoreInfo = !showNewsLatterMoreInfo">
          Zgadzam się na otrzymywanie od spółek z grupy BaseLinker, w tym BaseLinker sp. z o.o. oraz BL Logistics sp. z o.o.
          działającej pod marką BL Paczka, {{ !showNewsLatterMoreInfo ? "(Pokaż więcej)" : "BaseLinker sp. z o.o. oraz Helpratchet sp. z o.o., informacji o promocjach oraz ofertach specjalnych lub innych treści marketingowych dotyczących usług oferowanych przez spółki z grupy za pośrednictwem komunikacji elektronicznej lub telefonu oraz na przetwarzanie moich danych przez spółki z grupy w związanych z tym celach marketingowych, zgodnie z przepisami prawa i przyjętą przez daną spółkę grupy Polityką Prywatności dostępną w jej serwisie. Zostałem poinformowany, że w każdej chwili mogę wycofać udzieloną zgodę.Zaznaczając tę opcję zgadzasz się na komunikowanie się z Tobą poprzez dostępne kanały komunikacji, w tym e-mail, SMS/MMS lub telefon. Wycofanie zgody pozostaje bez wpływu na zgodność z prawem wysyłanych dotychczas informacji marketingowych." }}</label>
      </div>
    </div>
    <ButtonSecondary @click.prevent="submit" :aria-disabled="formIsLoading">Skontaktuj się z nami
    </ButtonSecondary>
  </div>
</template>

<style scoped lang="scss">
.successMsg {
  border: 1px solid #F2F2F2;
  background: #F2F5FB;
  border-radius: 8px;
  padding: 24px;

  &--title {
    font-family: Open Sans;
    font-size: 16px;
    font-weight: 700;
    line-height: 21.79px;
    text-align: left;
    display: flex;
    align-items: center;
    gap: 16px;
    color: #262B44;
  }

  &--text {
    font-family: Open Sans;
    font-size: 14px;
    font-weight: 400;
    line-height: 19.07px;
    text-align: left;
    color: #262B44;
    margin-top: 10px;
    color: #262B44;
  }
}

.form_inputs {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 24px;
  color: #262B44;
  //width: 618px;

  :last-child {
    grid-column: span 2;
  }

  @media screen and (max-width: 799px) {
    grid-template-columns: 1fr;

    :last-child {
      grid-column: span 1;
    }
  }
}

.formElements {
  display: flex;
  flex-direction: column;
  gap: 24px;
}

.title {
  font-family: Open Sans;
  font-size: 23.04px;
  font-weight: 600;
  line-height: 23.04px;
  text-align: left;
  margin-bottom: 32px;
  color: #262B44;
}
</style>