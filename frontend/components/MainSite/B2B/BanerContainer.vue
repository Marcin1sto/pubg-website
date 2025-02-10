<template>
  <div class="prices_banerContainer">
    <div class="prices_columnTxt">
      <div class="row">
        <h1 class="prices_title">Proste i tanie przesyłki</h1>
      </div>
      <div class="row">
        <ul class="prices_list">
          <li class="prices_listItem">Wszystkie popularne formy przesyłek krajowych i zagranicznych, od <strong>koperty</strong> do palety <strong>1000</strong> kg,
            w tym niestandardowe</li>
          <li class="prices_listItem">Dostęp do <strong>wielu</strong> zaufanych krajowych i zagranicznych <strong>partnerów logistycznych</strong></li>
          <li class="prices_listItem">Możliwość nadawania bezpośrednio, jak i poprzez API oraz w panelu <strong>BaseLinker</strong></li>
          <li class="prices_listItem">Brak <strong>minimum</strong> wysyłkowego, brak <strong>umów</strong> i brak <strong>abonamentu</strong></li>
          <li class="prices_listItem"><strong>Najniższe ceny</strong> już od pierwszej paczki!</li>
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
      <NuxtImg src="images/laptop_final.png" width="601px" height="539px"/>
      <!--        <NuxtImg src="images/50_na_start.png" class="prices_specialPromo prices_specialPromo&#45;&#45;50"/>-->
      <!--        <NuxtImg src="images/50_na_start.png" width="258px" height="246px" class="prices_specialPromo"/>-->
    </div>
  </div>
</template>