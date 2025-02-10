<template>
  <div class="container">
    <h2 class="header3 przesylkiTitle">Co zyskujesz korzystając z BLPaczki?</h2>
    <div class="profitCard_row">
      <div class="profitCard">
        <NuxtImg src="images/profit/profit1.png" class="profitCard_img" />
        <h3 class="profitCard_title">Szybkie nadawanie przesyłek</h3>
        <p class="profitCard_txt">Nadaj paczkę standardową lub wielkogabarytową (meble, opony, AGD) bez wychodzenia z domu. Śledź przesyłkę online i wybierz najlepszą opcję dostawy.</p>
        <!--        <a href="#" class="profitCard_link">Zobacz wszystkie <NuxtImg src="icons/linkArrow.png" class="profitCard_linkImg"/></a>-->
      </div>

      <div class="profitCard">
        <NuxtImg src="images/profit/partnerzy2.svg" class="profitCard_img" />
        <h3 class="profitCard_title">Tanie przesyłki krajowe bez ukrytych opłat</h3>
        <p class="profitCard_txt">Wysyłaj małe i duże paczki w korzystnych cenach. Współpracujemy z najlepszymi firmami kurierskimi, oferując przejrzyste ceny i brak abonamentu.</p>
        <!--        <a href="#" class="profitCard_link">Zobacz wszystkie <NuxtImg src="icons/linkArrow.png" class="profitCard_linkImg"/></a>-->
      </div>

      <div class="profitCard">
        <NuxtImg src="images/profit/profit3.png" class="profitCard_img" />
        <h3 class="profitCard_title">Wiele firm kurierskich w jednym miejscu</h3>
        <p class="profitCard_txt">Korzystaj z oferty sprawdzonych przewoźników, takich jak InPost, Orlen Paczka, DHL, DPD i wielu innych. Wybierz najkorzystniejszą opcję dla swojej paczki – od małych przesyłek po duże gabaryty.</p>
        <!--        <a href="#" class="profitCard_link">Zobacz wszystkie <NuxtImg src="icons/linkArrow.png" class="profitCard_linkImg"/></a>-->
      </div>

      <div class="profitCard">
        <NuxtImg src="images/profit/profit4.png" class="profitCard_img" />
        <h3 class="profitCard_title">Wysyłka za pobraniem – zapłać przy odbiorze</h3>
        <p class="profitCard_txt">Nie musisz płacić z góry – nadawaj paczki z opcją pobrania i wygodnie ureguluj należność przy dostawie.</p>
        <!--        <a href="#" class="profitCard_link">Zobacz wszystkie <NuxtImg src="icons/linkArrow.png" class="profitCard_linkImg"/></a>-->
      </div>

      <nuxt-link-locale to="register" class="profitCard_button profitCard_button--large">Załóż bezpłatne konto</nuxt-link-locale>
    </div>
  </div>
</template>