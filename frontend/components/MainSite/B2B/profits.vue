<template>
  <div class="container">
    <h2 class="header3 przesylkiTitle">Co zyskujesz korzystając z BLPaczki?</h2>
    <div class="profitCard_row">
      <div class="profitCard">
        <NuxtImg src="images/profit/obslugav2.svg" class="profitCard_img" />
        <h3 class="profitCard_title">Wygodna obsługa i nadawanie paczek</h3>
        <p class="profitCard_txt">Proste i szybkie nadawanie przesyłek bezpośrednio z naszego panelu, możliwość łatwej integracji z BaseLinkerem, a już niebawem dodatkowe połączenia z platformami e-commerce.</p>
      </div>

      <div class="profitCard">
        <NuxtImg src="images/profit/profit1.png" class="profitCard_img" />
        <h3 class="profitCard_title">Przejrzyste, atrakcyjne ceny</h3>
        <p class="profitCard_txt">Jako część grupy BaseLinker skutecznie negocjujemy najlepsze stawki z firmami kurierskimi.
          Nasze ceny zawierają już wliczone opłaty paliwowe i drogowe.</p>
        <!--        <a href="#" class="profitCard_link">Zobacz wszystkie <NuxtImg src="icons/linkArrow.png" class="profitCard_linkImg"/></a>-->
      </div>

      <div class="profitCard">
        <NuxtImg src="images/profit/partnerzy2.svg" class="profitCard_img" />
        <h3 class="profitCard_title">Sprawdzeni partnerzy logistyczni</h3>
        <p class="profitCard_txt">Wszyscy kluczowi przewoźnicy w jednym miejscu. Korzystaj z oferty wielu firm kurierskich dostępnych w naszym systemie.</p>
        <!--        <a href="#" class="profitCard_link">Zobacz wszystkie <NuxtImg src="icons/linkArrow.png" class="profitCard_linkImg"/></a>-->
      </div>

      <div class="profitCard">
        <NuxtImg src="images/profit/profit3.png" class="profitCard_img" />
        <h3 class="profitCard_title">Wsparcie, gdy go potrzebujesz</h3>
        <p class="profitCard_txt">Tysiące naszych Klientów nadało już miliony przesyłek. Wiemy jak wspierać Cię w całym procesie logistycznym tak, abyś mógł skupić się na rozwijaniu swojego biznesu.</p>
        <!--        <a href="#" class="profitCard_link">Zobacz wszystkie <NuxtImg src="icons/linkArrow.png" class="profitCard_linkImg"/></a>-->
      </div>

      <div class="profitCard">
        <NuxtImg src="images/profit/profit4.png" class="profitCard_img" />
        <h3 class="profitCard_title">Bez umów i zobowiązań</h3>
        <p class="profitCard_txt">Nie wymagamy umów, deklaracji ilości zamówień czy innych zaświadczeń. Do korzystania z naszej oferty wystarczy darmowa i błyskawiczna rejestracja</p>
        <!--        <a href="#" class="profitCard_link">Zobacz wszystkie <NuxtImg src="icons/linkArrow.png" class="profitCard_linkImg"/></a>-->
      </div>

      <nuxt-link-locale to="register" class="profitCard_button">Załóż bezpłatne konto</nuxt-link-locale>
    </div>
  </div>
</template>