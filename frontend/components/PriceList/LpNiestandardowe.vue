<template>
  <div class="row">
    <div class="prices_tableContainer" style="transform: rotateX(180deg);">
      <table class="prices_table" style="transform: rotateX(180deg);">
        <thead>
        <tr class="prices_headerRow">
          <th class="prices_th" width="120px">Kurier</th>
          <th class="prices_th" width="230px">Do 25 kg <br> (do 0,5 m<sup>3</sup>)</th>
          <th class="prices_th" width="230px">Do 40 kg <br> (do 0,8 m<sup>3</sup>)</th>
          <th class="prices_th" width="230px">Do 50 kg <br> (do 1 m<sup>3</sup>)</th>
          <th class="prices_th" width="230px">Do 65 kg <br> (do 1,3 m<sup>3</sup>)</th>
          <th class="prices_th" width="230px">Do 75 kg <br> (do 1,5 m<sup>3</sup>)</th>
          <th class="prices_th">Powyżej 75 kg <br> (od 1,5 m<sup>3</sup>)</th>
        </tr>
        </thead>

        <tbody>
        <tr>
          <th class="prices_th"><NuxtImg src="images/kurierzyV2/AmbroExpress.png" width="80px" height="60px"/></th>
          <td class="prices_td">84,00 zł</td>
          <td class="prices_td">104,00 zł</td>
          <td class="prices_td">124,00 zł</td>
          <td class="prices_td">134,00 zł</td>
          <td class="prices_td">154,00 zł</td>
          <td class="prices_td" rowspan="6">
            <div class="prices_infoContainer">
              <p class="prices_infoTxt" style="margin-top: 24px;">Ceny przesyłek niestandardowych powyżej 75 kg lub 1,5 m<sup>3</sup> dostępne są po zalogowaniu się</p>
              <nuxt-link-locale to="register" class="prices_link" style="display: inline-block; margin-bottom: 24px;">Zarejestruj się</nuxt-link-locale>
            </div>
          </td>
        </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>