<script setup lang="ts">
import usePageStore from "~/stores/usePageStore";
import {useVuelidate} from "@vuelidate/core";
import orderFormStore from "~/stores/panel/orderFormStore";
import {required, email, maxValue, maxLength} from '@vuelidate/validators';
import usePackageTemplateStore from "~/stores/panel/usePackageTemplateStore";
import useAddressBookStore from "~/stores/panel/useAddressBookStore";

const {t} = useI18n();
const {
  form,
  packageFields,
  senderFields,
  servicesFields,
  formErrors,
  showPackageDetails,
  showSenderDetails,
  showServicesDetails
} = storeToRefs(usePackageTemplateStore());
const {fetchPackageTemplate, updatePackageTemplate} = usePackageTemplateStore();
const state = form.value;
const showInfoModal = ref(false);
const showInfoModalType = ref('');
const {setPageValues} = usePageStore();
const {errorMessageShow, errorMessage} = storeToRefs(usePageStore());
const router = useRouter();
const nuxt = useNuxtApp();

onMounted(async () => {
  const result = await fetchPackageTemplate(router.currentRoute.value.params.id);
  Object.keys(result.PackageTemplate).forEach((key) => {
    form.value[key] = result.PackageTemplate[key];
  });

  packageFields.value.forEach((field) => {
    if (form.value[field] !== null && form.value[field] !== '') {
      showPackageDetails.value = true;
    }
  });

  senderFields.value.forEach((field) => {
    if (form.value[field] !== null && form.value[field] !== '') {
      showSenderDetails.value = true;
    }
  });

  servicesFields.value.forEach((field) => {
    if (form.value[field] !== null && form.value[field] !== '' && form.value[field] !== false) {
      showServicesDetails.value = true;
    }
  });
});

const weightMaxValue = computed(() => {
  switch (state.type) {
    case 'package':
      return 70.0;
    case 'envelope':
      return 70.0;
    case 'pallet':
      return 1000.0;
    case 'not_standard':
      return 1000.0;
    default:
      return 70.0;
  }
})

const postalRegex = (value) => {
  if (value.length === 0) {
    return true;
  }

  const regex = /^[0-9]{2}-[0-9]{3}$/
  return regex.test(value);
}
const rules = computed(() => {
  return {
    template_name: {required, maxLength: maxLength(255)},
    user_id: {},
    type: {maxLength: maxLength(50)},
    country_code: {},
    weight: {maxLength: maxLength(100), maxValue: maxValue(weightMaxValue)},
    side_x: {maxLength: maxLength(100)},
    side_y: {maxLength: maxLength(100)},
    side_z: {maxLength: maxLength(100)},
    sortable_id: {},
    cover: {maxLength: maxLength(100)},
    uptake: {maxLength: maxLength(100)},
    postal_sender: {maxLength: maxLength(20), postalRegex},
    postal_delivery: {maxLength: maxLength(20)},
    delivery_private: {},
    send_private: {},
    return_docs: {},
    no_pickup: {},
    inpost_weekend: {},
    return_pallet: {},
    bringing: {},
    bringing_and_unpack: {},
    delivery_type: {maxLength: maxLength(255)},
    city: {maxLength: maxLength(100)},
    email: {email, maxLength: maxLength(100)},
    house_no: {maxLength: maxLength(100)},
    locum_no: {maxLength: maxLength(100)},
    name: {maxLength: maxLength(100)},
    phone: {maxLength: maxLength(100)},
    vat_company: {maxLength: maxLength(250)},
    // postal: {maxLength: maxLength(100), postalRegex},
    street: {maxLength: maxLength(100)},
    taker_city: {maxLength: maxLength(100)},
    taker_email: {email, maxLength: maxLength(100)},
    taker_house_no: {maxLength: maxLength(100)},
    taker_locum_no: {maxLength: maxLength(100)},
    taker_name: {maxLength: maxLength(100)},
    taker_phone: {maxLength: maxLength(100)},
    taker_postal: {maxLength: maxLength(100)},
    taker_street: {maxLength: maxLength(100)},
    taker_vat_company: {maxLength: maxLength(250)},
    taker_point: {maxLength: maxLength(255)},
    package_content: {maxLength: maxLength(200)}
  };
});

