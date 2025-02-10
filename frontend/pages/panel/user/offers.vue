<script setup lang="ts">
import usePageStore from "~/stores/usePageStore";
import {useTheFetch} from "~/composables/useTheFetch";

const { t } = useI18n();
const { setPageValues } = usePageStore();

const showForm = ref(true);

const formPersonal = ref({
  packageSize: {
    title: 'Jakiego gabarytu paczki nadajesz lub planujesz nadawać?',
    options: [
      { key: 'small', title: 'Małe paczki do 5kg (gabaryt A-B lub S-M)', selected: false },
      { key: '5kg', title: 'Średnie paczki powyżej 5kg (gabaryt C lub L-XL)', selected: false },
      { key: 'pallet', title: 'Półpalety i palety', selected: false },
      { key: 'no_standard', title: 'Niestandardowe', selected: false },
    ],
    comments: '',
  },
  packageVolume: {
    title: 'Jaki wolumen przesyłek przewidujesz?',
    value: '',
    comments: '',
  },
  businessCategory: {
    title: 'W jakiej branży/kategorii działa Twój biznes?',
    comments: '',
  },
  export: {
    title: 'Czy zajmujesz się eksportem?',
    value: '',
    comments: '',
  },
  importantInCooperation: {
    title: 'Co jest dla Ciebie ważne we współpracy z firmami kurierskimi?',
    comments: '',
  },
});

const { userExternalData } = storeToRefs(useUserStore());
const {getApiRoute} = useApiRoutes();
const submitForm = async () => {
  const { data, error } = await useTheFetch(getApiRoute('user.offer'), {
    method: 'POST',
    body: {
      Form: {
        email: userExternalData.value.Broker.email,
        name: userExternalData.value.Broker.vat_name,
        phone: userExternalData.value.Broker.phone,
        body: JSON.stringify(formPersonal.value),
      }
    },
  })

  if (data.value.success) {
    showForm.value = false;
  }
}

onMounted(() => {
  if (userExternalData.value.Broker.individual_offer_sent) {
    showForm.value = false;
  }
});

const updateOptionsStatus = (parentKey: string, optionKey, value) => {
  formPersonal.value[parentKey].options.find((option) => option.key === optionKey).selected = value;
}

const updateValueStatus = (parentKey: string, value) => {
  formPersonal.value[parentKey].value = value;
}

setPageValues(
    t('page.panel.price-list.personal.title'),
);

useHead({
  title: t('page.panel.price-list.personal.title')
});

definePageMeta({
  middleware: 'auth',
  layout: 'panel',
})
</script>

