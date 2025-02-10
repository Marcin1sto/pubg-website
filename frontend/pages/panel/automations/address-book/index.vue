<script setup lang="ts">
import usePageStore from "~/stores/usePageStore";
import {useTableStore} from "~/stores/useTableStore";
import useAddressBookStore from "~/stores/panel/useAddressBookStore";
import {ref} from "vue";

const { t } = useI18n();
const { setPageValues } = usePageStore();
const { successMessage, successMessageShow } = storeToRefs(usePageStore());
const { getAddresses, fetchTypes } = useAddressBookStore();
const { tableItems, searchParams } = storeToRefs(useAddressBookStore());
const { setItems, setHeaders, startLoadingAsyncData } = useTableStore();
setPageValues(
    t('page.panel.automations.address-book.title'),
    true
);
const showFilters = ref(true);
const tableHeaders = [
  {key: 'name', label: t('address-book.table.name'), sortable: true},
  {key: 'type', label: t('address-book.table.type'), sortable: true},
  {key: 'email', label: t('address-book.table.email'), sortable: true},
  {key: 'phone', label: t('address-book.table.phone'), sortable: true},
  {key: 'street', label: t('address-book.table.street'), sortable: true},
  {key: 'postal_code', label: t('address-book.table.postal_code'), sortable: true},
  {key: 'city', label: t('address-book.table.city'), sortable: true},
  {key: 'actions', label: t('address-book.table.actions'), sortable: true},
];
const typesOptions = [
  {name: 'Odbiorca', code: '2'},
  {name: 'Nadawca', code: '1'},
];
const asyncData = async () => {
  await setHeaders(tableHeaders)
  await fetchTypes();
  startLoadingAsyncData();
  await getAddresses();
  await setItems(tableItems.value);
};

await asyncData();

const { page } = storeToRefs(useTableStore());
let unwatchAddressBookPage = watch(page, (newValue) => {
  searchParams.value.page = newValue;
  asyncData();
});

onMounted(() => {
  page.value = 1;
});

const clearFilters = async () => {
  searchParams.value = {};
  await getAddresses();
  await setItems(tableItems.value);
}


const fetchWithFilters = async () => {
  startLoadingAsyncData();
  await getAddresses();
  await setItems(tableItems.value);
}

onBeforeRouteLeave((to, from, next) => {
  unwatchAddressBookPage();
  next();
});

const showImportContactsModal = ref(false);
const formImportContacts = new FormData();
const importError = ref(false);
const importErrorMessage = ref('');

const importContacts = async () => {
  const {getApiRoute, formatApiGetRoute} = useApiRoutes();
  const {data, pending, error}: any = await useTheFetch(getApiRoute('addressBooks.import'), {
    method: 'POST',
    body: formImportContacts
  });

  if (error.value) {
    importError.value = true;
    importErrorMessage.value = error.value.data.message;
    return;
  }

  if (data.value.success) {
    successMessage.value = {
      message: data.value.message,
      title: 'Import kontaków udany',
    }
    successMessageShow.value = true;
    importError.value = false;
    importErrorMessage.value = '';
  }

  await fetchWithFilters();
  showImportContactsModal.value = false;
}

const fileChanged = (event) => {
  var files = event.target.files || event.dataTransfer.files;

  if (!files.length) {
    return;
  }

  formImportContacts.append('file', files[0]);
}

useHead({
  title: t('page.panel.automations.address-book.title')
});
definePageMeta({
  middleware: 'auth',
  layout: 'panel',
})
</script>

<template>
  <div class="form_filters">
    <div class="filters_container">
      <div class="filters_row">
          <span class="filters_searchInputContainer">
            <input type="text" placeholder="Wpisz dowolną treść" :value="searchParams.search_string"
                   class="filters_searchInput" @change="searchParams.search_string = $event.target.value">
            <button><NuxtImg src="icons/orderDetails/search.png" width="21px" height="21px"
                             class="filters_searchButton"/></button>
          </span>
        <button class="orderDetails_backButton" @click="showFilters = !showFilters">
          {{ showFilters ? 'Ukryj' : 'Pokaż' }} filtry
          <NuxtImg :src="!showFilters ? 'icons/orderDetails/arrowDown.png' : 'icons/orderDetails/arrowUp.png'"
                   width="37px" height="37px" class="filters_backButtonImg"/>
        </button>
      </div>

      <div class="filters_content" v-show="showFilters">
        <div class="row row--alignStart row--alignBaseline row--gap16">
          <InputFilterDatepicker :disable-year-select="false" :label="'Dodano od'" @change="searchParams.from = $event"
                                 :value="searchParams.from"/>
          <InputFilterDatepicker :disable-year-select="false" :label="'Dodano do'" @change="searchParams.to = $event"
                                 :value="searchParams.to"/>
          <InputFilterSelect :label="'Typ kontaktu'" :options="typesOptions"
                             @change="searchParams.type_id = $event" :base-value="searchParams.type_id"/>
        </div>
        <div class="filters_contentButtonsContainer">
          <button class="filters_buttonPrimary" @click="fetchWithFilters">Szukaj</button>
          <button class="filters_buttonSecondary" v-show="Object.values(searchParams).length > 0" @click="clearFilters">
            Wyczyść filtry
          </button>
        </div>
      </div>
    </div>
  </div>
  <Table :use-store="true" :table-headers="tableHeaders">
    <template #additional>
      <div class="table_buttonWrapper">
        <nuxt-link-locale to="panel-automations-address-book-create" class="filters_buttonSecondary">Dodaj kontakt</nuxt-link-locale>
        <button @click="showImportContactsModal = true" class="filters_buttonSecondary">Importuj kontakty</button>
      </div>
    </template>
  </Table>

  <Teleport to="body">
    <Modal :show="showImportContactsModal" @close="showImportContactsModal = false">
      <template #header>
        <h2>Importuj kontakty</h2>
      </template>
      <template #body>
        <div>
          <p>Importuj kontakty z pliku CSV</p>
          <p>Wybierz plik z danymi kontaktowymi</p>
          <div style="display: flex; gap: 10px; align-items: center">
            <p>Przykładowy schemat przyjmowanych danych do pobrania:</p>
            <a href="/files/import-contacts/przyklad-import.csv" class="filters_buttonSecondary" download>Pobierz schemat</a>
          </div>
          <p style="margin-top: 5px">We wprowadzonym pliku nagłówki pierwszego wiersza muszą się zgadzać ze schematem w przykładowym pliku.</p>
          <input type="file" accept=".csv" @change="fileChanged($event)" style="margin-top: 20px;"/>
          <span v-if="importError"
                class="signin_errorMsg signin_errorMsg--show">{{ importErrorMessage }}. Sprawdź format pliku czy jest zgodny z schematem.</span>
        </div>
      </template>
      <template #buttons>
        <div class="orderForm_summaryModalButtonsContainer">
          <button class="orderForm_buttonGhost" @click.prevent="showImportContactsModal = false">Zamknij</button>
          <button class="orderForm_buttonPrimary" @click.prevent="importContacts()">Importuj</button>
        </div>
      </template>
    </Modal>
  </Teleport>
</template>

<style lang="scss" scoped>
.additional_buttons {
  display: flex;
  justify-content: flex-start;
  align-items: center;
  gap: 16px;
  margin-bottom: 16px;
  padding-inline: 32px;
}
</style>