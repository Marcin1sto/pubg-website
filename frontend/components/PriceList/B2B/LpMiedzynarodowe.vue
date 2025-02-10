<template>
  <div class="row">
    <div class="prices_tableContainer" style="transform: rotateX(180deg);">
      <table class="prices_table" style="transform: rotateX(180deg);">
        <thead>
        <tr class="prices_headerRow">
          <th class="prices_th" width="120px">Kurier</th>
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
          <td class="prices_td">10,98 zł</td>
          <td class="prices_td">16,48 zł</td>
          <td class="prices_td">20,48 zł</td>
          <td class="prices_td" rowspan="6">
            <div class="prices_infoContainer">
              <p class="prices_infoTxt">Ceny i warunki przesyłek powyżej 5 kg dostępne są po zalogowaniu się</p>
              <nuxt-link-locale to="register" class="prices_link">Zarejestruj się</nuxt-link-locale>
            </div>
          </td>
        </tr>

        <tr>
          <th class="prices_th prices_th--flex">
            <NuxtImg src="icons/selectCountry/countries/Rumunia (2).png" width="60px" height="36px"/>
            <span>Rumunia</span>
          </th>
          <td class="prices_td">13,48 zł</td>
          <td class="prices_td">13,48 zł</td>
          <td class="prices_td">18,48 zł</td>
        </tr>

        <tr>
          <th class="prices_th prices_th--flex">
            <NuxtImg src="icons/selectCountry/countries/Czechy.png" width="60px" height="36px"/>
            <span>Czechy</span>
          </th>
          <td class="prices_td">16,48 zł</td>
          <td class="prices_td">16,48 zł</td>
          <td class="prices_td">18,48 zł</td>
        </tr>

        <tr>
          <th class="prices_th prices_th--flex">
            <NuxtImg src="icons/selectCountry/countries/Włochy.png" width="60px" height="36px"/>
            <span>Włochy</span>
          </th>
          <td class="prices_td">19,48 zł</td>
          <td class="prices_td">19,48 zł</td>
          <td class="prices_td">29,48 zł</td>
        </tr>

        <tr>
          <th class="prices_th prices_th--flex">
            <NuxtImg src="icons/selectCountry/countries/Austria.png" width="60px" height="36px"/>
            <span>Austria</span>
          </th>
          <td class="prices_td">27,48 zł</td>
          <td class="prices_td">30,48 zł</td>
          <td class="prices_td">33,48 zł</td>
        </tr>

        <tr>
          <th class="prices_th prices_th--flex">
            <NuxtImg src="icons/selectCountry/countries/Francja.png" width="60px" height="36px"/>
            <span>Francja</span>
          </th>
          <td class="prices_td">29,48 zł</td>
          <td class="prices_td">34,48 zł</td>
          <td class="prices_td">44,48 zł</td>
        </tr>
        </tbody>
      </table>
    </div>
  </div>

  <div class="row">
    <div class="prices_specialInfoContainer">
      <span class="prices_specialInfoTxt">Powyższe ceny obowiązują w ramach "Promocji Świątecznej" trwającej od 1.11 do 31.12.2024 (ceny zawierają wliczoną opłatę sezonową 0,99 zł netto).</span>
    </div>
  </div>
</template>
<script setup lang="ts">
</script>