<template>
  <div class="prices_banerContainer">
    <div class="prices_columnTxt">
      <div class="row">
        <h1 class="prices_title">Tania i szybka wysyłka paczek w Polsce – porównaj oferty!</h1>
      </div>
      <div class="row">
        <ul class="prices_list">
          <li class="prices_listItem">Wysyłka paczek krajowych od 7,37 zł – najlepsze ceny na rynku</li>
          <li class="prices_listItem">Porównaj kurierów i zaoszczędź – jeden panel, wiele opcji dostawy</li>
          <li class="prices_listItem">Paczki standardowe i niestandardowe – łatwa i bezpieczna wysyłka</li>
          <li class="prices_listItem">Nadaj przesyłkę w minutę – prosta obsługa i szybka realizacja</li>
          <li class="prices_listItem">Śledzenie przesyłek i pewna dostawa – bądź na bieżąco!</li>
        </ul>
      </div>

      <div class="row">
        <a href="#kalkulatorWyceny" class="heroTxtContainer_button">Nadaj paczkę</a>
      </div>
    </div>

    <div class="prices_columnImg">
      <nuxt-link-locale to="register" class="heroTxtContainer_promoContainer">
        <div class="row">
          <div class="heroTxtContainer_promoContainerHeader">
            <span class="heroTxtContainer_promoContainerTitle">Najlepsza oferta!</span>
          </div>
        </div>

        <div class="row">
          <div class="heroTxtContainer_promoContainerContent">
            <div class="row">
              <span class="heroTxtContainer_promoContainerTxt">Paczkomat<sup>&reg;</sup></span>
            </div>
            <div class="row row--centered">
              <NuxtImg src="images/kurierzyV2/Inpost.png" width="80px" height="60px"/>
            </div>
            <div class="row">
              <span class="heroTxtContainer_promoContainerPrice">od 9,99 zł!</span>
            </div>
            <div class="row row--centered">
              <span class="heroTxtContainer_promoContainerLink">Skorzystaj</span>
              <NuxtImg src="icons/arrowPromoLink.png" width="11px" height="17px" style="margin-left: 6px"/>
            </div>
          </div>
        </div>
      </nuxt-link-locale>
      <NuxtImg src="images/hero_c2c.png" width="601px" height="539px"/>
      <!--        <NuxtImg src="images/50_na_start.png" class="prices_specialPromo prices_specialPromo&#45;&#45;50"/>-->
      <!--        <NuxtImg src="images/50_na_start.png" width="258px" height="246px" class="prices_specialPromo"/>-->
    </div>
  </div>
</template>