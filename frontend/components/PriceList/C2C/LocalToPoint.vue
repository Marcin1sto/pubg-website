<template>
  <div class="row">
    <div class="prices_tableContainer" style="transform: rotateX(180deg);">
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
          <th class="prices_th"><NuxtImg src="images/kurierzyV2/UPS.png" width="80px" height="60px"/></th>
          <td class="prices_td">8.99 zł</td>
          <td class="prices_td">8.99 zł</td>
          <td class="prices_td">8.99 zł</td>
          <td class="prices_td" rowspan="6">
            <div class="prices_infoContainer">
              <!--              <span class="prices_infoTxt prices_infoTxt&#45;&#45;bold">Już od:</span>-->
              <!--              <div class="prices_infoContainerColumnWrapper">-->
              <!--                <div class="prices_infoContainerTxtWrapper">-->
              <!--                  <span class="prices_infoTxt prices_infoTxt&#45;&#45;bold">2,49 zł</span>-->
              <!--                  <span class="prices_infoTxt">do 25 kg</span>-->
              <!--                </div>-->

              <!--                <NuxtImg src="images/kurierzyCennikiUproszczone/orlenBig.png" width="101px" height="65px"/>-->
              <!--              </div>-->

              <p class="prices_infoTxt">Ceny i warunki przesyłek powyżej 5 kg dostępne są po zalogowaniu się</p>
              <nuxt-link-locale to="register" class="prices_link">Zarejestruj się</nuxt-link-locale>
            </div>
          </td>
        </tr>

        <tr>
          <th class="prices_th"><NuxtImg src="images/kurierzyCennikiUproszczone/pocztex.png" width="95px" height="25px"/></th>
          <td class="prices_td">9,49 zł</td>
          <td class="prices_td">10,49 zł</td>
          <td class="prices_td">10,49 zł</td>
        </tr>

        <tr>
          <th class="prices_th"><NuxtImg src="images/kurierzyV2/InPost_new.png" width="89px" height="53px"/></th>
          <td class="prices_td">10,49 zł</td>
          <td class="prices_td">10,49 zł</td>
          <td class="prices_td">10,49 zł</td>
        </tr>

        <tr>
          <th class="prices_th"><NuxtImg src="images/kurierzyCennikiUproszczone/dhl.png" width="69px" height="50px"/></th>
          <td class="prices_td">11,99 zł</td>
          <td class="prices_td">12,49 zł</td>
          <td class="prices_td">12,49 zł</td>
        </tr>

        <tr>
          <th class="prices_th"><NuxtImg src="images/kurierzyCennikiUproszczone/fedEx.png" width="65px" height="19px"/></th>
          <td class="prices_td">12,49 zł</td>
          <td class="prices_td">12,49 zł</td>
          <td class="prices_td">12,49 zł</td>
        </tr>

        <tr>
          <th class="prices_th"><NuxtImg src="images/kurierzyV2/GLS.png" width="80px" height="60px"/></th>
          <td class="prices_td">12,49 zł</td>
          <td class="prices_td">12,49 zł</td>
          <td class="prices_td">13,49 zł</td>
        </tr>

        <tr>
          <th class="prices_th"><NuxtImg src="images/kurierzyCennikiUproszczone/dpd.png" width="74px" height="42px"/></th>
          <td class="prices_td">14,49 zł</td>
          <td class="prices_td">14,49 zł</td>
          <td class="prices_td">15,49 zł</td>
        </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>