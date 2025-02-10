<template>
  <div class="prices_tableContainer" style="transform: rotateX(180deg);">
    <table class="prices_table" style="transform: rotateX(180deg);">
      <thead>
      <tr class="prices_headerRow">
        <th class="prices_th" width="120px">Kurier</th>
        <th class="prices_th" width="230px">Do 100 kg</th>
        <th class="prices_th" width="230px">Do 200 kg</th>
        <th class="prices_th" width="230px">Do 300 kg</th>
        <th class="prices_th">Powyżej 300 kg</th>
      </tr>
      </thead>

      <tbody>
      <tr>
        <th class="prices_th"><NuxtImg src="images/kurierzyV2/Geis.png" width="40px" height="30px"/></th>
        <td class="prices_td">80,00 zł</td>
        <td class="prices_td"></td>
        <td class="prices_td"></td>
        <td class="prices_td" rowspan="6">
          <div class="prices_infoContainer">
            <p class="prices_infoTxt">Ceny przesyłek paletowych powyżej 300 kg dostępne są po zalogowaniu się</p>
            <nuxt-link-locale to="register" class="prices_link" style="display: inline-block; margin-bottom: 24px;">Zarejestruj się</nuxt-link-locale>
          </div>
        </td>
      </tr>

      <tr>
        <th class="prices_th"><NuxtImg src="images/kurierzyCennikiUproszczone/dhl.png" width="69px" height="50px"/></th>
        <td class="prices_td">110,00 zł</td>
        <td class="prices_td">120,00 zł</td>
        <td class="prices_td"></td>
      </tr>

      <tr>
        <th class="prices_th"><NuxtImg src="images/kurierzyV2/geodis3.svg" width="65px" height="60px"/></th>
        <td class="prices_td">115,00 zł</td>
        <td class="prices_td">125,00 zł</td>
        <td class="prices_td">135,00 zł</td>
      </tr>

      <tr>
        <th class="prices_th"><NuxtImg src="images/kurierzyV2/poczta.png" width="60px" height="31px"/></th>
        <td class="prices_td">120,00 zł</td>
        <td class="prices_td">120,00 zł</td>
        <td class="prices_td">130,00 zł</td>
      </tr>

      <tr>
        <th class="prices_th"><NuxtImg src="images/kurierzyV2/Hellmann.png" width="40px" height="30px"/></th>
        <td class="prices_td">125,00 zł</td>
        <td class="prices_td">125,00 zł</td>
        <td class="prices_td"></td>
      </tr>
      </tbody>
    </table>
  </div>
</template>
<script setup lang="ts">
</script>