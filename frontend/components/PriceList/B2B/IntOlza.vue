<template>
  <div class="row">
    <div class="prices_tableContainer" style="transform: rotateX(180deg);">
      <table class="prices_table" style="transform: rotateX(180deg);">
        <thead>
        <tr class="prices_headerRow">
          <th class="prices_th" width="120px">Kraj</th>
          <th class="prices_th" width="230px">Waga do 1 kg</th>
          <th class="prices_th" width="230px">Waga do 3 kg</th>
          <th class="prices_th" width="230px">Waga do 5 kg</th>
          <th class="prices_th">Waga powyżej 5 kg</th>
        </tr>
        </thead>

        <tbody>
        <tr>
          <th class="prices_th prices_th--flex">
            <NuxtImg src="icons/selectCountry/countries/Węgry.png" width="60px" height="36px"/>
            <span>Węgry</span>
          </th>
          <td class="prices_td">17,49 zł <br> <span>(21,51 zł brutto)</span></td>
          <td class="prices_td">20,99 zł <br> <span>(25,82 zł brutto)</span></td>
          <td class="prices_td">22,49 zł <br> <span>(27,66 zł brutto)</span></td>
          <td class="prices_td" rowspan="6">
            <div class="prices_infoContainer">
              <p class="prices_infoTxt">Ceny i warunki przesyłek powyżej 5 kg dostępne są po zalogowaniu się</p>
              <nuxt-link-locale to="register" class="prices_link">Zarejestruj się</nuxt-link-locale>
            </div>
          </td>
        </tr>

        <tr>
          <th class="prices_th prices_th--flex">
            <NuxtImg src="icons/selectCountry/countries/Czechy.png" width="60px" height="36px"/>
            <span>Czechy</span>
          </th>
          <td class="prices_td">18,49 zł <br> <span>(22,74 zł brutto)</span></td>
          <td class="prices_td">18,49 zł <br> <span>(22,74 zł brutto)</span></td>
          <td class="prices_td">18,99 zł <br> <span>(22,74 zł brutto)</span></td>
        </tr>

        <tr>
          <th class="prices_th prices_th--flex">
            <NuxtImg src="icons/selectCountry/countries/Rumunia (2).png" width="60px" height="36px"/>
            <span>Rumunia</span>
          </th>
          <td class="prices_td">19,49 zł <br> <span>(23,97 zł brutto)</span></td>
          <td class="prices_td">22,99 zł <br> <span>(28,28 zł brutto)</span></td>
          <td class="prices_td">23,99 zł <br> <span>(29,51 zł brutto)</span></td>
        </tr>

        <tr>
          <th class="prices_th prices_th--flex">
            <NuxtImg src="icons/selectCountry/countries/Słowacja.png" width="60px" height="36px"/>
            <span>Słowacja</span>
          </th>
          <td class="prices_td">19,99 zł <br> <span>(24,59 zł brutto)</span></td>
          <td class="prices_td">22,49 zł <br> <span>(27,66 zł brutto)</span></td>
          <td class="prices_td">23,49 zł <br> <span>(28,89 zł brutto)</span></td>
        </tr>

        <tr>
          <th class="prices_th prices_th--flex">
            <NuxtImg src="icons/selectCountry/countries/Włochy.png" width="60px" height="36px"/>
            <span>Włochy</span>
          </th>
          <td class="prices_td">35,99 zł <br> <span>(44,27 zł brutto)</span></td>
          <td class="prices_td">39,49 zł <br> <span>(48,57 zł brutto)</span></td>
          <td class="prices_td">59,99 zł <br> <span>(73,99 zł brutto)</span></td>
        </tr>

        <tr>
          <th class="prices_th prices_th--flex">
            <NuxtImg src="icons/selectCountry/countries/Szwecja.png" width="60px" height="36px"/>
            <span>Szwecja</span>
          </th>
          <td class="prices_td">49,49 zł <br> <span>(60,87 zł brutto)</span></td>
          <td class="prices_td">50,49 zł <br> <span>(62,10 zł brutto)</span></td>
          <td class="prices_td">69,49 zł <br> <span>(85,47 zł brutto)</span></td>
        </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>
<script setup lang="ts">
</script>