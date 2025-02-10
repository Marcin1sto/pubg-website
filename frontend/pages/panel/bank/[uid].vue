<template>
  Przekierowywanie
</template>

<script setup lang="ts">
import useBankStore from "~/stores/panel/useBankStore";

const {t} = useI18n();

const { sendRechargeInfo } = useBankStore();
const router = useRouter();
const app = useNuxtApp();


onMounted(async () => {
  const params = {
    uid: router.currentRoute.value.params.uid,
    status: router.currentRoute.value.query.paymentStatus,
    paymentId: router.currentRoute.value.query.paymentId,
  };

  await sendRechargeInfo(params);
  router.push({path: app.$localePath('panel-bank'), query: {success: router.currentRoute.value.query.paymentStatus} });
});

useHead({
  title: t('page.panel.bank.title')
});

definePageMeta({
  middleware: 'auth',
  layout: 'panel',
})
</script>