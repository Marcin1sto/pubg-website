<template>
  <div class="container">
    <div class="prices_mainNavigation">
      <nuxt-link to="krajowe" class="calc_radioLabel calc_radioLabel--horizontalSmall"><NuxtImg src="icons/paczkaKalkulator.png" width="27px" height="26px"/>Krajowe</nuxt-link>
      <nuxt-link to="miedzynarodowe" class="calc_radioLabel calc_radioLabel--horizontalSmall calc_radioLabel--active"><NuxtImg src="icons/paczkaKalkulator.png" width="27px" height="26px"/>Międzynarodowe</nuxt-link>
      <nuxt-link to="paletowe" class="calc_radioLabel calc_radioLabel--horizontalSmall"><NuxtImg src="icons/paletaKalkulator.png" width="42px" height="23px"/>Paletowe</nuxt-link>
      <nuxt-link to="niestandardowe" class="calc_radioLabel calc_radioLabel--horizontalSmall"><NuxtImg src="icons/niestandardKalkulator.png" width="26px" height="26px"/>Niestandardowe</nuxt-link>
    </div>

    <div class="prices_banerContainer">
      <div class="prices_columnTxt">
        <div class="row">
          <h1 class="prices_title">Cennik międzynarodowy</h1>
        </div>
        <div class="row">
          <ul class="prices_list">
            <li class="prices_listItem">Wysyłka paczek do <strong>kilkudziesięciu krajów</strong></li>
            <li class="prices_listItem">Dostawa <strong>nawet w 48 godzin</strong>!</li>
            <li class="prices_listItem">Wsparcie we współpracy z <strong>zagranicznymi marketplace’ami</strong></li>
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
                <span class="heroTxtContainer_promoContainerTxt">Przesyłka do Niemiec</span>
              </div>
              <div class="row row--centered" style="height: 60px; margin-bottom: 6px">
                <IconLogoMini class="logo" height="60px"/>
              </div>
              <div class="row">
                <span class="heroTxtContainer_promoContainerPrice">od 19,49 zł!</span>
              </div>
              <div class="row row--centered">
                <span class="heroTxtContainer_promoContainerLink">Skorzystaj</span>
                <NuxtImg src="icons/arrowPromoLink.png" width="11px" height="17px" style="margin-left: 6px"/>
              </div>
            </div>
          </div>
        </nuxt-link-locale>
        <NuxtImg src="images/kurierzyCennikiUproszczone/miedzynarodowe.svg" width="494px" height="352px"/>
      </div>
    </div>

    <div class="row">
      <div style="display: flex; gap: 16px; flex-direction: column; margin: 16px 0">
        <div class="row row--submenu">
          <span @click="eurohermes = false; olza = false; packeta = false; spring = false; inPostInternational=true;" class="calc_radioLabel calc_radioLabel--horizontal calc_radioLabel--200" :class="{ 'calc_radioLabel--active': inPostInternational}">
            <span style="text-align: center"><NuxtImg src="images/kurierzyV2/InPost-International-logo.svg" width="120px" alt="InPost International"/></span>
          </span>

          <span @click="eurohermes = true; olza = false; packeta = false; spring = false; inPostInternational=false;" class="calc_radioLabel calc_radioLabel--horizontal calc_radioLabel--200" :class="{ 'calc_radioLabel--active': eurohermes}">
            <span style="text-align: center"><NuxtImg src="images/kurierzyV2/eurohermes.png" width="120px" height="auto" alt="Eurohermes"/></span>
          </span>

          <span @click="eurohermes = false; olza = true; packeta = false; spring = false; inPostInternational=false;" class="calc_radioLabel calc_radioLabel--horizontal calc_radioLabel--200" :class="{ 'calc_radioLabel--active': olza}">
            <span style="text-align: center"><NuxtImg src="images/kurierzyV2/olza-logistic.svg" width="89px" height="36px" alt="Olza"/></span>
          </span>

          <span @click="eurohermes = false; olza = false; packeta = true; spring = false; inPostInternational=false;" class="calc_radioLabel calc_radioLabel--horizontal calc_radioLabel--200" :class="{ 'calc_radioLabel--active': packeta}">
            <span style="text-align: center"><NuxtImg src="images/kurierzyV2/red-packeta.svg" width="89px" height="auto" alt="Packeta"/></span>
          </span>

          <span @click="eurohermes = false; olza = false; packeta = false; spring = true; inPostInternational=false;" class="calc_radioLabel calc_radioLabel--horizontal calc_radioLabel--200" :class="{ 'calc_radioLabel--active': spring}">
            <span style="text-align: center"><NuxtImg src="images/kurierzyV2/spring-logo.svg" width="89px" height="auto" alt="Spring"/></span>
          </span>
        </div>
      </div>
    </div>

    <div class="row">
      <LazyPriceListB2BIntInPostInternational  v-show="inPostInternational && !isC2C"/>
      <LazyPriceListC2CIntInPostInternational  v-show="inPostInternational && isC2C"/>

      <LazyPriceListB2BIntEurohermes  v-show="eurohermes && !isC2C" />
      <LazyPriceListC2CIntEurohermes  v-show="eurohermes && isC2C" />

      <LazyPriceListB2BIntOlza  v-show="olza && !isC2C" />
      <LazyPriceListC2CIntOlza  v-show="olza && isC2C" />

      <LazyPriceListB2BIntPacketa  v-show="packeta && !isC2C" />
      <LazyPriceListC2CIntPacketa  v-show="packeta && isC2C" />

      <LazyPriceListB2BIntSpring  v-show="spring && !isC2C" />
      <LazyPriceListC2CIntSpring  v-show="spring && isC2C" />
    </div>

    <PriceListB2BSpecialInfo1 v-if="!isC2C"/>
    <PriceListC2CSpecialInfo1 v-if="isC2C"/>

    <Cta />
  </div>
</template>
<script setup lang="ts">
import useC2CStore from "~/stores/useC2CStore";

const mainPageUrl = window.location.origin + '/';

const eurohermes = ref(false);
const olza = ref(false);
const packeta = ref(false);
const spring = ref(false);
const inPostInternational = ref(true);

const { isC2C } = storeToRefs(useC2CStore());

definePageMeta({
  middleware: 'default-layout',
})
</script>