<script setup lang="ts">
import usePageStore from "~/stores/usePageStore";
import {ref} from "vue";

const { t } = useI18n();
const { setPageValues } = usePageStore();

const nuxt = useNuxtApp();

const couriers = [
  {
    name: 'Allegro Smart',
    isLink: true,
    isPromo: false,
    imageLink: '/images/kurierzyV2/Allegro.png',
    link: nuxt.$localePath('/couriers/AllegroSmart.pdf')
  },
  {
    name: 'Ambro Express',
    isLink: true,
    isPromo: false,
    imageLink: '/images/kurierzyV2/AmbroExpress.png',
    link: nuxt.$localePath('/couriers/AmbroExpress.pdf')
  },
  {
    name: 'BLPaczka Cross-Border',
    isLink: true,
    isPromo: false,
    imageLink: '/images/kurierzyV2/CLPCB.png',
    link: nuxt.$localePath('/couriers/Cross-Border.pdf')
  },
  {
    name: 'Cross-Border',
    isLink: true,
    isPromo: false,
    imageLink: '/images/kurierzyV2/eurohermes.png',
    link: nuxt.$localePath('/couriers/eurohermes.pdf')
  },
  {
    name: 'DHL',
    isLink: true,
    isPromo: false,
    imageLink: '/images/kurierzyV2/DHL.png',
    link: nuxt.$localePath('/couriers/DHL.pdf')
  },
  {
    name: 'DPD',
    isLink: true,
    isPromo: false,
    imageLink: '/images/kurierzyV2/DPD.png',
    link: nuxt.$localePath('/couriers/DPD.pdf')
  },
  {
    name: 'FedEx',
    isLink: true,
    isPromo: false,
    imageLink: '/images/kurierzyV2/FedEx.png',
    link: nuxt.$localePath('/couriers/FedEx.pdf')
  },
  {
    name: 'Geis',
    isLink: true,
    isPromo: false,
    imageLink: '/images/kurierzyV2/Geis.png',
    link: nuxt.$localePath('/couriers/Geis.pdf')
  },
  {
    name: 'Geodis',
    isLink: true,
    isPromo: false,
    imageLink: '/images/kurierzyV2/geodis3.svg',
    link: nuxt.$localePath('/couriers/Geodis.pdf')
  },
  {
    name: 'GLS',
    isLink: true,
    isPromo: false,
    imageLink: '/images/kurierzyV2/GLS.png',
    link: nuxt.$localePath('/couriers/GLS.pdf')
  },
  {
    name: 'Hellmann',
    isLink: true,
    isPromo: false,
    imageLink: '/images/kurierzyV2/Hellmann.png',
    link: nuxt.$localePath('/couriers/Hellmann.pdf')
  },
  {
    name: 'InPost',
    isLink: true,
    isPromo: false,
    imageLink: '/images/kurierzyV2/Inpost.png',
    link: nuxt.$localePath('/couriers/InPost.pdf')
  },
  {
    name: 'International',
    isLink: true,
    isPromo: false,
    imageLink: '/images/kurierzyV2/InPost_new.png',
    link: nuxt.$localePath('/couriers/InPostInternational.pdf')
  },
  {
    name: 'Orlen',
    isLink: true,
    isPromo: false,
    imageLink: '/images/kurierzyV2/OP.png',
    link: nuxt.$localePath('/couriers/Orlen.pdf')
  },
  {
    name: 'Poczta Polska',
    isLink: true,
    isPromo: false,
    imageLink: '/images/kurierzyV2/poczta.png',
    link: nuxt.$localePath('/couriers/PP.pdf')
  },
  {
    name: 'UPS',
    isLink: true,
    isPromo: false,
    imageLink: '/images/kurierzyV2/UPS.png',
    link: nuxt.$localePath('/couriers/UPS.pdf')
  },
  {
    name: 'Packeta',
    isLink: true,
    isPromo: false,
    imageLink: '/images/kurierzyV2/red-packeta.svg',
    link: nuxt.$localePath('/couriers/Packeta.pdf')
  },
  {
    name: 'Olza',
    isLink: true,
    isPromo: false,
    imageLink: '/images/kurierzyV2/olza-logistic.svg',
    link: nuxt.$localePath('/couriers/Olza.pdf')
  },
  // {
  //   name: 'Promo Cross-Border',
  //   isLink: true,
  //   isPromo: true,
  //   imageLink: '/images/kurierzyV2/BLPSignet2.png',
  //   link: nuxt.$localePath('/couriers/Cross-BorderPromo.pdf')
  // },
  // {
  //   name: 'Promo palety',
  //   isLink: true,
  //   isPromo: true,
  //   imageLink: '/images/kurierzyV2/BLPSignet2.png',
  //   link: nuxt.$localePath('/couriers/PromocjaŚwiątecznaPalety.pdf')
  // },
]

