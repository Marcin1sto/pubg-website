<template>
  <div class="container">
    <div class="prices_banerContainer prices_banerContainer--marginBig">
      <div class="prices_columnTxt">
        <div class="row">
          <h1 class="prices_title">Cennik paletowy</h1>
        </div>
        <div class="row">
          <ul class="prices_list">
            <li class="prices_listItem">Wszystkie popularne <strong>rozmiary</strong> palet</li>
            <li class="prices_listItem"><strong>Duży wybór</strong> sprawdzonych przewoźników</li>
            <li class="prices_listItem"><strong>Dostawa</strong> zarówno w kraju jak i za granicą</li>
          </ul>
        </div>

        <div class="row">
          <nuxt-link-locale to="register" class="heroTxtContainer_button">Nadaj paczkę</nuxt-link-locale>
        </div>

      </div>
      <div class="prices_columnImg">
        <nuxt-link-locale to="register" class="heroTxtContainer_promoContainer heroTxtContainer_promoContainer--priceList">
          <div class="row">
            <div class="heroTxtContainer_promoContainerHeader">
              <span class="heroTxtContainer_promoContainerTitle">Najlepsza oferta!</span>
            </div>
          </div>

          <div class="row">
            <div class="heroTxtContainer_promoContainerContent">
              <div class="row">
                <span class="heroTxtContainer_promoContainerTxt">Palety</span>
              </div>
              <div class="row row--centered" style="height: 60px; margin-bottom: 6px">
                <NuxtImg src="images/kurierzyV2/Geis.png" width="80px" height="60px"/>
              </div>
              <div class="row">
                <span class="heroTxtContainer_promoContainerPrice">od 80 zł!</span>
              </div>
              <div class="row row--centered">
                <span class="heroTxtContainer_promoContainerLink">Skorzystaj</span>
                <NuxtImg src="icons/arrowPromoLink.png" width="11px" height="17px" style="margin-left: 6px"/>
              </div>
            </div>
          </div>
        </nuxt-link-locale>
        <NuxtImg src="images/kurierzyCennikiUproszczone/palety.svg" width="510px" height="400px"/>
      </div>
    </div>

    <div class="row">
      <div style="display: flex; gap: 16px; flex-direction: column; margin: 16px 0">
        <div class="row row--submenu">
          <span @click="pallet120x80 = true; pallet120x100 = false; pallet120x120 = false; pallet80x60 = false; pallet60x40=false;" class="calc_radioLabel calc_radioLabel--horizontal  calc_radioLabel--200" :class="{ 'calc_radioLabel--active': pallet120x80}">
            <span style="text-align: center">EURO Paleta <br/><b>120cm x 80cm</b></span>
          </span>

          <span @click="pallet120x80 = false; pallet120x100 = true; pallet120x120 = false; pallet80x60 = false; pallet60x40=false;" class="calc_radioLabel calc_radioLabel--horizontal  calc_radioLabel--200" :class="{ 'calc_radioLabel--active': pallet120x100}">
            <span style="text-align: center">Paleta przemysłowa <br/><b>120cm x 100cm</b></span>
          </span>

          <span @click="pallet120x80 = false; pallet120x100 = false; pallet120x120 = true; pallet80x60 = false; pallet60x40=false;" class="calc_radioLabel calc_radioLabel--horizontal  calc_radioLabel--200" :class="{ 'calc_radioLabel--active': pallet120x120}">
            <span style="text-align: center">Paleta przemysłowa <br/><b>120cm x 120cm</b></span>
          </span>

          <span @click="pallet120x80 = false; pallet120x100 = false; pallet120x120 = false; pallet80x60 = true; pallet60x40=false;" class="calc_radioLabel calc_radioLabel--horizontal  calc_radioLabel--200" :class="{ 'calc_radioLabel--active': pallet80x60}">
            <span style="text-align: center">Półpaleta <br/><b>80cm x 60cm</b></span>
          </span>

          <span @click="pallet120x80 = false; pallet120x100 = false; pallet120x120 = false; pallet80x60 = false; pallet60x40=true;" class="calc_radioLabel calc_radioLabel--horizontal  calc_radioLabel--200" :class="{ 'calc_radioLabel--active': pallet60x40}">
            <span style="text-align: center">Ćwierćpaleta <br/><b>60cm x 40cm</b></span>
          </span>
        </div>
      </div>
    </div>

    <div class="row" v-show="pallet120x80">
      <PriceListLp120x80 />
    </div>

    <div class="row" v-show="pallet120x100">
      <PriceListLp120x100 />
    </div>

    <div class="row" v-show="pallet120x120">
      <PriceListLp120x120 />
    </div>

    <div class="row" v-show="pallet80x60">
      <PriceListLp80x60 />
    </div>

    <div class="row" v-show="pallet60x40">
      <PriceListLp60x40 />
    </div>

    <PriceListSpecialInfo2 />

    <Cta />
  </div>
</template>
<script setup lang="ts">
const mainPageUrl = window.location.origin + '/';

const pallet120x80 = ref(true);
const pallet120x100 = ref(false);
const pallet120x120 = ref(false);
const pallet80x60 = ref(false);
const pallet60x40 = ref(false);

definePageMeta({
  middleware: 'default-layout',
  layout: 'landing-page'
})
</script>