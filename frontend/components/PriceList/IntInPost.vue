<template>
  <div class="row">
    <div class="prices_tableContainer" style="transform: rotateX(180deg);">
      <table class="prices_table" style="transform: rotateX(180deg);">
        <thead>
        <tr class="prices_headerRow">
          <th class="prices_th" width="120px">Kraj</th>
          <th class="prices_th" width="230px">Gabaryt A</th>
          <th class="prices_th" width="230px">Gabaryt B</th>
          <th class="prices_th" width="230px">Gabaryt C</th>
          <th class="prices_th">Waga powyżej 5 kg</th>
        </tr>
        </thead>

        <tbody>
        <tr>
          <th class="prices_th prices_th--flex">
            <NuxtImg src="icons/selectCountry/countries/Francja.png" width="60px" height="36px"/>
            <span>Francja</span>
          </th>
          <td class="prices_td">29,99 zł</td>
          <td class="prices_td">32,49 zł</td>
          <td class="prices_td">36,49 zł</td>
          <td class="prices_td" rowspan="6">
            <div class="prices_infoContainer">
              <p class="prices_infoTxt">Ceny i warunki przesyłek powyżej 5 kg dostępne są po zalogowaniu się</p>
              <nuxt-link-locale to="register" class="prices_link">Zarejestruj się</nuxt-link-locale>
            </div>
          </td>
        </tr>

        <tr>
          <th class="prices_th prices_th--flex">
            <NuxtImg src="icons/selectCountry/countries/Belgia.png" width="60px" height="36px"/>
            <span>Belgia</span>
          </th>
          <td class="prices_td">29,99 zł</td>
          <td class="prices_td">32,49 zł</td>
          <td class="prices_td">36,49 zł</td>
        </tr>

        <tr>
          <th class="prices_th prices_th--flex">
            <NuxtImg src="icons/selectCountry/countries/Holandia.png" width="60px" height="36px"/>
            <span>Holandia</span>
          </th>
          <td class="prices_td">29,99 zł</td>
          <td class="prices_td">32,49 zł</td>
          <td class="prices_td">36,49 zł</td>
        </tr>

        <tr>
          <th class="prices_th prices_th--flex">
            <NuxtImg src="icons/selectCountry/countries/Włochy.png" width="60px" height="36px"/>
            <span>Włochy</span>
          </th>
          <td class="prices_td">32,49 zł</td>
          <td class="prices_td">35,49 zł</td>
          <td class="prices_td">39,49 zł</td>
        </tr>

        <tr>
          <th class="prices_th prices_th--flex">
            <NuxtImg src="icons/selectCountry/countries/Hiszpania.png" width="60px" height="36px"/>
            <span>Hiszpania</span>
          </th>
          <td class="prices_td">32,49 zł</td>
          <td class="prices_td">35,49 zł</td>
          <td class="prices_td">39,49 zł</td>
        </tr>

        <tr>
          <th class="prices_th prices_th--flex">
            <NuxtImg src="icons/selectCountry/countries/Portugalia.png" width="60px" height="36px"/>
            <span>Portugalia</span>
          </th>
          <td class="prices_td">32,49 zł</td>
          <td class="prices_td">35,49 zł</td>
          <td class="prices_td">39,49 zł</td>
        </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>
<script setup lang="ts">
</script>