setPageValues(
    t('page.panel.price-list.couriers.title'),
);

useHead({
  title: t('page.panel.price-list.couriers.title')
});

definePageMeta({
  middleware: 'auth',
  layout: 'panel',
})
</script>

<template>
  <div class="pricesDetails_container">
    <div class="row">
      <span class="prices_specialInfoTxt prices_specialInfoTxt--priceDetailsMobileInfo">
        W przypadku problemu z dostępem do cenników sprawdź, czy Twoja przeglądarka obsługuje otwieranie plików w formacie PDF.
      </span>
    </div>

    <div class="pricesDetails_containerItems">
      <div v-for="courier in couriers">
        <a :href="courier.link" v-if="courier.isLink" class="pricesDetails_containerItem" :class="{ pricesDetails_containerItemPromo: courier.isPromo }">
          <span class="pricesDetails_containerContent">
            <img :src="courier.imageLink" :alt="courier.name" style="max-width: 100px"/>
            <span v-show="courier.name === 'International'" class="pricesDetails_containerName">{{ courier.name }}</span>

            <span v-show="courier.name === 'Promo Cross-Border'" class="pricesDetails_containerName" style="font-size: 11px; line-height: 12px; text-align: center; width: calc(100% + 24px); margin-top: 6px;">
              <span style="font-size: 16px; line-height: 21px; font-weight: 700; text-align: center;">Cross-Border</span> <br> Promocja Świąteczna <br> 1.11-31.12.2024
            </span>

            <span v-show="courier.name === 'Promo palety'" class="pricesDetails_containerName" style="font-size: 11px; line-height: 12px; text-align: center; width: calc(100% + 24px); margin-top: 6px;">
              <span style="font-size: 16px; line-height: 21px; font-weight: 700; text-align: center;">Palety</span> <br> Promocja Świąteczna <br> 1.11-31.12.2024
            </span>
<!--            <div v-show="courier.name === 'Cross-Border'" class="pricesDetails_premiumCB">-->
<!--              <span class="pricesDetails_premiumCBTitle">Premium CB</span>-->
<!--            </div>-->
          </span>
          <span class="pricesDetails_icon">
            <NuxtImg src="icons/download.png" width="30px" height="30px"/>
          </span>
        </a>
      </div>
    </div>
  </div>

<!--NIE USUWAĆ PONIŻSZEGO, ZAKOMENTOWANEGO KODU!!! TO SZABLON DLA CENNIKÓW MVP-->

<!--  <div class="panel_mainContainer">-->
<!--    <div class="pricesDetails_header">-->
<!--      <h1 class="pricesDetails_title">Cennik krajowy</h1>-->
<!--      <button class="pricesDetails_buttonPrimary">Waga</button>-->
<!--      <button class="pricesDetails_buttonSecondary">Przewoźnicy</button>-->
<!--    </div>-->

<!--    <div class="pricesDetails_row">-->
<!--      <h2 class="pricesDetails_subtitle">< 1 kg</h2>-->
<!--    </div>-->

<!--    <div class="pricesDetails_row">-->
<!--      <button class="pricesDetails_buttonPrimary">Door 2 Point</button>-->
<!--      <button class="pricesDetails_buttonSecondary">Door 2 Door</button>-->
<!--    </div>-->

