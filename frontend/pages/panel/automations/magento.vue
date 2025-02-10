<script setup lang="ts">
const nuxt = useNuxtApp();

definePageMeta({
  middleware: 'auth',
  layout: 'panel',
})

</script>

<template>
  <div class="plugins_container">
    <div class="plugins_infoContainer">
      <div class="row" style="margin-bottom: 36px">
        <NuxtImg src="/images/plugins/magento/magento.svg" width="100%"/>
      </div>

      <div class="row">
        <h1 class="plugins_infoTitle">BLPaczka – Wtyczka Magento</h1>
      </div>

      <div class="row">
        <p class="plugins_infoTxt">Wtyczka BLPaczka dla Magento to nowoczesne narzędzie do zarządzania przesyłkami bezpośrednio z poziomu sklepu. Pozwala na automatyczną wycenę paczek, zamawianie kuriera oraz pobieranie etykiet w jednym miejscu.</p>
      </div>

      <div class="row">
        <p class="plugins_infoTxt">Korzyści z korzystania z BLPaczka:</p>
      </div>

      <div class="row">
        <p class="plugins_infoTxt">
          – Automatyczna wycena przesyłek i generowanie etykiet wysyłkowych. <br>
          – Obsługa wielu przewoźników i punktów nadawczych. <br>
          – Możliwość konfiguracji mapy punktów odbioru oraz metod dostawy. <br>
          – Prosty proces zamawiania i śledzenia przesyłek bezpośrednio z panelu administracyjnego. <br>
          – Intuicyjna obsługa i szybka integracja z Magento.
        </p>
      </div>

      <div class="row">
        <p class="plugins_infoTxt">Aby skorzystać z wtyczki, załóż bezpłatne konto na BLPaczka.</p>
      </div>

      <div class="row">
        <div class="pricesDetails_containerItems">
            <a :href="nuxt.$localePath('/plugins/InstrukcjaIntegracjiMagento.pdf')" class="pricesDetails_containerItem">
          <span class="pricesDetails_containerContent">
            <span class="pricesDetails_containerName" style="text-align: center">Pobierz instrukcję instalacji</span>
          </span>
              <span class="pricesDetails_icon">
            <NuxtImg src="icons/download.png" width="30px" height="30px"/>
          </span>
            </a>

          <a :href="nuxt.$localePath('/plugins/blpaczka-magento-master.zip')" class="pricesDetails_containerItem">
          <span class="pricesDetails_containerContent">
            <span class="pricesDetails_containerName" style="text-align: center">Pobierz pliki instalacyjne</span>
          </span>
            <span class="pricesDetails_icon">
            <NuxtImg src="icons/download.png" width="30px" height="30px"/>
          </span>
          </a>
        </div>
      </div>
    </div>
  </div>
</template>
