<template>
  <div class="container">
    <div class="prices_mainNavigation">
      <nuxt-link to="krajowe" class="calc_radioLabel calc_radioLabel--horizontalSmall"><NuxtImg src="icons/paczkaKalkulator.png" width="27px" height="26px"/>Krajowe</nuxt-link>
      <nuxt-link to="miedzynarodowe" class="calc_radioLabel calc_radioLabel--horizontalSmall" v-if="!isC2C"><NuxtImg src="icons/paczkaKalkulator.png" width="27px" height="26px"/>Międzynarodowe</nuxt-link>
      <nuxt-link to="paletowe" class="calc_radioLabel calc_radioLabel--horizontalSmall" v-if="!isC2C"><NuxtImg src="icons/paletaKalkulator.png" width="42px" height="23px"/>Paletowe</nuxt-link>
      <nuxt-link to="niestandardowe" class="calc_radioLabel calc_radioLabel--horizontalSmall calc_radioLabel--active"><NuxtImg src="icons/niestandardKalkulator.png" width="26px" height="26px"/>Niestandardowe</nuxt-link>
    </div>

    <div class="prices_banerContainer">
      <div class="prices_columnTxt">
        <div class="row">
          <h1 class="prices_title">Cennik niestandardowy</h1>
        </div>
        <div class="row">
          <ul class="prices_list">
            <li class="prices_listItem">Przesyłki o <strong>nietypowych kształtach</strong> bez konieczności pakowania w kartony o regularnych bokach</li>
            <li class="prices_listItem"><strong>Usługi dodatkowe</strong>, takie jak wniesienie czy rozpakowanie przesyłki</li>
            <li class="prices_listItem"><strong>Idealne rozwiązanie</strong> dla transportu mebli, dekoracji wnętrz, sprzętu sportowego i części samochodowych</li>
          </ul>
        </div>

        <div class="row">
          <a :href="mainPageUrl + '#kalkulatorWyceny'" class="heroTxtContainer_button">Nadaj paczkę</a>
        </div>
      </div>
      <div class="prices_columnImg" style="margin-bottom: 120px">
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

    <PriceListB2BLpNiestandardowe v-if="!isC2C"/>
    <PriceListC2CLpNiestandardowe v-if="isC2C"/>

    <PriceListB2BSpecialInfo2 v-if="!isC2C"/>
    <PriceListC2CSpecialInfo2 v-if="isC2C"/>

    <Cta />
  </div>
</template>
<script setup lang="ts">
  import useC2CStore from "~/stores/useC2CStore";

  const mainPageUrl = window.location.origin + '/';

  const { isC2C } = storeToRefs(useC2CStore());

  definePageMeta({
    middleware: 'default-layout',
  })
</script>