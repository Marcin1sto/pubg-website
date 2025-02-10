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
            <NuxtImg src="icons/selectCountry/countries/Germany.png" width="60px" height="36px"/>
            <span>Niemcy</span>
          </th>
          <td class="prices_td">20,49 zł</td>
          <td class="prices_td">20,49 zł</td>
          <td class="prices_td">21,49 zł</td>
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
          <td class="prices_td">29,49 zł</td>
          <td class="prices_td">32,49 zł</td>
          <td class="prices_td">35,49 zł</td>
        </tr>

        <tr>
          <th class="prices_th prices_th--flex">
            <NuxtImg src="icons/selectCountry/countries/Francja.png" width="60px" height="36px"/>
            <span>Francja</span>
          </th>
          <td class="prices_td">33,49 zł</td>
          <td class="prices_td">37,49 zł</td>
          <td class="prices_td">48,49 zł</td>
        </tr>

        <tr>
          <th class="prices_th prices_th--flex">
            <NuxtImg src="icons/selectCountry/countries/Belgia.png" width="60px" height="36px"/>
            <span>Belgia</span>
          </th>
          <td class="prices_td">35,49 zł</td>
          <td class="prices_td">35,49 zł</td>
          <td class="prices_td">35,49 zł</td>
        </tr>

        <tr>
          <th class="prices_th prices_th--flex">
            <NuxtImg src="icons/selectCountry/countries/Holandia.png" width="60px" height="36px"/>
            <span>Holandia</span>
          </th>
          <td class="prices_td">34,49 zł</td>
          <td class="prices_td">34,49 zł</td>
          <td class="prices_td">40,49 zł</td>
        </tr>

        <tr>
          <th class="prices_th prices_th--flex">
            <NuxtImg src="icons/selectCountry/countries/Luksemburg.png" width="60px" height="36px"/>
            <span>Luksemburg</span>
          </th>
          <td class="prices_td">49,49 zł</td>
          <td class="prices_td">49,49 zł</td>
          <td class="prices_td">49,49 zł</td>
        </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>
<script setup lang="ts">
</script>