<!--    <div class="pricesDetails_row">-->
<!--      <table class="pricesDetails_table">-->
<!--        <thead>-->
<!--          <tr class="pricesDetails_tr">-->
<!--            <th class="pricesDetails_th">Typ</th>-->
<!--            <th class="pricesDetails_th">Cena</th>-->
<!--            <th class="pricesDetails_th">Wymiary</th>-->
<!--            <th class="pricesDetails_th">Dodatkowe uwagi</th>-->
<!--          </tr>-->
<!--        </thead>-->

<!--        <tbody>-->
<!--          <tr class="pricesDetails_tr">-->
<!--            <td class="pricesDetails_td">-->
<!--              <div class="pricesDetails_tdContent">-->
<!--                <span>InPost Paczkomat</span>-->
<!--                <span class="pricesDetails_smallTxt">Paczka Ekonomiczna</span>-->
<!--              </div>-->
<!--            </td>-->

<!--            <td class="pricesDetails_td">-->
<!--              <div class="pricesDetails_tdContent">-->
<!--                <span class="pricesDetails_highlightTxt">7,99 zł</span>-->
<!--              </div>-->
<!--            </td>-->

<!--            <td class="pricesDetails_td">-->
<!--              <div class="pricesDetails_tdContent">-->
<!--                <span>Max. wymiary skrytek</span>-->
<!--                <span class="pricesDetails_smallTxt">8 x 38 x 64 cm</span>-->
<!--              </div>-->
<!--            </td>-->

<!--            <td class="pricesDetails_td">-->
<!--              <div class="pricesDetails_tdContent">-->
<!--                <span class="pricesDetails_smallTxt">Dodatkowe uwagi</span>-->
<!--              </div>-->
<!--            </td>-->
<!--          </tr>-->

<!--          <tr class="pricesDetails_tr">-->
<!--            <td class="pricesDetails_td">-->
<!--              <div class="pricesDetails_tdContent">-->
<!--                <span>InPost Paczkomat</span>-->
<!--                <span class="pricesDetails_smallTxt">Paczka Standardowa</span>-->
<!--                <span class="pricesDetails_smallTxt">> 1000 paczek miesięcznie</span>-->
<!--              </div>-->
<!--            </td>-->

<!--            <td class="pricesDetails_td">-->
<!--              <div class="pricesDetails_tdContent">-->
<!--                <span class="pricesDetails_highlightTxt">10,49 zł</span>-->
<!--              </div>-->
<!--            </td>-->

<!--            <td class="pricesDetails_td">-->
<!--              <div class="pricesDetails_tdContent">-->
<!--                <span>Max. wymiary skrytek</span>-->
<!--                <span class="pricesDetails_smallTxt">8 x 38 x 64 cm</span>-->
<!--              </div>-->
<!--            </td>-->

<!--            <td class="pricesDetails_td">-->
<!--              <div class="pricesDetails_tdContent">-->
<!--                <span class="pricesDetails_smallTxt"></span>-->
<!--              </div>-->
<!--            </td>-->
<!--          </tr>-->
<!--        </tbody>-->
<!--      </table>-->
<!--    </div>-->

