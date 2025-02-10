<script lang="ts">
import Multiselect from 'vue-multiselect'

export default {
  components: {
    Multiselect
  },
  data () {
    return {
      value: [
      ],
      options: [
        {name: 'Odbiorca', code: '2'},
        {name: 'Nadawca', code: '1'},
      ]
    }
  },
  methods: {
    addTag (newTag) {
      const tag = {
        name: newTag,
        code: newTag.substring(0, 2) + Math.floor((Math.random() * 10000000))
      }
      this.options.push(tag)
      this.value.push(tag)
    }
  }
}
</script>

<script setup lang="ts">
import usePageStore from "~/stores/usePageStore";
import useAddressBookStore from "~/stores/panel/useAddressBookStore";
import {email, minLength, required} from "@vuelidate/validators";
import { useVuelidate } from "@vuelidate/core";

const { t } = useI18n();
const { formErrors } = storeToRefs(useAddressBookStore());
const { createContact } = useAddressBookStore();

const state = reactive({
  name: '',
  vat_company: '',
  email: '',
  phone: '',
  street: '',
  postal: '',
  city: '',
  type_id: '',
});

const rules = computed(() => {
  return {
    type_id: { required },
    email: { email },
    name: { required },
    phone: { required },
    street: { required },
    postal: { required },
    city: { required },
    vat_company: {  },
    house_no: {  },
    locum_no: {  },
  };
});

const v$ = useVuelidate(rules, state);

const router = useRouter();
const nuxt = useNuxtApp();
const submit = async (e) => {
  v$.value.$touch();

  if (v$.value.$invalid) {
    return;
  }

  let result = await createContact(state);

  if (result) {
    formErrors.value = []
    router.push(nuxt.$localePath('panel-automations-address-book'))
  }

  return;
}

const firstErrorMessage = (key) => {
  const errorMessages = formErrors.value[key];
  if (errorMessages) {
    const firstKey = Object.keys(errorMessages)[0];
    return errorMessages[firstKey];
  }
  return null;
};

const { setPageValues } = usePageStore();
setPageValues(
    t('page.panel.automations.address-book.title'),
);
useHead({
  title: t('page.panel.automations.address-book.title')
});
definePageMeta({
  middleware: 'auth',
  layout: 'panel',
})
</script>

