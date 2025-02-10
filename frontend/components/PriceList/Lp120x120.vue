<template>
  <div class="prices_tableContainer" style="transform: rotateX(180deg);">
    <table class="prices_table" style="transform: rotateX(180deg);">
      <thead>
      <tr class="prices_headerRow">
        <th class="prices_th" width="120px">Kurier</th>
        <th class="prices_th" width="230px">Do 100 kg</th>
        <th class="prices_th" width="230px">Do 200 kg</th>
        <th class="prices_th" width="230px">Do 400 kg</th>
        <th class="prices_th">Powyżej 400 kg</th>
      </tr>
      </thead>

      <tbody>
      <tr>
        <th class="prices_th"><NuxtImg src="images/kurierzyV2/Geis.png" width="40px" height="30px"/></th>
        <td class="prices_td">170,00 zł</td>
        <td class="prices_td">170,00 zł</td>
        <td class="prices_td">170,00 zł</td>
        <td class="prices_td" rowspan="6">
          <div class="prices_infoContainer">
            <p class="prices_infoTxt">Ceny przesyłek paletowych powyżej 400 kg dostępne są po zalogowaniu się</p>
            <nuxt-link-locale to="register" class="prices_link" style="display: inline-block; margin-bottom: 24px;">Zarejestruj się</nuxt-link-locale>
          </div>
        </td>
      </tr>

      <tr>
        <th class="prices_th"><NuxtImg src="images/kurierzyV2/geodis3.svg" width="65px" height="60px"/></th>
        <td class="prices_td">205,00 zł</td>
        <td class="prices_td">205,00 zł</td>
        <td class="prices_td">225,00 zł</td>
      </tr>

      <tr>
        <th class="prices_th"><NuxtImg src="images/kurierzyV2/poczta.png" width="60px" height="31px"/></th>
        <td class="prices_td">255,00 zł</td>
        <td class="prices_td">255,00 zł</td>
        <td class="prices_td">265,00 zł</td>
      </tr>
      </tbody>
    </table>
  </div>
</template>