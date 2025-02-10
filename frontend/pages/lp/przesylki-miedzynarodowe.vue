<template>
  <div class="container">
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
          <nuxt-link-locale to="register" class="heroTxtContainer_button">Nadaj paczkę</nuxt-link-locale>
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
                <!--                <NuxtImg src="/icons/blpLogoMain.png" width="100px" height="25px"/>-->
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
          <span @click="eurohermes = false; olza = false; packeta = false; spring = false; blPaczkaCB=true;" class="calc_radioLabel calc_radioLabel--horizontal calc_radioLabel--200" :class="{ 'calc_radioLabel--active': blPaczkaCB}">
            <span style="text-align: center"><NuxtImg src="images/kurierzyV2/CLPCB.png" width="80px" height="60px" alt="BLPaczka Cross-Border"/></span>
          </span>

          <span @click="eurohermes = true; olza = false; packeta = false; spring = false; blPaczkaCB=false;" class="calc_radioLabel calc_radioLabel--horizontal calc_radioLabel--200" :class="{ 'calc_radioLabel--active': eurohermes}">
            <span style="text-align: center"><NuxtImg src="images/kurierzyV2/eurohermes.png" width="120px" height="auto" alt="Eurohermes"/></span>
          </span>

          <span @click="eurohermes = false; olza = true; packeta = false; spring = false; blPaczkaCB=false;" class="calc_radioLabel calc_radioLabel--horizontal calc_radioLabel--200" :class="{ 'calc_radioLabel--active': olza}">
            <span style="text-align: center"><NuxtImg src="images/kurierzyV2/olza-logistic.svg" width="89px" height="36px" alt="Olza"/></span>
          </span>

          <span @click="eurohermes = false; olza = false; packeta = true; spring = false; blPaczkaCB=false;" class="calc_radioLabel calc_radioLabel--horizontal calc_radioLabel--200" :class="{ 'calc_radioLabel--active': packeta}">
            <span style="text-align: center"><NuxtImg src="images/kurierzyV2/red-packeta.svg" width="89px" height="auto" alt="Packeta"/></span>
          </span>

          <span @click="eurohermes = false; olza = false; packeta = false; spring = true; blPaczkaCB=false;" class="calc_radioLabel calc_radioLabel--horizontal calc_radioLabel--200" :class="{ 'calc_radioLabel--active': spring}">
            <span style="text-align: center"><NuxtImg src="images/kurierzyV2/spring-logo.svg" width="89px" height="auto" alt="Spring"/></span>
          </span>
        </div>
      </div>
    </div>

    <div class="row" v-show="blPaczkaCB">
      <LazyPriceListIntBLPaczkaCB />
    </div>

    <div class="row" v-show="eurohermes">
      <PriceListIntEurohermes />
    </div>

    <div class="row" v-show="olza">
      <LazyPriceListIntOlza />
    </div>

    <div class="row" v-show="packeta">
      <LazyPriceListIntPacketa />
    </div>

    <div class="row" v-show="spring">
      <LazyPriceListIntSpring />
    </div>

    <PriceListSpecialInfo1 />

    <Cta />
  </div>
</template>
<script setup lang="ts">
const mainPageUrl = window.location.origin + '/';

const eurohermes = ref(false);
const olza = ref(false);
const packeta = ref(false);
const spring = ref(false);
const blPaczkaCB = ref(true);

definePageMeta({
  middleware: 'default-layout',
  layout: 'landing-page'
})
</script>