<template>
  <div class="container">
    <div class="prices_mainNavigation">
      <nuxt-link-locale to="prices" class="calc_radioLabel calc_radioLabel--horizontalSmall calc_radioLabel--active">Krajowe</nuxt-link-locale>
      <nuxt-link-locale to="prices" class="calc_radioLabel calc_radioLabel--horizontalSmall">Międzynarodowe</nuxt-link-locale>
      <nuxt-link-locale to="prices" class="calc_radioLabel calc_radioLabel--horizontalSmall">Paletowe</nuxt-link-locale>
      <nuxt-link-locale to="prices" class="calc_radioLabel calc_radioLabel--horizontalSmall">Niestandardowe</nuxt-link-locale>
    </div>

    <div class="row">
      <h1 class="prices_header">Cennik - przesyłki krajowe</h1>

      <p class="prices_txt">Wyceniaj i wysyłaj paczki krajowe w najniższych cenach!
        Brak minimum wysyłkowego. Bez umów i zobowiązań.
        Wszystkie popularne formy przesyłek. Od koperty do palety 1000 kg.
        Możliwość nadawania paczek także bezpośrednio w panelu BaseLinker!
      </p>
    </div>

    <div class="row">
      <div style="display: flex; gap: 16px; flex-direction: column; margin-bottom: 32px">
        <div class="row row--gap16" style="min-width: 300px">
          <input type="radio" id="radio6" name="typDostawy" class="calc_radioInput"/>
          <label for="radio6" class="calc_radioLabel calc_radioLabel--horizontal calc_radioLabel--active">
            <NuxtImg src="images/paczkomat.png" width="70px" height="50px"/>
            <span style="text-align: center">Dostawa <br/><b>do punktu</b></span>
          </label>

          <input type="radio" id="radio5" name="typDostawy" class="calc_radioInput"/>
          <label for="radio5" class="calc_radioLabel calc_radioLabel--horizontal">
            <NuxtImg src="images/dostawczak.png" width="70px" height="50px"/>
            <span style="text-align: center">Dostawa <br/><b>do drzwi</b></span>
          </label>
        </div>
      </div>
    </div>

    <div class="row">
      <table class="prices_table" style="transform: rotateX(180deg);">
        <thead>
          <tr class="prices_headerRow">
            <th class="prices_th" width="120px">Kurier</th>
            <th class="prices_th" width="230px">Do 1 kg lub gabaryt A/S</th>
            <th class="prices_th" width="230px">Do 2 kg lub gabaryt B/M</th>
            <th class="prices_th" width="230px">Do 5 kg lub gabaryt C/L</th>
            <th class="prices_th">Powyżej 5 kg</th>
          </tr>
        </thead>

        <tbody>
          <tr>
            <th class="prices_th"><NuxtImg src="images/kurierzyCennikiUproszczone/orlen.png"/></th>
            <td class="prices_td">2,49 zł</td>
            <td class="prices_td">2,49 zł</td>
            <td class="prices_td">2,49 zł</td>
            <td class="prices_td" rowspan="6">
              <div class="prices_infoContainer">
                <span class="prices_infoTxt prices_infoTxt--bold">Już od:</span>
                <div class="prices_infoContainerColumnWrapper">
                  <div class="prices_infoContainerTxtWrapper">
                    <span class="prices_infoTxt prices_infoTxt--bold">2,49 zł</span>
                    <span class="prices_infoTxt">do 25 kg</span>
                  </div>

                  <NuxtImg src="images/kurierzyCennikiUproszczone/orlenBig.png"/>
                </div>

                <p class="prices_infoTxt">Ceny i warunki dostaw przesyłek gabarytowych (od 5 kg do 1 000 kg) ustalane są indywidualnie</p>
                <a href="" class="prices_link">Skontaktuj się z nami</a>
              </div>
            </td>
          </tr>

          <tr>
            <th class="prices_th"><NuxtImg src="images/kurierzyCennikiUproszczone/dhl.png"/></th>
            <td class="prices_td">8,49 zł</td>
            <td class="prices_td">8,49 zł</td>
            <td class="prices_td">8,49 zł</td>
          </tr>

          <tr>
            <th class="prices_th"><NuxtImg src="images/kurierzyCennikiUproszczone/inPost.png"/></th>
            <td class="prices_td">10,49 zł</td>
            <td class="prices_td">10,49 zł</td>
            <td class="prices_td">10,49 zł</td>
          </tr>

          <tr>
            <th class="prices_th"><NuxtImg src="images/kurierzyCennikiUproszczone/dpd.png"/></th>
            <td class="prices_td">2,49 zł</td>
            <td class="prices_td">2,49 zł</td>
            <td class="prices_td">2,49 zł</td>
          </tr>

          <tr>
            <th class="prices_th"><NuxtImg src="images/kurierzyCennikiUproszczone/fedEx.png"/></th>
            <td class="prices_td">8,49 zł</td>
            <td class="prices_td">8,49 zł</td>
            <td class="prices_td">8,49 zł</td>
          </tr>

          <tr>
            <th class="prices_th"><NuxtImg src="images/kurierzyCennikiUproszczone/pocztex.png"/></th>
            <td class="prices_td">10,49 zł</td>
            <td class="prices_td">10,49 zł</td>
            <td class="prices_td">10,49 zł</td>
          </tr>
        </tbody>
      </table>
    </div>

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
definePageMeta({
  middleware: 'default-layout',
})
</script>