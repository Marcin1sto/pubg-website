<template>
  <div style="display: flex; column-gap: 15px">
    <nuxt-link-locale to="/">{{ t('page.homePage.title') }}</nuxt-link-locale>
    <div>
      <nuxt-link-locale class="lang-link"
                 v-for="locale in availableLocales"
                 :key="locale.code"
                 :to="switchLocalePath(locale.code)">
        {{ locale.name }}
      </nuxt-link-locale>
    </div>

    <nuxt-link-locale to="login">{{ t('page.auth.login.title') }}</nuxt-link-locale>
    <nuxt-link-locale to="register">{{ t('page.auth.register.title') }}</nuxt-link-locale>
  </div>
</template>

<script setup lang="ts">
const { t, locale: currentLocale, locales } = useI18n();
const switchLocalePath = useSwitchLocalePath();

const availableLocales = computed(() => {
  return locales.value.filter(locale => locale.code !== currentLocale.value);
});

</script>


<style scoped>

</style>