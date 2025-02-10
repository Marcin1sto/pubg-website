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
      <div class="row">
        <h1 class="plugins_infoTitle">BLPaczka – Wtyczka PrestaShop</h1>
      </div>

      <div class="row">
        <p class="plugins_infoTxt">Wtyczka BLPaczka dla PrestaShop umożliwia szybkie zarządzanie przesyłkami bezpośrednio z panelu administracyjnego sklepu. Dzięki niej możesz automatycznie wyceniać paczki, zamawiać kuriera oraz generować etykiety wysyłkowe w kilka kliknięć.</p>
      </div>

      <div class="row">
        <p class="plugins_infoTxt">Korzyści z korzystania z BLPaczka:</p>
      </div>

      <div class="row">
        <p class="plugins_infoTxt">
          – Automatyczna wycena przesyłek oraz możliwość masowego generowania etykiet. <br>
          – Integracja z wieloma przewoźnikami i punktami nadawczymi. <br>
          – Intuicyjna mapa punktów odbioru dla wygodnego wyboru. <br>
          – Możliwość anulowania przesyłek i ponownego zamówienia w tym samym miejscu. <br>
          – Prosta konfiguracja i szybka integracja z systemem sklepowym.
        </p>
      </div>

      <div class="row">
        <p class="plugins_infoTxt">Aby skorzystać z wtyczki, załóż bezpłatne konto na BLPaczka.</p>
      </div>

      <div class="row">
        <p class="plugins_infoTxt">
          <a :href="nuxt.$localePath('/plugins/InstrukcjaIntegracjiPrestaShop.pdf')" class="plugins_infoLink">Pobierz instrukcję instalacji</a>
        </p>
      </div>

      <div class="row">
        <p class="plugins_infoTxt">
          <a :href="nuxt.$localePath('/plugins/blpaczka-presta-master.zip')" class="plugins_infoLink">Pobierz pliki instalacyjne</a>
        </p>
      </div>
    </div>
  </div>
</template>
