<script setup lang="ts">
import usePageStore from "~/stores/usePageStore";

const { t } = useI18n();
const { setPageValues } = usePageStore();

setPageValues(
    t('page.panel.order.selling.title'),
);

useHead({
  title: t('page.panel.order.selling.title')
});

definePageMeta({
  middleware: 'auth',
  layout: 'panel',
})
</script>

<template>

</template>

<style scoped>

</style>