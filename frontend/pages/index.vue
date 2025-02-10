<template>
  <main-site />
</template>

<script setup lang="ts">
const { t } = useI18n();
useHead({
  title: t('page.homePage.title'),
});

const router = useRouter();
const { authenticated } = storeToRefs(useAuthStore());
const { checkIfUserIsAuthenticated } = useAuthStore();
checkIfUserIsAuthenticated();

onMounted(() => {
  const router = useRouter();

  if (router.currentRoute.value.hash === '#kalkulatorWyceny') {
    const sendPackage = document.getElementById('kalkulatorWyceny');
    if (sendPackage) {
      sendPackage.scrollIntoView({ behavior: 'smooth', block: "center" });
    }
  }

  if (router.currentRoute.value.hash === '#onas') {
    const sendPackage = document.getElementById('onas');
    if (sendPackage) {
      sendPackage.scrollIntoView({ behavior: 'smooth', block: "center" });
    }
  }
})

definePageMeta({
  middleware: 'default-layout',
})

</script>

<style scoped>

</style>