<template>
  <div style="box-sizing: unset; padding: 16px 32px" v-if="!showForm">
    <div class="panel_infoContainer panel_infoContainer--success">
      <div class="row">
        <h3 class="panel_infoTitle">Cześć</h3>
      </div>
      <div class="row">
        <p class="panel_infoTxt">Dziękujemy za wypełnienie ankiety. Niedługo wrócimy do Ciebie z propozycją.</p>
      </div>
    </div>
  </div>

  <div class="form_container" v-if="showForm">
    <div class="form_card">
      <div class="row">
        <h2 class="form_title" style="margin-bottom: 16px">W tym miejscu znajdziesz swoje indywidualne oferty!</h2>
      </div>

      <div class="row">
        <p class="form_subtitle" style="margin-bottom: 32px">Odpowiedz na kilka pytań, a postaramy się dopasować naszą ofertę do Twoich potrzeb.</p>
      </div>

      <div class="row">
        <div class="col-50">
          <div class="row">
            <p class="form_subtitle" style="margin-bottom: 8px">Jakiego gabarytu paczki nadajesz lub planujesz nadawać?</p>
          </div>

          <div class="row row--checkboxContainer" style="margin-bottom: 8px">
            <input type="checkbox" id="usluga30" name="usluga30"
               @change="updateOptionsStatus('packageSize', 'small', $event.target.checked)"
            />
            <label for="usluga30" class="form_checkboxLabel">Małe paczki do 5kg (gabaryt A-B lub S-M)</label>
          </div>

          <div class="row row--checkboxContainer" style="margin-bottom: 8px">
            <input type="checkbox" id="usluga31" name="usluga31"
               @change="updateOptionsStatus('packageSize', '5kg', $event.target.checked)"
            />
            <label for="usluga31" class="form_checkboxLabel">Średnie paczki powyżej 5kg (gabaryt C lub L-XL)</label>
          </div>

          <div class="row row--checkboxContainer" style="margin-bottom: 8px">
            <input type="checkbox" id="usluga32" name="usluga32"
               @change="updateOptionsStatus('packageSize', 'pallet', $event.target.checked)"
            />
            <label for="usluga32" class="form_checkboxLabel">Półpalety i palety</label>
          </div>

          <div class="row row--checkboxContainer" style="margin-bottom: 16px">
            <input type="checkbox" id="usluga33" name="usluga33"
               @change="updateOptionsStatus('packageSize', 'no_standard', $event.target.checked)"
            />
            <label for="usluga33" class="form_checkboxLabel">Niestandardowe</label>
          </div>
        </div>

        <div class="col-50">
          <div class="row">
            <div class="form_inputContainer616" style="margin-bottom: 32px">
              <label for="" class="form_deliveryTxt" style="margin-bottom: 8px">Uwagi</label>
              <textarea v-model="formPersonal.packageSize.comments" rows="5" id="" name="" class="form_inputTxt form_inputTxt--withoutUnit form_inputTxt--noHeight"/>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-50">
          <div class="row">
            <p class="form_subtitle" style="margin-bottom: 4px">Jaki wolumen przesyłek przewidujesz?</p>
          </div>

          <div class="row">
            <p class="form_deliveryTxt" style="margin-bottom: 8px">Rabat jest ustalany na podstawie zrealizowanego wolumenu</p>
          </div>

          <div class="row row--checkboxContainer" style="margin-bottom: 8px">
            <input type="radio" id="usluga34" name="usluga34" @change="updateValueStatus('packageVolume', 'Do 100');"/>
            <label for="usluga34" class="form_checkboxLabel">Do 100</label>
          </div>

          <div class="row row--checkboxContainer" style="margin-bottom: 8px">
            <input type="radio" id="usluga35" name="usluga34" @change="updateValueStatus('packageVolume', 'Do 500');"/>
            <label for="usluga35" class="form_checkboxLabel">Do 500</label>
          </div>

          <div class="row row--checkboxContainer" style="margin-bottom: 8px">
            <input type="radio" id="usluga36" name="usluga34" @change="updateValueStatus('packageVolume', 'Do 1000');"/>
            <label for="usluga36" class="form_checkboxLabel">Do 1000</label>
          </div>

          <div class="row row--checkboxContainer" style="margin-bottom: 16px">
            <input type="radio" id="usluga37" name="usluga34" @change="updateValueStatus('packageVolume', '1000+');"/>
            <label for="usluga37" class="form_checkboxLabel">1000+</label>
          </div>
        </div>

        <div class="col-50">
          <div class="row">
            <div class="form_inputContainer616" style="margin-bottom: 32px">
              <label for="" class="form_deliveryTxt" style="margin-bottom: 8px">Uwagi</label>
              <textarea v-model="formPersonal.packageVolume.comments" rows="5" id="" name="" class="form_inputTxt form_inputTxt--withoutUnit form_inputTxt--noHeight"/>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="form_inputContainer300" style="margin-bottom: 32px">
          <label for="" class="form_subtitle" style="margin-bottom: 8px">W jakiej branży/kategorii działa Twój biznes?</label>
          <input v-model="formPersonal.businessCategory.comments" type="text" id="" name="" class="form_inputTxt form_inputTxt--withoutUnit"/>
        </div>
      </div>

      <div class="row">
        <div class="col-50">
          <div class="row">
            <p class="form_subtitle" style="margin-bottom: 8px">Czy zajmujesz się eksportem?</p>
          </div>

          <div class="row row--checkboxContainer" style="margin-bottom: 8px">
            <input type="radio" id="usluga38" name="usluga38" @change="updateValueStatus('export', 'Tak, już to robię');"/>
            <label for="usluga38" class="form_checkboxLabel">Tak, już to robię</label>
          </div>

          <div class="row row--checkboxContainer" style="margin-bottom: 8px">
            <input type="radio" id="usluga39" name="usluga38" @change="updateValueStatus('export', 'Planuję w niedługim czasie');"/>
            <label for="usluga39" class="form_checkboxLabel">Planuję w niedługim czasie</label>
          </div>

          <div class="row row--checkboxContainer" style="margin-bottom: 8px">
            <input type="radio" id="usluga40" name="usluga38" @change="updateValueStatus('export', 'W przyszłosci pewnie tak');"/>
            <label for="usluga40" class="form_checkboxLabel">W przyszłosci pewnie tak</label>
          </div>

          <div class="row row--checkboxContainer" style="margin-bottom: 16px">
            <input type="radio" id="usluga41" name="usluga38" @change="updateValueStatus('export', 'Nie jestem zainteresowany eksportem');"/>
            <label for="usluga41" class="form_checkboxLabel">Nie jestem zainteresowany eksportem</label>
          </div>
        </div>

        <div class="col-50">
          <div class="row">
            <div class="form_inputContainer616" style="margin-bottom: 32px">
              <label for="" class="form_deliveryTxt" style="margin-bottom: 8px">Uwagi</label>
              <textarea v-model="formPersonal.export.comments" rows="5" id="" name="" class="form_inputTxt form_inputTxt--withoutUnit form_inputTxt--noHeight"/>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="form_inputContainer616" style="margin-bottom: 32px">
          <label for="" class="form_subtitle" style="margin-bottom: 8px">Co jest dla Ciebie ważne we współpracy z firmami kurierskimi?</label>
          <textarea v-model="formPersonal.importantInCooperation.comments" rows="5" id="" name="" class="form_inputTxt form_inputTxt--withoutUnit form_inputTxt--noHeight"/>
        </div>
      </div>

      <div class="row">
        <button class="userData_button" @click.prevent="submitForm">Wyślij</button>
      </div>
    </div>
  </div>
</template>

<style scoped>

</style>