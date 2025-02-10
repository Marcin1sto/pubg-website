<template>
  <div class="container">
    <div class="prices_banerContainer">
      <div class="prices_columnTxt">
        <div class="row">
          <h1 class="prices_title">Cennik niestandardowy</h1>
        </div>
        <div class="row">
          <ul class="prices_list">
            <li class="prices_listItem">Przesyłki o <strong>nietypowych kształtach</strong> bez konieczności pakowania w kartony o regularnych bokach</li>
            <li class="prices_listItem"><strong>Usługi dodatkowe</strong>, takie jak wniesienie czy rozpakowanie przesyłki</li>
            <li class="prices_listItem"><strong>Idealne rozwiązanie</strong> dla transportu mebli, dekoracji wnętrz, sprzętu sportowego i części samochodowych (i nie tylko)</li>
          </ul>
        </div>

        <div class="row">
          <nuxt-link-locale to="register" class="heroTxtContainer_button">Nadaj paczkę</nuxt-link-locale>
        </div>
      </div>
      <div class="prices_columnImg" style="margin-bottom: 120px">
        <!--        <nuxt-link-locale to="register" class="heroTxtContainer_promoContainer heroTxtContainer_promoContainer&#45;&#45;priceList" style="left: 58%;">-->
        <nuxt-link-locale to="register" class="heroTxtContainer_promoContainer heroTxtContainer_promoContainer--priceList">
          <div class="row">
            <div class="heroTxtContainer_promoContainerHeader">
              <span class="heroTxtContainer_promoContainerTitle">Najlepsza oferta!</span>
            </div>
          </div>

          <div class="row">
            <div class="heroTxtContainer_promoContainerContent">
              <div class="row">
                <span class="heroTxtContainer_promoContainerTxt">Przesyłki niestandardowe</span>
              </div>
              <div class="row row--centered" style="height: 60px; margin-bottom: 6px">
                <NuxtImg src="images/kurierzyV2/AmbroExpress.png" width="80px" height="60px"/>
              </div>
              <div class="row">
                <span class="heroTxtContainer_promoContainerPrice">od 84 zł!</span>
              </div>
              <div class="row row--centered">
                <span class="heroTxtContainer_promoContainerLink">Skorzystaj</span>
                <NuxtImg src="icons/arrowPromoLink.png" width="11px" height="17px" style="margin-left: 6px"/>
              </div>
            </div>
          </div>
        </nuxt-link-locale>
        <NuxtImg src="images/kurierzyCennikiUproszczone/krajowe.svg" width="445px" height="356px"/>
      </div>
    </div>

    <PriceListLpNiestandardowe />

    <PriceListSpecialInfo2 />

    <div class="container cta">
      <div class="row row--centered">
        <h1 class="cta_title">Załóż konto i tanio wysyłaj paczki!
          <br> Rejestracja bez opłat.</h1>
      </div>
      <div class="row row--centered">
        <nuxt-link-locale to="register" class="cta_button">Zarejestruj się</nuxt-link-locale>
      </div>
    </div>
  </div>
</template>
<script setup lang="ts">
const mainPageUrl = window.location.origin + '/';

definePageMeta({
  middleware: 'default-layout',
  layout: 'landing-page'
})
</script>