<script setup lang="ts">
import usePageStore from "~/stores/usePageStore";
import usePackageTemplateStore from "~/stores/panel/usePackageTemplateStore";
import {useTableStore} from "~/stores/useTableStore";

const { t } = useI18n();
const showFilters = ref(true);
const { setPageValues } = usePageStore();
const { setItems, setHeaders, startLoadingAsyncData } = useTableStore();
const { getPackageTemplates } = usePackageTemplateStore();
const { tableItems, searchParams } = storeToRefs(usePackageTemplateStore());

const tableHeaders = [
  {key: 'created', label: t('packageTemplates.table.created'), sortable: true},
  {key: 'name', label: t('packageTemplates.table.name'), sortable: true},
  {key: 'weight', label: t('packageTemplates.table.weight'), sortable: true},
  {key: 'dimensions', label: t('packageTemplates.table.dimensions'), sortable: true},
  {key: 'sender_address', label: t('packageTemplates.table.sender_address'), sortable: true},
  {key: 'actions', label: t('packageTemplates.table.actions'), sortable: true},
]

const fetchWithFilters = async () => {
  startLoadingAsyncData();
  await setItems(tableItems.value);
}

const clearFilters = async () => {
  searchParams.value = {};
  await setItems(tableItems.value);
}

const asyncData = async () => {
  await setHeaders(tableHeaders)
  startLoadingAsyncData();
  await getPackageTemplates();
  await setItems(tableItems.value);
};

const { page } = storeToRefs(useTableStore());
let unwatchAddressBookPage = watch(page, (newValue) => {
  searchParams.value.page = newValue;
  asyncData();
});

onMounted(async () => {
  page.value = 1;
});

// onBeforeRouteLeave((to, from, next) => {
//   unwatchAddressBookPage();
//   next();
// });

await asyncData();
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
</script>

<template>
  <Table :use-store="true" :table-headers="tableHeaders">
    <template #additional>
      <div class="table_buttonWrapper">
        <nuxt-link-locale to="panel-automations-package-templates-create" class="filters_buttonSecondary">Dodaj szablon</nuxt-link-locale>
      </div>
    </template>
  </Table>
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