<template>
  <div class="panel_mainContainer">
    <form @submit.prevent="submit" class="form_card">
      <div class="row">
        <h2 class="form_subtitle">Dane kontaktowe</h2>
      </div>
      <div class="row row--gap16 row--alignStart">
        <InputFilterSelect
            label="Typ Kontaktu"
            :options="options"
            @change="state.type_id = $event"
            container-class="form_inputContainer616"
            :error-msg="v$.type_id.$error ? 'Pole jest wymagane' :firstErrorMessage('type_id')"
            :is-required="true"
        />
      </div>

      <div class="row row--gap16 row--alignStart">
        <div class="form_inputContainer300">
          <label for="" class="form_label">Imię i nazwisko<i>*</i></label>
          <input type="text" v-model="v$.name.$model" class="form_inputTxt form_inputTxt--withoutUnit"/>
          <span v-if="formErrors.name || v$.name.$error" class="calc_errorMsg calc_errorMsg--show">{{ firstErrorMessage('name') ?? 'Pole jest wymagane' }}</span>
        </div>

        <div class="form_inputContainer300">
          <label for="" class="form_label">Firma</label>
          <input type="text" id="" name="" :value="state.vat_company" @change="state.vat_company = $event.target.value" class="form_inputTxt form_inputTxt--withoutUnit"/>
          <span v-if="formErrors.vat_company || v$.vat_company.$error" class="calc_errorMsg calc_errorMsg--show">{{ firstErrorMessage('company_name') ?? 'Pole jest wymagane' }}</span>
        </div>
      </div>

      <div class="row row--gap16 row--alignStart">
        <div class="form_inputContainer300">
          <label for="" class="form_label">Adres e-mail</label>
          <input type="text" id="" name="" :value="state.email" @change="state.email = $event.target.value" class="form_inputTxt form_inputTxt--withoutUnit"/>
          <span v-if="formErrors.email || (v$.email.email.$invalid && state.email)" class="calc_errorMsg calc_errorMsg--show">{{ firstErrorMessage('email') ?? 'Podaj poprawny adress email' }}</span>
        </div>

        <div class="form_inputContainer300">
          <label for="" class="form_label">Numer telefonu<i>*</i></label>
          <input type="text" id="" name="" :value="state.phone" @change="state.phone = $event.target.value" class="form_inputTxt form_inputTxt--withoutUnit"/>
          <span v-if="formErrors.phone || v$.phone.$error" class="calc_errorMsg calc_errorMsg--show">{{ firstErrorMessage('phone') ?? 'Pole jest wymagane' }}</span>
        </div>
      </div>

      <div class="row row--gap16 row--alignStart">
        <div class="form_inputContainer300">
          <label for="" class="form_label">Ulica<i>*</i></label>
          <input type="text" id="" name="" :value="state.street" @change="state.street = $event.target.value" class="form_inputTxt form_inputTxt--withoutUnit"/>
          <span v-if="formErrors.street || v$.street.$error" class="calc_errorMsg calc_errorMsg--show">{{ firstErrorMessage('street') ?? 'Pole jest wymagane' }}</span>
        </div>

        <div class="form_inputContainer142">
          <label for="" class="form_label">Numer domu</label>
          <input type="text" id="" name="" :value="state.house_no" @change="state.house_no = $event.target.value" class="form_inputTxt form_inputTxt--withoutUnit"/>
          <span v-if="formErrors.house_no || v$.house_no.$error" class="calc_errorMsg calc_errorMsg--show">{{ firstErrorMessage('house_no') ?? 'Pole jest wymagane' }}</span>
        </div>

        <div class="form_inputContainer142">
          <label for="" class="form_label">Numer lokalu</label>
          <input type="text" id="" name="" :value="state.locum_no" @change="state.locum_no = $event.target.value" class="form_inputTxt form_inputTxt--withoutUnit"/>
          <span v-if="formErrors.locum_no || v$.locum_no.$error" class="calc_errorMsg calc_errorMsg--show">{{ firstErrorMessage('locum_no') ?? 'Pole jest wymagane' }}</span>
        </div>
      </div>

      <div class="row row--gap16 row--alignStart">
        <div class="form_inputContainer300">
          <label for="" class="form_label">Kod pocztowy<i>*</i></label>
          <input type="text" id="" name="" :value="state.postal" @change="state.postal = $event.target.value" class="form_inputTxt form_inputTxt--withoutUnit"/>
          <span v-if="formErrors.postal || v$.postal.$error" class="calc_errorMsg calc_errorMsg--show">{{ firstErrorMessage('postal') ?? 'Pole jest wymagane' }}</span>
        </div>

        <div class="form_inputContainer300">
          <label for="" class="form_label">Miasto<i>*</i></label>
          <input type="text" id="" name="" :value="state.city" @change="state.city = $event.target.value" class="form_inputTxt form_inputTxt--withoutUnit"/>
          <span v-if="formErrors.city || v$.city.$error" class="calc_errorMsg calc_errorMsg--show">{{ firstErrorMessage('city') ?? 'Pole jest wymagane' }}</span>
        </div>
      </div>

      <div class="row row--gap16 row--alignStart">
        <button type="submit" class="form_buttonPrimaryAddressBook">Dodaj kontakt</button>

        <nuxt-link-locale to="panel-automations-address-book" class="form_backButtonAddressBook">
          <NuxtImg src="icons/orderDetails/arrowLeft.png" width="37px" height="37px"/>
          Wróć do listy kontaktów
        </nuxt-link-locale>
      </div>
    </form>
  </div>
</template>

<style scoped>
@import "assets/styles/_multiselect.scss";
</style>