<!--  </div>-->


  <!--NIE USUWAĆ TEGO TYMCZASOWO ZAKOMENTOWANEGO KODU!!!-->

  <!--<template>-->
  <!--  <div class="panel_mainContainer">-->
  <!--    <div class="priceList_panel">-->
  <!--      <div class="priceList_content">-->
  <!--        <p class="priceList_couriersHeader">Wybierz przewoźnika i pobierz cennik:</p>-->

  <!--        <div class="row">-->
  <!--          <div class="form_couriersWrapper">-->
  <!--            <div>-->
  <!--              <input type="radio" name="kurier" value="" class="form_radioInput" id="kurier1"/>-->
  <!--              <label class="form_radioLabel" for="kurier1">-->
  <!--                <div class="form_courierImgWrapper">-->
  <!--                  <NuxtImg src="images/kurierzy/inpost.png" style="max-width: 100%; max-height: 100%"/>-->
  <!--                </div>-->
  <!--                <span class="form_courierPrice">inPost</span>-->
  <!--              </label>-->
  <!--            </div>-->

  <!--            <div>-->
  <!--              <input type="radio" name="kurier" value="" class="form_radioInput" id="kurier2"/>-->
  <!--              <label class="form_radioLabel" for="kurier2">-->
  <!--                <div class="form_courierImgWrapper">-->
  <!--                  <NuxtImg src="images/kurierzy/gls.png" style="max-width: 100%; max-height: 100%"/>-->
  <!--                </div>-->
  <!--                <span class="form_courierPrice">GLS</span>-->
  <!--              </label>-->
  <!--            </div>-->

  <!--            <div>-->
  <!--              <input type="radio" name="kurier" value="" class="form_radioInput" id="kurier3"/>-->
  <!--              <label class="form_radioLabel" for="kurier3">-->
  <!--                <div class="form_courierImgWrapper">-->
  <!--                  <NuxtImg src="images/kurierzy/fedex.png" style="max-width: 100%; max-height: 100%"/>-->
  <!--                </div>-->
  <!--                <span class="form_courierPrice">FedEx</span>-->
  <!--              </label>-->
  <!--            </div>-->

  <!--            <div>-->
  <!--              <input type="radio" name="kurier" value="" class="form_radioInput" id="kurier4"/>-->
  <!--              <label class="form_radioLabel" for="kurier4">-->
  <!--                <div class="form_courierImgWrapper">-->
  <!--                  <NuxtImg src="images/kurierzy/dhl.png" style="max-width: 100%; max-height: 100%"/>-->
  <!--                </div>-->
  <!--                <span class="form_courierPrice">DHL</span>-->
  <!--              </label>-->
  <!--            </div>-->

  <!--            <div>-->
  <!--              <input type="radio" name="kurier" value="" class="form_radioInput" id="kurier5"/>-->
  <!--              <label class="form_radioLabel" for="kurier5">-->
  <!--                <div class="form_courierImgWrapper">-->
  <!--                  <NuxtImg src="images/kurierzy/dpd.png" style="max-width: 100%; max-height: 100%"/>-->
  <!--                </div>-->
  <!--                <span class="form_courierPrice">DPD</span>-->
  <!--              </label>-->
  <!--            </div>-->

  <!--            <div>-->
  <!--              <input type="radio" name="kurier" value="" class="form_radioInput" id="kurier6"/>-->
  <!--              <label class="form_radioLabel" for="kurier6">-->
  <!--                <div class="form_courierImgWrapper">-->
  <!--                  <NuxtImg src="images/kurierzy/orlen.png" style="max-width: 100%; max-height: 100%"/>-->
  <!--                </div>-->
  <!--                <span class="form_courierPrice">Orlen</span>-->
  <!--              </label>-->
  <!--            </div>-->

  <!--            <div>-->
  <!--              <input type="radio" name="kurier" value="" class="form_radioInput" id="kurier7"/>-->
  <!--              <label class="form_radioLabel" for="kurier7">-->
  <!--                <div class="form_courierImgWrapper">-->
  <!--                  <NuxtImg src="images/kurierzy/pocztex.png" style="max-width: 100%; max-height: 100%"/>-->
  <!--                </div>-->
  <!--                <span class="form_courierPrice">Pocztex</span>-->
  <!--              </label>-->
  <!--            </div>-->

  <!--            <div>-->
  <!--              <input type="radio" name="kurier" value="" class="form_radioInput" id="kurier8"/>-->
  <!--              <label class="form_radioLabel" for="kurier8">-->
  <!--                <div class="form_courierImgWrapper">-->
  <!--                  <NuxtImg src="images/kurierzy/ups.png" style="max-width: 100%; max-height: 100%"/>-->
  <!--                </div>-->
  <!--                <span class="form_courierPrice">UPS</span>-->
  <!--              </label>-->
  <!--            </div>-->
  <!--          </div>-->
  <!--        </div>-->
  <!--      </div>-->
  <!--    </div>-->
  <!--  </div>-->
  <!--</template>-->
</template>

<style scoped>

</style>