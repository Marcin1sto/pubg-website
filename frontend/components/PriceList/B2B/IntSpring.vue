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
            <NuxtImg src="icons/selectCountry/countries/Hiszpania.png" width="60px" height="36px"/>
            <span>Hiszpania</span>
          </th>
          <td class="prices_td">26,99 zł <br> <span>(32,58 zł brutto)</span></td>
          <td class="prices_td">39,99 zł <br> <span>(49,19 zł brutto)</span></td>
          <td class="prices_td">52,99 zł <br> <span>(65,18 zł brutto)</span></td>
          <td class="prices_td" rowspan="6">
            <div class="prices_infoContainer">
              <p class="prices_infoTxt">Ceny i warunki przesyłek powyżej 5 kg dostępne są po zalogowaniu się</p>
              <nuxt-link-locale to="register" class="prices_link">Zarejestruj się</nuxt-link-locale>
            </div>
          </td>
        </tr>

        <tr>
          <th class="prices_th prices_th--flex">
            <NuxtImg src="icons/selectCountry/countries/Austria.png" width="60px" height="36px"/>
            <span>Austria</span>
          </th>
          <td class="prices_td">26,99 zł <br> <span>(33,20 zł brutto)</span></td>
          <td class="prices_td">29,99 zł <br> <span>(36,89 zł brutto)</span></td>
          <td class="prices_td">38,99 zł <br> <span>(47,34 zł brutto)</span></td>
        </tr>

        <tr>
          <th class="prices_th prices_th--flex">
            <NuxtImg src="icons/selectCountry/countries/Portugalia.png" width="60px" height="36px"/>
            <span>Portugalia</span>
          </th>
          <td class="prices_td">28,49 zł <br> <span>(35,04 zł brutto)</span></td>
          <td class="prices_td">43,99 zł <br> <span>(54,11 zł brutto)</span></td>
          <td class="prices_td">58,49 zł <br> <span>(71,94 zł brutto)</span></td>
        </tr>

        <tr>
          <th class="prices_th prices_th--flex">
            <NuxtImg src="icons/selectCountry/countries/Holandia.png" width="60px" height="36px"/>
            <span>Holandia</span>
          </th>
          <td class="prices_td">30,99 zł <br> <span>(38,12 zł brutto)</span></td>
          <td class="prices_td">37,49 zł <br> <span>(46,11 zł brutto)</span></td>
          <td class="prices_td">43,49 zł <br> <span>(53,49 zł brutto)</span></td>
        </tr>

        <tr>
          <th class="prices_th prices_th--flex">
            <NuxtImg src="icons/selectCountry/countries/Włochy.png" width="60px" height="36px"/>
            <span>Włochy</span>
          </th>
          <td class="prices_td">31,99 zł <br> <span>(39,35 zł brutto)</span></td>
          <td class="prices_td">37,49 zł <br> <span>(46,11 zł brutto)</span></td>
          <td class="prices_td">48,49 zł <br> <span>(59,64 zł brutto)</span></td>
        </tr>

        <tr>
          <th class="prices_th prices_th--flex">
            <NuxtImg src="icons/selectCountry/countries/Francja.png" width="60px" height="36px"/>
            <span>Francja</span>
          </th>
          <td class="prices_td">36,99 zł <br> <span>(45,50 zł brutto)</span></td>
          <td class="prices_td">50,49 zł <br> <span>(62,10 zł brutto)</span></td>
          <td class="prices_td">68,49 zł <br> <span>(84,24 zł brutto)</span></td>
        </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>
<script setup lang="ts">
</script>