const v$ = useVuelidate(rules, state);

const save = async () => {
  v$.value.$touch();
  if (v$.value.$invalid) {
    return;
  }

  if (!showSenderDetails.value) {
    senderFields.value.forEach((field) => {
      form.value[field] = '';
    });
  }

  if (!showPackageDetails.value) {
    packageFields.value.forEach((field) => {
      form.value[field] = '';
    });
  }

  if (!showServicesDetails.value) {
    servicesFields.value.forEach((field) => {
      form.value[field] = '';
    });
  }

  let result = await updatePackageTemplate();

  if (result) {
    formErrors.value = []
    router.push(nuxt.$localePath('panel-automations-package-templates'));
  } else {
    errorMessageShow.value = true;
    errorMessage.value.title = 'Nie udało się zapisać szablonu.';
    errorMessage.value.message = 'Spróbuj ponownie lub skontaktuj się z administratorem.';
  }
}

setPageValues(
    t('page.panel.automations.package-templates.title'),
);
useHead({
  title: t('page.panel.automations.package-templates.title')
});
definePageMeta({
  middleware: 'auth',
  layout: 'panel',
})

//TODO: przeniesc do osbnego komponentu
const contentTypes = {
  insurance: {
    title: 'Ubezpieczenie',
    content: 'Możesz ubezpieczyć swoją paczkę na wypadek zagubienia lub uszkodzenia. Koszt ubezpieczenia zależy od wartości paczki. Sprawdź nasz cennik, aby dowiedzieć się więcej.'
  },
  uptake: {
    title: 'Pobranie',
    content: 'Pamiętaj o podaniu kwoty w walucie docelowej danego kraju. Np. W przypadku przesyłki do Niemiec, kwotę podajemy w Euro'
  },
  courier: {
    title: 'Kurier',
    content: 'Podane kwoty nie zawierają podatku VAT. Koszt wysyłki jest obliczany na podstawie danych wolumetrycznych paczki i wybranej metody wysyłki. Sprawdź nasz cennik, aby dowiedzieć się więcej'
  },
  sender_details: {
    title: 'Dane nadawcy',
    content: 'Wprowadź swoje dane lub pobierz je z książki adresowej.'
  },
  recipient_details: {
    title: 'Dane odbiorcy',
    content: 'Wprowadź dane odbiorcy lub pobierz je z książki adresowej.'
  },
  package_type: {
    title: 'Kształt i rodzaj opakowania',
    content: '<b>Standardowa</b> - Przesyłka standardowa to przesyłka kartonowa o niezniekształconym kształcie prostopadłoscianu, zabezpieczona taśmą lub opona zapakowana zgodnie z wytycznymi przewoźników. <br/><b>Niestandardowa</b> - ' +
        'Przesyłka niestandardowa to np.:<br/> Paczka o kształcie owalnym, kulistym, cylindrycznym (np. tuba), <br/>Paczka o nieregularnych kształtach, zniekształcona o nierównych krawędziach, z wystającymi elementami <br/>Paczka, która zawierają substancje płynne (beczki, kanistry, wiadra itp.)'
  }
}
</script>

<template>
  <div class="form_container">
    <div class="form_card">
      <div class="row row--alignStart row--gap16">
        <div class="form_inputContainer300">
          <label for="" class="form_label">Nazwa szablonu<i>*</i></label>

          <div class="form_inputWithUnit form_inputWithUnit--noMargin"
               :class="v$.template_name.$error ? 'form_inputWithUnit--error' : ''">
            <input type="text" v-model="form.template_name" class="form_inputTxt"
                   @change="state.template_name = $event.target.value"
            />
          </div>
          <span v-if="v$.template_name.$error" class="signin_errorMsg signin_errorMsg--show">Pole jest wymagane</span>
        </div>
      </div>
    </div>

    <PackageTemplatePackageSection/>

    <PackageTemplateSenderSection/>

    <!--    <PackageTemplateRecipientSection />-->

    <PackageTemplateServicesSection/>

    <div class="form_card">
      <div class="orderForm_summaryButtonsContainer" style="width: 100%">
        <button class="orderForm_buttonGhost orderForm_buttonGhost--narrow" @click.prevent="save()">Zapisz</button>
      </div>
    </div>
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
