<script setup lang="ts">
import usePageStore from "~/stores/usePageStore";

const { t } = useI18n();
const { setPageValues } = usePageStore();

setPageValues(
    t('page.panel.price-list.export.title'),
);

useHead({
  title: t('page.panel.price-list.export.title')
});

definePageMeta({
  middleware: 'auth',
  layout: 'panel',
})
</script>

<template>
<!--  &lt;!&ndash;NARODOWE&ndash;&gt;-->
<!--  <div class="panel_mainContainer">-->
<!--    <div class="priceList_panel">-->
<!--      <div class="priceList_header">Cennik międzynarodowy</div>-->
<!--      <div class="priceList_content">-->
<!--        <p class="priceList_couriersHeader">Wybierz przewoźnika i pobierz cennik:</p>-->

<!--        <div class="row">-->
<!--          <div class="form_couriersWrapper">-->
<!--            <div>-->
<!--              <input type="radio" name="kurier" value="" class="form_radioInput" id="kurier1" />-->
<!--              <label class="form_radioLabel" for="kurier1">-->
<!--                <div class="form_courierImgWrapper">-->
<!--                  <NuxtImg src="images/kurierzy/inpost.png" style="max-width: 100%; max-height: 100%"/>-->
<!--                </div>-->
<!--                <span class="form_courierPrice">inPost</span>-->
<!--              </label>-->
<!--            </div>-->

<!--            <div>-->
<!--              <input type="radio" name="kurier" value="" class="form_radioInput" id="kurier2" />-->
<!--              <label class="form_radioLabel" for="kurier2">-->
<!--                <div class="form_courierImgWrapper">-->
<!--                  <NuxtImg src="images/kurierzy/gls.png" style="max-width: 100%; max-height: 100%"/>-->
<!--                </div>-->
<!--                <span class="form_courierPrice">GLS</span>-->
<!--              </label>-->
<!--            </div>-->

<!--            <div>-->
<!--              <input type="radio" name="kurier" value="" class="form_radioInput" id="kurier3" />-->
<!--              <label class="form_radioLabel" for="kurier3">-->
<!--                <div class="form_courierImgWrapper">-->
<!--                  <NuxtImg src="images/kurierzy/fedex.png" style="max-width: 100%; max-height: 100%"/>-->
<!--                </div>-->
<!--                <span class="form_courierPrice">FedEx</span>-->
<!--              </label>-->
<!--            </div>-->

<!--            <div>-->
<!--              <input type="radio" name="kurier" value="" class="form_radioInput" id="kurier4" />-->
<!--              <label class="form_radioLabel" for="kurier4">-->
<!--                <div class="form_courierImgWrapper">-->
<!--                  <NuxtImg src="images/kurierzy/dhl.png" style="max-width: 100%; max-height: 100%"/>-->
<!--                </div>-->
<!--                <span class="form_courierPrice">DHL</span>-->
<!--              </label>-->
<!--            </div>-->

<!--            <div>-->
<!--              <input type="radio" name="kurier" value="" class="form_radioInput" id="kurier5" />-->
<!--              <label class="form_radioLabel" for="kurier5">-->
<!--                <div class="form_courierImgWrapper">-->
<!--                  <NuxtImg src="images/kurierzy/dpd.png" style="max-width: 100%; max-height: 100%"/>-->
<!--                </div>-->
<!--                <span class="form_courierPrice">DPD</span>-->
<!--              </label>-->
<!--            </div>-->

<!--            <div>-->
<!--              <input type="radio" name="kurier" value="" class="form_radioInput" id="kurier6" />-->
<!--              <label class="form_radioLabel" for="kurier6">-->
<!--                <div class="form_courierImgWrapper">-->
<!--                  <NuxtImg src="images/kurierzy/orlen.png" style="max-width: 100%; max-height: 100%"/>-->
<!--                </div>-->
<!--                <span class="form_courierPrice">Orlen</span>-->
<!--              </label>-->
<!--            </div>-->

<!--            <div>-->
<!--              <input type="radio" name="kurier" value="" class="form_radioInput" id="kurier7" />-->
<!--              <label class="form_radioLabel" for="kurier7">-->
<!--                <div class="form_courierImgWrapper">-->
<!--                  <NuxtImg src="images/kurierzy/pocztex.png" style="max-width: 100%; max-height: 100%"/>-->
<!--                </div>-->
<!--                <span class="form_courierPrice">Pocztex</span>-->
<!--              </label>-->
<!--            </div>-->

<!--            <div>-->
<!--              <input type="radio" name="kurier" value="" class="form_radioInput" id="kurier8" />-->
<!--              <label class="form_radioLabel" for="kurier8">-->
<!--                <div class="form_courierImgWrapper">-->
<!--                  <NuxtImg src="images/kurierzy/ups.png" style="max-width: 100%; max-height: 100%"/>-->
<!--                </div>-->
<!--                <span class="form_courierPrice">UPS</span>-->
<!--              </label>-->
<!--            </div>-->
<!--          </div>-->
<!--        </div>-->

<!--        <h2 class="priceList_contentHeader">Cennik międzynarodowy - door to door:</h2>-->
<!--        <p class="priceList_infoTxt">Poniższe stawki to ceny netto uwzględniające opłatę paliwową/drogową.</p>-->




<!--      </div>-->

<!--      <div class="row">-->
<!--        <table class="priceList_table">-->
<!--          <thead>-->
<!--          <tr style="background-color: yellow;">-->
<!--            <th>UPS</th>-->
<!--            <th>do 2kg</th>-->
<!--            <th>do 5kg</th>-->
<!--            <th>do 10kg</th>-->
<!--            <th>do 15kg</th>-->
<!--            <th>do 20kg</th>-->
<!--            <th>do 25kg</th>-->
<!--            <th>do 30kg</th>-->
<!--          </tr>-->
<!--          </thead>-->
<!--          <tbody>-->
<!--          <tr>-->
<!--            <td>Czechy</td>-->
<!--            <td>29,99zł</td>-->
<!--            <td>34,99zł</td>-->
<!--            <td>44,99zł</td>-->
<!--            <td>49,99zł</td>-->
<!--            <td>54,99zł</td>-->
<!--            <td>54,99zł</td>-->
<!--            <td>59,99zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Niemcy</td>-->
<!--            <td>29,99zł</td>-->
<!--            <td>34,99zł</td>-->
<!--            <td>44,99zł</td>-->
<!--            <td>49,99zł</td>-->
<!--            <td>54,99zł</td>-->
<!--            <td>54,99zł</td>-->
<!--            <td>59,99zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Słowacja</td>-->
<!--            <td>29,99zł</td>-->
<!--            <td>34,99zł</td>-->
<!--            <td>44,99zł</td>-->
<!--            <td>49,99zł</td>-->
<!--            <td>54,99zł</td>-->
<!--            <td>54,99zł</td>-->
<!--            <td>59,99zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Austria</td>-->
<!--            <td>34,99zł</td>-->
<!--            <td>39,99zł</td>-->
<!--            <td>49,99zł</td>-->
<!--            <td>49,99zł</td>-->
<!--            <td>54,99zł</td>-->
<!--            <td>59,99zł</td>-->
<!--            <td>59,99zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Węgry</td>-->
<!--            <td>34,99zł</td>-->
<!--            <td>39,99zł</td>-->
<!--            <td>49,99zł</td>-->
<!--            <td>49,99zł</td>-->
<!--            <td>54,99zł</td>-->
<!--            <td>59,99zł</td>-->
<!--            <td>64,99zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Belgia</td>-->
<!--            <td>39,99zł</td>-->
<!--            <td>44,99zł</td>-->
<!--            <td>49,99zł</td>-->
<!--            <td>54,99zł</td>-->
<!--            <td>64,99zł</td>-->
<!--            <td>69,99zł</td>-->
<!--            <td>74,99zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Bułgaria</td>-->
<!--            <td>39,99zł</td>-->
<!--            <td>44,99zł</td>-->
<!--            <td>49,99zł</td>-->
<!--            <td>54,99zł</td>-->
<!--            <td>59,99zł</td>-->
<!--            <td>69,99zł</td>-->
<!--            <td>74,99zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Dania</td>-->
<!--            <td>39,99zł</td>-->
<!--            <td>44,99zł</td>-->
<!--            <td>49,99zł</td>-->
<!--            <td>54,99zł</td>-->
<!--            <td>59,99zł</td>-->
<!--            <td>69,99zł</td>-->
<!--            <td>74,99zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Estonia</td>-->
<!--            <td>39,99zł</td>-->
<!--            <td>44,99zł</td>-->
<!--            <td>49,99zł</td>-->
<!--            <td>54,99zł</td>-->
<!--            <td>59,99zł</td>-->
<!--            <td>69,99zł</td>-->
<!--            <td>74,99zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Francja</td>-->
<!--            <td>39,99zł</td>-->
<!--            <td>44,99zł</td>-->
<!--            <td>49,99zł</td>-->
<!--            <td>54,99zł</td>-->
<!--            <td>59,99zł</td>-->
<!--            <td>69,99zł</td>-->
<!--            <td>74,99zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Holandia</td>-->
<!--            <td>39,99zł</td>-->
<!--            <td>44,99zł</td>-->
<!--            <td>49,99zł</td>-->
<!--            <td>54,99zł</td>-->
<!--            <td>59,99zł</td>-->
<!--            <td>69,99zł</td>-->
<!--            <td>74,99zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Litwa</td>-->
<!--            <td>39,99zł</td>-->
<!--            <td>44,99zł</td>-->
<!--            <td>49,99zł</td>-->
<!--            <td>54,99zł</td>-->
<!--            <td>59,99zł</td>-->
<!--            <td>69,99zł</td>-->
<!--            <td>74,99zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Łotwa</td>-->
<!--            <td>39,99zł</td>-->
<!--            <td>44,99zł</td>-->
<!--            <td>49,99zł</td>-->
<!--            <td>54,99zł</td>-->
<!--            <td>59,99zł</td>-->
<!--            <td>69,99zł</td>-->
<!--            <td>74,99zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Luksemburg</td>-->
<!--            <td>39,99zł</td>-->
<!--            <td>44,99zł</td>-->
<!--            <td>49,99zł</td>-->
<!--            <td>54,99zł</td>-->
<!--            <td>59,99zł</td>-->
<!--            <td>69,99zł</td>-->
<!--            <td>74,99zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Monako</td>-->
<!--            <td>39,99zł</td>-->
<!--            <td>44,99zł</td>-->
<!--            <td>49,99zł</td>-->
<!--            <td>54,99zł</td>-->
<!--            <td>59,99zł</td>-->
<!--            <td>69,99zł</td>-->
<!--            <td>74,99zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Rumunia</td>-->
<!--            <td>39,99zł</td>-->
<!--            <td>44,99zł</td>-->
<!--            <td>49,99zł</td>-->
<!--            <td>54,99zł</td>-->
<!--            <td>59,99zł</td>-->
<!--            <td>69,99zł</td>-->
<!--            <td>74,99zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Chorwacja</td>-->
<!--            <td>39,99zł</td>-->
<!--            <td>44,99zł</td>-->
<!--            <td>54,99zł</td>-->
<!--            <td>59,99zł</td>-->
<!--            <td>64,99zł</td>-->
<!--            <td>74,99zł</td>-->
<!--            <td>74,99zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Finlandia</td>-->
<!--            <td>39,99zł</td>-->
<!--            <td>44,99zł</td>-->
<!--            <td>54,99zł</td>-->
<!--            <td>59,99zł</td>-->
<!--            <td>64,99zł</td>-->
<!--            <td>74,99zł</td>-->
<!--            <td>74,99zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Hiszpania</td>-->
<!--            <td>39,99zł</td>-->
<!--            <td>44,99zł</td>-->
<!--            <td>54,99zł</td>-->
<!--            <td>59,99zł</td>-->
<!--            <td>64,99zł</td>-->
<!--            <td>74,99zł</td>-->
<!--            <td>74,99zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Słowenia</td>-->
<!--            <td>39,99zł</td>-->
<!--            <td>44,99zł</td>-->
<!--            <td>54,99zł</td>-->
<!--            <td>59,99zł</td>-->
<!--            <td>64,99zł</td>-->
<!--            <td>74,99zł</td>-->
<!--            <td>74,99zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Szwecja</td>-->
<!--            <td>39,99zł</td>-->
<!--            <td>44,99zł</td>-->
<!--            <td>54,99zł</td>-->
<!--            <td>59,99zł</td>-->
<!--            <td>64,99zł</td>-->
<!--            <td>74,99zł</td>-->
<!--            <td>74,99zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Włochy</td>-->
<!--            <td>39,99zł</td>-->
<!--            <td>44,99zł</td>-->
<!--            <td>54,99zł</td>-->
<!--            <td>59,99zł</td>-->
<!--            <td>64,99zł</td>-->
<!--            <td>74,99zł</td>-->
<!--            <td>74,99zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Grecja</td>-->
<!--            <td>39,99zł</td>-->
<!--            <td>44,99zł</td>-->
<!--            <td>54,99zł</td>-->
<!--            <td>59,99zł</td>-->
<!--            <td>64,99zł</td>-->
<!--            <td>74,99zł</td>-->
<!--            <td>74,99zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Irlandia Północna</td>-->
<!--            <td>39,99zł</td>-->
<!--            <td>44,99zł</td>-->
<!--            <td>54,99zł</td>-->
<!--            <td>59,99zł</td>-->
<!--            <td>64,99zł</td>-->
<!--            <td>74,99zł</td>-->
<!--            <td>74,99zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Portugalia</td>-->
<!--            <td>39,99zł</td>-->
<!--            <td>44,99zł</td>-->
<!--            <td>54,99zł</td>-->
<!--            <td>59,99zł</td>-->
<!--            <td>64,99zł</td>-->
<!--            <td>74,99zł</td>-->
<!--            <td>74,99zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Wielka Brytania</td>-->
<!--            <td>79,99zł</td>-->
<!--            <td>79,99zł</td>-->
<!--            <td>84,99zł</td>-->
<!--            <td>92,00zł</td>-->
<!--            <td>109,99zł</td>-->
<!--            <td>109,99zł</td>-->
<!--            <td>119,99zł</td>-->
<!--          </tr>-->
<!--          </tbody>-->
<!--        </table>-->
<!--      </div>-->

<!--      <div class="row">-->
<!--        <table class="priceList_table">-->
<!--          <thead>-->
<!--          <tr style="background-color: yellow;">-->
<!--            <th>GLS</th>-->
<!--            <th>do 2 kg</th>-->
<!--            <th>2-5 kg</th>-->
<!--            <th>5-10 kg</th>-->
<!--            <th>10-15 kg</th>-->
<!--            <th>15-25 kg</th>-->
<!--          </tr>-->
<!--          </thead>-->
<!--          <tbody>-->
<!--          <tr>-->
<!--            <td>Niemcy</td>-->
<!--            <td>32,99 zł</td>-->
<!--            <td>39,99 zł</td>-->
<!--            <td>44,99 zł</td>-->
<!--            <td>49,99 zł</td>-->
<!--            <td>69,99 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Francja</td>-->
<!--            <td>54,99 zł</td>-->
<!--            <td>66,99 zł</td>-->
<!--            <td>69,99 zł</td>-->
<!--            <td>74,99 zł</td>-->
<!--            <td>99,99 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Włochy</td>-->
<!--            <td>49,99 zł</td>-->
<!--            <td>65,99 zł</td>-->
<!--            <td>69,99 zł</td>-->
<!--            <td>74,99 zł</td>-->
<!--            <td>89,99 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Austria</td>-->
<!--            <td>32,99 zł</td>-->
<!--            <td>39,99 zł</td>-->
<!--            <td>44,99 zł</td>-->
<!--            <td>49,99 zł</td>-->
<!--            <td>69,99 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Hiszpania</td>-->
<!--            <td>59,99 zł</td>-->
<!--            <td>88,99 zł</td>-->
<!--            <td>89,99 zł</td>-->
<!--            <td>99,99 zł</td>-->
<!--            <td>119,99 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Czechy</td>-->
<!--            <td>33,99 zł</td>-->
<!--            <td>35,99 zł</td>-->
<!--            <td>37,99 zł</td>-->
<!--            <td>49,99 zł</td>-->
<!--            <td>49,99 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Rumunia</td>-->
<!--            <td>54,99 zł</td>-->
<!--            <td>42,99 zł</td>-->
<!--            <td>49,99 zł</td>-->
<!--            <td>69,99 zł</td>-->
<!--            <td>79,99 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Węgry</td>-->
<!--            <td>34,99 zł</td>-->
<!--            <td>42,99 zł</td>-->
<!--            <td>49,99 zł</td>-->
<!--            <td>54,99 zł</td>-->
<!--            <td>79,99 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Holandia</td>-->
<!--            <td>37,99 zł</td>-->
<!--            <td>44,99 zł</td>-->
<!--            <td>49,99 zł</td>-->
<!--            <td>54,99 zł</td>-->
<!--            <td>74,99 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Belgia</td>-->
<!--            <td>34,99 zł</td>-->
<!--            <td>49,99 zł</td>-->
<!--            <td>54,99 zł</td>-->
<!--            <td>59,99 zł</td>-->
<!--            <td>74,99 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Słowacja</td>-->
<!--            <td>34,99 zł</td>-->
<!--            <td>46,99 zł</td>-->
<!--            <td>49,99 zł</td>-->
<!--            <td>54,99 zł</td>-->
<!--            <td>74,99 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Litwa</td>-->
<!--            <td>44,99 zł</td>-->
<!--            <td>59,99 zł</td>-->
<!--            <td>64,99 zł</td>-->
<!--            <td>74,99 zł</td>-->
<!--            <td>79,99 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Szwecja</td>-->
<!--            <td>74,99 zł</td>-->
<!--            <td>96,99 zł</td>-->
<!--            <td>99,99 zł</td>-->
<!--            <td>109,99 zł</td>-->
<!--            <td>124,99 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Dania</td>-->
<!--            <td>37,99 zł</td>-->
<!--            <td>44,99 zł</td>-->
<!--            <td>54,99 zł</td>-->
<!--            <td>59,99 zł</td>-->
<!--            <td>79,99 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Portugalia</td>-->
<!--            <td>52,99 zł</td>-->
<!--            <td>85,99 zł</td>-->
<!--            <td>93,99 zł</td>-->
<!--            <td>99,99 zł</td>-->
<!--            <td>119,99 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Luksemburg</td>-->
<!--            <td>39,99 zł</td>-->
<!--            <td>44,99 zł</td>-->
<!--            <td>49,99 zł</td>-->
<!--            <td>54,99 zł</td>-->
<!--            <td>74,99 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Łotwa</td>-->
<!--            <td>42,99 zł</td>-->
<!--            <td>49,99 zł</td>-->
<!--            <td>54,99 zł</td>-->
<!--            <td>57,99 zł</td>-->
<!--            <td>79,99 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Chorwacja</td>-->
<!--            <td>44,99 zł</td>-->
<!--            <td>65,99 zł</td>-->
<!--            <td>69,99 zł</td>-->
<!--            <td>79,99 zł</td>-->
<!--            <td>99,99 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Grecja</td>-->
<!--            <td>69,99 zł</td>-->
<!--            <td>99,99 zł</td>-->
<!--            <td>119,99 zł</td>-->
<!--            <td>144,99 zł</td>-->
<!--            <td>214,99 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Słowenia</td>-->
<!--            <td>39,99 zł</td>-->
<!--            <td>72,99 zł</td>-->
<!--            <td>74,99 zł</td>-->
<!--            <td>84,99 zł</td>-->
<!--            <td>99,99 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Finlandia</td>-->
<!--            <td>69,99 zł</td>-->
<!--            <td>94,99 zł</td>-->
<!--            <td>99,99 zł</td>-->
<!--            <td>114,99 zł</td>-->
<!--            <td>129,99 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Bułgaria</td>-->
<!--            <td>44,99 zł</td>-->
<!--            <td>49,99 zł</td>-->
<!--            <td>54,99 zł</td>-->
<!--            <td>59,99 zł</td>-->
<!--            <td>109,99 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Estonia</td>-->
<!--            <td>49,99 zł</td>-->
<!--            <td>58,99 zł</td>-->
<!--            <td>59,99 zł</td>-->
<!--            <td>64,99 zł</td>-->
<!--            <td>84,99 zł</td>-->
<!--          </tr>-->
<!--          </tbody>-->
<!--        </table>-->
<!--      </div>-->

<!--      <div class="row">-->
<!--        <table class="priceList_table">-->
<!--          <thead>-->
<!--          <tr style="background-color: yellow;">-->
<!--            <th>DPD</th>-->
<!--            <th>do 1 kg</th>-->
<!--            <th>1-3 kg</th>-->
<!--            <th>3-10 kg</th>-->
<!--            <th>10-20 kg</th>-->
<!--          </tr>-->
<!--          </thead>-->
<!--          <tbody>-->
<!--          <tr>-->
<!--            <td>Niemcy</td>-->
<!--            <td>54,99 zł</td>-->
<!--            <td>64,99 zł</td>-->
<!--            <td>124,99 zł</td>-->
<!--            <td>149,99 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Francja</td>-->
<!--            <td>94,99 zł</td>-->
<!--            <td>109,99 zł</td>-->
<!--            <td>144,99 zł</td>-->
<!--            <td>164,99 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Włochy</td>-->
<!--            <td>94,99 zł</td>-->
<!--            <td>109,99 zł</td>-->
<!--            <td>144,99 zł</td>-->
<!--            <td>164,99 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Austria</td>-->
<!--            <td>59,99 zł</td>-->
<!--            <td>74,99 zł</td>-->
<!--            <td>129,99 zł</td>-->
<!--            <td>154,99 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Hiszpania</td>-->
<!--            <td>129,99 zł</td>-->
<!--            <td>144,99 zł</td>-->
<!--            <td>184,99 zł</td>-->
<!--            <td>209,99 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Czechy</td>-->
<!--            <td>59,99 zł</td>-->
<!--            <td>64,99 zł</td>-->
<!--            <td>119,99 zł</td>-->
<!--            <td>144,99 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Rumunia</td>-->
<!--            <td>94,99 zł</td>-->
<!--            <td>109,99 zł</td>-->
<!--            <td>144,99 zł</td>-->
<!--            <td>164,99 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Węgry</td>-->
<!--            <td>54,99 zł</td>-->
<!--            <td>64,99 zł</td>-->
<!--            <td>119,99 zł</td>-->
<!--            <td>144,99 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Holandia</td>-->
<!--            <td>64,99 zł</td>-->
<!--            <td>79,99 zł</td>-->
<!--            <td>129,99 zł</td>-->
<!--            <td>154,99 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Belgia</td>-->
<!--            <td>64,99 zł</td>-->
<!--            <td>79,99 zł</td>-->
<!--            <td>129,99 zł</td>-->
<!--            <td>154,99 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Słowacja</td>-->
<!--            <td>54,99 zł</td>-->
<!--            <td>69,99 zł</td>-->
<!--            <td>124,99 zł</td>-->
<!--            <td>149,99 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Litwa</td>-->
<!--            <td>54,99 zł</td>-->
<!--            <td>69,99 zł</td>-->
<!--            <td>119,99 zł</td>-->
<!--            <td>144,99 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Szwecja</td>-->
<!--            <td>139,99 zł</td>-->
<!--            <td>154,99 zł</td>-->
<!--            <td>189,99 zł</td>-->
<!--            <td>209,99 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Dania</td>-->
<!--            <td>94,99 zł</td>-->
<!--            <td>109,99 zł</td>-->
<!--            <td>139,99 zł</td>-->
<!--            <td>154,99 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Portugalia</td>-->
<!--            <td>134,99 zł</td>-->
<!--            <td>149,99 zł</td>-->
<!--            <td>184,99 zł</td>-->
<!--            <td>209,99 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Luksemburg</td>-->
<!--            <td>64,99 zł</td>-->
<!--            <td>79,99 zł</td>-->
<!--            <td>129,99 zł</td>-->
<!--            <td>154,99 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Łotwa</td>-->
<!--            <td>54,99 zł</td>-->
<!--            <td>74,99 zł</td>-->
<!--            <td>124,99 zł</td>-->
<!--            <td>154,99 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Chorwacja</td>-->
<!--            <td>129,99 zł</td>-->
<!--            <td>144,99 zł</td>-->
<!--            <td>184,99 zł</td>-->
<!--            <td>209,99 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Grecja</td>-->
<!--            <td>144,99 zł</td>-->
<!--            <td>159,99 zł</td>-->
<!--            <td>199,99 zł</td>-->
<!--            <td>214,99 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Słowenia</td>-->
<!--            <td>64,99 zł</td>-->
<!--            <td>79,99 zł</td>-->
<!--            <td>139,99 zł</td>-->
<!--            <td>154,99 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Finlandia</td>-->
<!--            <td>139,99 zł</td>-->
<!--            <td>154,00 zł</td>-->
<!--            <td>194,99 zł</td>-->
<!--            <td>209,99 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Bułgaria</td>-->
<!--            <td>94,99 zł</td>-->
<!--            <td>109,99 zł</td>-->
<!--            <td>144,99 zł</td>-->
<!--            <td>164,99 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Estonia</td>-->
<!--            <td>64,99 zł</td>-->
<!--            <td>79,99 zł</td>-->
<!--            <td>139,99 zł</td>-->
<!--            <td>154,99 zł</td>-->
<!--          </tr>-->
<!--          </tbody>-->
<!--        </table>-->
<!--      </div>-->

<!--      <div class="row">-->
<!--        <table class="priceList_table">-->
<!--          <thead>-->
<!--          <tr style="background-color: yellow;">-->
<!--            <th>UPS przesyłka lotnicza</th>-->
<!--            <th>1 kg</th>-->
<!--            <th>2 kg</th>-->
<!--            <th>3 kg</th>-->
<!--            <th>4 kg</th>-->
<!--            <th>5 kg</th>-->
<!--            <th>6 kg</th>-->
<!--            <th>7 kg</th>-->
<!--            <th>8 kg</th>-->
<!--            <th>9 kg</th>-->
<!--            <th>10 kg</th>-->
<!--            <th>11 kg</th>-->
<!--            <th>12 kg</th>-->
<!--            <th>13 kg</th>-->
<!--            <th>14 kg</th>-->
<!--            <th>15 kg</th>-->
<!--            <th>16 kg</th>-->
<!--            <th>17 kg</th>-->
<!--            <th>18 kg</th>-->
<!--            <th>19 kg</th>-->
<!--            <th>20 kg</th>-->
<!--          </tr>-->
<!--          </thead>-->
<!--          <tbody>-->
<!--          <tr>-->
<!--            <td>USA</td>-->
<!--            <td>130 zł</td>-->
<!--            <td>168 zł</td>-->
<!--            <td>201 zł</td>-->
<!--            <td>234 zł</td>-->
<!--            <td>267 zł</td>-->
<!--            <td>287 zł</td>-->
<!--            <td>307 zł</td>-->
<!--            <td>327 zł</td>-->
<!--            <td>348 zł</td>-->
<!--            <td>368 zł</td>-->
<!--            <td>380 zł</td>-->
<!--            <td>392 zł</td>-->
<!--            <td>404 zł</td>-->
<!--            <td>416 zł</td>-->
<!--            <td>429 zł</td>-->
<!--            <td>441 zł</td>-->
<!--            <td>454 zł</td>-->
<!--            <td>466 zł</td>-->
<!--            <td>478 zł</td>-->
<!--            <td>491 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Kanada</td>-->
<!--            <td>130 zł</td>-->
<!--            <td>168 zł</td>-->
<!--            <td>201 zł</td>-->
<!--            <td>234 zł</td>-->
<!--            <td>267 zł</td>-->
<!--            <td>287 zł</td>-->
<!--            <td>307 zł</td>-->
<!--            <td>327 zł</td>-->
<!--            <td>348 zł</td>-->
<!--            <td>368 zł</td>-->
<!--            <td>380 zł</td>-->
<!--            <td>392 zł</td>-->
<!--            <td>404 zł</td>-->
<!--            <td>416 zł</td>-->
<!--            <td>429 zł</td>-->
<!--            <td>441 zł</td>-->
<!--            <td>454 zł</td>-->
<!--            <td>466 zł</td>-->
<!--            <td>478 zł</td>-->
<!--            <td>491 zł</td>-->
<!--          </tr>-->
<!--          </tbody>-->
<!--        </table>-->
<!--      </div>-->

<!--      <div class="row">-->
<!--        <p class="priceList_infoTxt">Usługi dodatkowe w ofercie door to door:</p>-->
<!--        <table class="priceList_table">-->
<!--          <thead>-->
<!--          <tr style="background-color: #d9e1f2;">-->
<!--            <th colspan="2">UPS</th>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <th>Ubezpieczenie</th>-->
<!--            <th></th>-->
<!--          </tr>-->
<!--          </thead>-->
<!--          <tbody>-->
<!--          <tr>-->
<!--            <td>Do kwoty (zł)</td>-->
<!--            <td>Cena</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>323</td>-->
<!--            <td>w cenie</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>324-10 000</td>-->
<!--            <td>25,99 zł</td>-->
<!--          </tr>-->
<!--          </tbody>-->
<!--        </table>-->
<!--      </div>-->

<!--      <div class="row">-->
<!--        <div style="float: right; text-align: left;">-->
<!--          <p class="priceList_infoTxt">Najdłuższy bok 100 cm</p>-->
<!--          <p class="priceList_infoTxt">Waga maksymalna 20 kg</p>-->
<!--        </div>-->

<!--        <table class="priceList_table">-->
<!--          <thead>-->
<!--          <tr style="background-color: #d9e1f2;">-->
<!--            <th colspan="2">Pobranie (COD)</th>-->
<!--          </tr>-->
<!--          </thead>-->
<!--          <tbody>-->
<!--          <tr>-->
<!--            <td>Do kwoty (zł)</td>-->
<!--            <td>Cena</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>9 000</td>-->
<!--            <td>20,99 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Paczka Niesortowalna</td>-->
<!--            <td>159,99 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Duża Paczka</td>-->
<!--            <td>159,99 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Dostawa w strefie rozszerzonej</td>-->
<!--            <td>29,99 zł</td>-->
<!--          </tr>-->
<!--          </tbody>-->
<!--        </table>-->
<!--      </div>-->

<!--      <div class="row">-->
<!--        <table class="priceList_table">-->
<!--          <thead>-->
<!--          <tr style="background-color: #d9e1f2;">-->
<!--            <th colspan="2">GLS</th>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <th colspan="2">Ubezpieczenie i pobranie (COD) dostępne wkrótce</th>-->
<!--          </tr>-->
<!--          </thead>-->
<!--          <tbody>-->
<!--          <tr>-->
<!--            <td>Paczka Niesortowalna</td>-->
<!--            <td>99,00 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Duża Paczka</td>-->
<!--            <td>99,00 zł</td>-->
<!--          </tr>-->
<!--          </tbody>-->
<!--        </table>-->

<!--        <div style="float: right; text-align: left;">-->
<!--          <p class="priceList_infoTxt">Najdłuższy bok 150 cm</p>-->
<!--          <p class="priceList_infoTxt">Waga maksymalna 25 kg</p>-->
<!--        </div>-->
<!--      </div>-->

<!--      <div class="row">-->
<!--        <table class="priceList_table">-->
<!--          <thead>-->
<!--          <tr style="background-color: #d9e1f2;">-->
<!--            <th colspan="2">DPD</th>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <th colspan="2">Ubezpieczenie</th>-->
<!--          </tr>-->
<!--          </thead>-->
<!--          <tbody>-->
<!--          <tr>-->
<!--            <td>Do kwoty (zł)</td>-->
<!--            <td>Cena</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>1 000</td>-->
<!--            <td>w cenie</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>2 000</td>-->
<!--            <td>2,49 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>3 000</td>-->
<!--            <td>3,49 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>4 000</td>-->
<!--            <td>4,49 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>20 000</td>-->
<!--            <td>44,99 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>50 000</td>-->
<!--            <td>109,99 zł</td>-->
<!--          </tr>-->
<!--          </tbody>-->
<!--        </table>-->
<!--      </div>-->

<!--      <div class="row">-->
<!--        <table class="priceList_table">-->
<!--          <thead>-->
<!--          <tr>-->
<!--            <th colspan="2">Pobranie (COD) dostępne wkrótce</th>-->
<!--          </tr>-->
<!--          </thead>-->
<!--          <tbody>-->
<!--          <tr>-->
<!--            <td>Paczka Niesortowalna</td>-->
<!--            <td>179,99 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Duża Paczka</td>-->
<!--            <td>179,99 zł</td>-->
<!--          </tr>-->
<!--          </tbody>-->
<!--        </table>-->
<!--      </div>-->

<!--      <div class="row">-->
<!--        <div style="float: right; text-align: left;">-->
<!--          <p class="priceList_infoTxt">Najdłuższy bok 175 cm</p>-->
<!--          <p class="priceList_infoTxt">Waga maksymalna 20 kg</p>-->
<!--        </div>-->
<!--      </div>-->

<!--      &lt;!&ndash;  Cennik międzynarodowy BLPaczka Cross-Border&ndash;&gt;-->

<!--      <div class="row">-->
<!--        <table class="priceList_table">-->
<!--          <thead>-->
<!--          <tr>-->
<!--            <th colspan="6">Cross Border - Dostawa do punktu/automatu (Point Delivery)</th>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <th>Kraj</th>-->
<!--            <th>Niemcy</th>-->
<!--            <th>Czechy</th>-->
<!--            <th>Słowacja</th>-->
<!--            <th>Słowenia</th>-->
<!--            <th>Węgry</th>-->
<!--          </tr>-->
<!--          </thead>-->
<!--          <tbody>-->
<!--          <tr>-->
<!--            <td>Waga (kg)</td>-->
<!--            <td></td>-->
<!--            <td></td>-->
<!--            <td></td>-->
<!--            <td></td>-->
<!--            <td></td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>1</td>-->
<!--            <td>19,99zł</td>-->
<!--            <td>24,99zł</td>-->
<!--            <td>19,99zł</td>-->
<!--            <td>29,99zł</td>-->
<!--            <td>19,99zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>2</td>-->
<!--            <td>24,99zł</td>-->
<!--            <td>29,99zł</td>-->
<!--            <td>24,99zł</td>-->
<!--            <td>39,99zł</td>-->
<!--            <td>19,99zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>3</td>-->
<!--            <td>24,99zł</td>-->
<!--            <td>29,99zł</td>-->
<!--            <td>24,99zł</td>-->
<!--            <td>39,99zł</td>-->
<!--            <td>19,99zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>5</td>-->
<!--            <td>24,99zł</td>-->
<!--            <td>29,99zł</td>-->
<!--            <td>29,99zł</td>-->
<!--            <td>39,99zł</td>-->
<!--            <td>24,99zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>10</td>-->
<!--            <td>29,99zł</td>-->
<!--            <td>39,99zł</td>-->
<!--            <td>44,99zł</td>-->
<!--            <td>44,99zł</td>-->
<!--            <td>34,99zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>15</td>-->
<!--            <td>34,99zł</td>-->
<!--            <td>49,99zł</td>-->
<!--            <td>54,99zł</td>-->
<!--            <td>49,99zł</td>-->
<!--            <td>44,99zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>20</td>-->
<!--            <td>39,99zł</td>-->
<!--            <td>54,99zł</td>-->
<!--            <td>59,99zł</td>-->
<!--            <td>54,99zł</td>-->
<!--            <td>49,99zł</td>-->
<!--          </tr>-->
<!--          </tbody>-->
<!--        </table>-->

<!--        <p class="priceList_infoTxt">Usługa COD (przesyłka za pobraniem) w dostawie do punktu dostępna wyłącznie dla paczek do 5 kg.</p>-->

<!--        <p class="priceList_infoTxt">Koszt przesyłki pobraniowej na obecnie dostępnych kierunkach:</p>-->
<!--        <ul>-->
<!--          <li>Niemcy - 34,99 zł netto</li>-->
<!--          <li>Czechy - 9,99 zł netto</li>-->
<!--          <li>Słowacja - 9,99 zł netto</li>-->
<!--          <li>Rumunia - 5,99 zł netto</li>-->
<!--          <li>Węgry - 9,99 zł netto</li>-->
<!--        </ul>-->

<!--        <p class="priceList_infoTxt">Ważne! Kwota pobrania powinna być wpisana w walucie kraju docelowego (bez przeliczania na PLN).</p>-->
<!--      </div>-->

<!--      <div class="row">-->
<!--        <table class="priceList_table">-->
<!--          <thead>-->
<!--          <tr>-->
<!--            <th>Kraj</th>-->
<!--            <th>Maksymalne wymiary</th>-->
<!--          </tr>-->
<!--          </thead>-->
<!--          <tbody>-->
<!--          <tr>-->
<!--            <td>Bułgaria</td>-->
<!--            <td>61 x 44 x 37 cm</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Czechy</td>-->
<!--            <td>60 x 43 x 43 cm</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Rumunia</td>-->
<!--            <td>60 x 50 x 41 cm</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Słowenia</td>-->
<!--            <td>51 x 42 x 39 cm</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Chorwacja</td>-->
<!--            <td>51 x 42 x 39 cm</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Słowacja</td>-->
<!--            <td>Max. obwód 300 cm | L + 2*H + 2*W max 300; max dł.: 200 cm</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Węgry</td>-->
<!--            <td>47 x 44 x 39 cm</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Niemcy 1</td>-->
<!--            <td>*75 x 60 x 40 cm (uwaga: zależne od dostępności skrzynek)</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Niemcy 2</td>-->
<!--            <td>120 x 60 x 60 cm</td>-->
<!--          </tr>-->
<!--          </tbody>-->
<!--        </table>-->
<!--      </div>-->

<!--      <div class="row">-->
<!--        <table class="priceList_table">-->
<!--          <thead>-->
<!--          <tr>-->
<!--            <th colspan="9">Cross Border - Dostawa do drzwi (Home Delivery)</th>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <th>Kraj</th>-->
<!--            <th>Niemcy</th>-->
<!--            <th>Holandia</th>-->
<!--            <th>Belgia</th>-->
<!--            <th>Francja</th>-->
<!--            <th>Austria</th>-->
<!--            <th>Czechy</th>-->
<!--            <th>Słowacja</th>-->
<!--            <th>Słowenia</th>-->
<!--          </tr>-->
<!--          </thead>-->
<!--          <tbody>-->
<!--          <tr>-->
<!--            <td>1 kg</td>-->
<!--            <td>19,49zł</td>-->
<!--            <td>33,49zł</td>-->
<!--            <td>34,49zł</td>-->
<!--            <td>30,49zł</td>-->
<!--            <td>28,49zł</td>-->
<!--            <td>19,49zł</td>-->
<!--            <td>19,49zł</td>-->
<!--            <td>19,49zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>2 kg</td>-->
<!--            <td>19,49zł</td>-->
<!--            <td>33,49zł</td>-->
<!--            <td>34,49zł</td>-->
<!--            <td>33,49zł</td>-->
<!--            <td>30,49zł</td>-->
<!--            <td>19,49zł</td>-->
<!--            <td>19,49zł</td>-->
<!--            <td>19,49zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>3 kg</td>-->
<!--            <td>19,49zł</td>-->
<!--            <td>33,49zł</td>-->
<!--            <td>34,49zł</td>-->
<!--            <td>35,49zł</td>-->
<!--            <td>31,49zł</td>-->
<!--            <td>19,49zł</td>-->
<!--            <td>19,49zł</td>-->
<!--            <td>21,49zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>5 kg</td>-->
<!--            <td>20,49zł</td>-->
<!--            <td>39,49zł</td>-->
<!--            <td>35,49zł</td>-->
<!--            <td>45,49zł</td>-->
<!--            <td>34,49zł</td>-->
<!--            <td>19,49zł</td>-->
<!--            <td>19,49zł</td>-->
<!--            <td>22,49zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>10 kg</td>-->
<!--            <td>22,49zł</td>-->
<!--            <td>39,49zł</td>-->
<!--            <td>44,49zł</td>-->
<!--            <td>49,49zł</td>-->
<!--            <td>34,49zł</td>-->
<!--            <td>24,49zł</td>-->
<!--            <td>24,49zł</td>-->
<!--            <td>29,49zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>15 kg</td>-->
<!--            <td>22,49zł</td>-->
<!--            <td>42,49zł</td>-->
<!--            <td>49,49zł</td>-->
<!--            <td>68,49zł</td>-->
<!--            <td>40,49zł</td>-->
<!--            <td>24,49zł</td>-->
<!--            <td>29,49zł</td>-->
<!--            <td>34,49zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>20 kg</td>-->
<!--            <td>22,49zł</td>-->
<!--            <td>42,49zł</td>-->
<!--            <td>49,49zł</td>-->
<!--            <td>68,49zł</td>-->
<!--            <td>42,49zł</td>-->
<!--            <td>24,49zł</td>-->
<!--            <td>29,49zł</td>-->
<!--            <td>39,49zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>25 kg</td>-->
<!--            <td>22,49zł</td>-->
<!--            <td>44,49zł</td>-->
<!--            <td>49,49zł</td>-->
<!--            <td>68,49zł</td>-->
<!--            <td>44,49zł</td>-->
<!--            <td>25,49zł</td>-->
<!--            <td>29,49zł</td>-->
<!--            <td>44,49zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>30 kg</td>-->
<!--            <td>22,49zł</td>-->
<!--            <td>44,49zł</td>-->
<!--            <td>49,49zł</td>-->
<!--            <td>68,49zł</td>-->
<!--            <td>44,49zł</td>-->
<!--            <td>29,49zł</td>-->
<!--            <td>30,49zł</td>-->
<!--            <td>49,49zł</td>-->
<!--          </tr>-->
<!--          </tbody>-->
<!--        </table>-->
<!--      </div>-->

<!--      <div class="row">-->
<!--        <table class="priceList_table">-->
<!--          <thead>-->
<!--          <tr>-->
<!--            <th colspan="9">Cross Border - Dostawa do drzwi (Home Delivery)</th>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <th>Kraj</th>-->
<!--            <th>Włochy</th>-->
<!--            <th>Dania</th>-->
<!--            <th>Węgry</th>-->
<!--            <th>Luksemburg</th>-->
<!--            <th>Chorwacja</th>-->
<!--            <th>Szwecja</th>-->
<!--            <th>Finlandia</th>-->
<!--            <th>Hiszpania</th>-->
<!--          </tr>-->
<!--          </thead>-->
<!--          <tbody>-->
<!--          <tr>-->
<!--            <td>1 kg</td>-->
<!--            <td>29,49zł</td>-->
<!--            <td>35,49zł</td>-->
<!--            <td>19,49zł</td>-->
<!--            <td>34,49zł</td>-->
<!--            <td>29,49zł</td>-->
<!--            <td>44,49zł</td>-->
<!--            <td>49,49zł</td>-->
<!--            <td>39,49zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>2 kg</td>-->
<!--            <td>29,49zł</td>-->
<!--            <td>35,49zł</td>-->
<!--            <td>19,49zł</td>-->
<!--            <td>39,49zł</td>-->
<!--            <td>29,49zł</td>-->
<!--            <td>49,49zł</td>-->
<!--            <td>49,49zł</td>-->
<!--            <td>44,49zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>3 kg</td>-->
<!--            <td>29,49zł</td>-->
<!--            <td>44,49zł</td>-->
<!--            <td>19,49zł</td>-->
<!--            <td>44,49zł</td>-->
<!--            <td>34,49zł</td>-->
<!--            <td>49,49zł</td>-->
<!--            <td>49,49zł</td>-->
<!--            <td>54,49zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>5 kg</td>-->
<!--            <td>30,49zł</td>-->
<!--            <td>49,49zł</td>-->
<!--            <td>21,49zł</td>-->
<!--            <td>44,49zł</td>-->
<!--            <td>39,49zł</td>-->
<!--            <td>49,49zł</td>-->
<!--            <td>49,49zł</td>-->
<!--            <td>54,49zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>10 kg</td>-->
<!--            <td>49,49zł</td>-->
<!--            <td>59,49zł</td>-->
<!--            <td>24,49zł</td>-->
<!--            <td>44,49zł</td>-->
<!--            <td>54,49zł</td>-->
<!--            <td>49,49zł</td>-->
<!--            <td>49,49zł</td>-->
<!--            <td>54,49zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>15 kg</td>-->
<!--            <td>54,49zł</td>-->
<!--            <td>59,49zł</td>-->
<!--            <td>29,49zł</td>-->
<!--            <td>44,49zł</td>-->
<!--            <td>54,49zł</td>-->
<!--            <td>49,49zł</td>-->
<!--            <td>54,49zł</td>-->
<!--            <td>54,49zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>20 kg</td>-->
<!--            <td>54,49zł</td>-->
<!--            <td>59,49zł</td>-->
<!--            <td>34,49zł</td>-->
<!--            <td>44,49zł</td>-->
<!--            <td>54,49zł</td>-->
<!--            <td>49,49zł</td>-->
<!--            <td>54,49zł</td>-->
<!--            <td>54,49zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>25 kg</td>-->
<!--            <td>59,49zł</td>-->
<!--            <td>59,49zł</td>-->
<!--            <td>39,49zł</td>-->
<!--            <td>49,49zł</td>-->
<!--            <td>59,49zł</td>-->
<!--            <td>54,49zł</td>-->
<!--            <td>59,49zł</td>-->
<!--            <td>59,49zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>30 kg</td>-->
<!--            <td>59,49zł</td>-->
<!--            <td>59,49zł</td>-->
<!--            <td>44,49zł</td>-->
<!--            <td>49,49zł</td>-->
<!--            <td>59,49zł</td>-->
<!--            <td>54,49zł</td>-->
<!--            <td>59,49zł</td>-->
<!--            <td>59,49zł</td>-->
<!--          </tr>-->
<!--          </tbody>-->
<!--        </table>-->
<!--      </div>-->

<!--      <div class="row">-->
<!--        <table class="priceList_table">-->
<!--          <thead>-->
<!--          <tr>-->
<!--            <th colspan="9">Cross Border - Dostawa do drzwi (Home Delivery)</th>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <th>Kraj</th>-->
<!--            <th>Portugalia</th>-->
<!--            <th>Bułgaria</th>-->
<!--            <th>Rumunia</th>-->
<!--            <th>Grecja</th>-->
<!--            <th>Litwa</th>-->
<!--            <th>Łotwa</th>-->
<!--            <th>Estonia</th>-->
<!--          </tr>-->
<!--          </thead>-->
<!--          <tbody>-->
<!--          <tr>-->
<!--            <td>1 kg</td>-->
<!--            <td>34,49zł</td>-->
<!--            <td>20,49zł</td>-->
<!--            <td>19,49zł</td>-->
<!--            <td>24,49zł</td>-->
<!--            <td>19,49zł</td>-->
<!--            <td>19,49zł</td>-->
<!--            <td>24,49zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>2 kg</td>-->
<!--            <td>39,49zł</td>-->
<!--            <td>20,49zł</td>-->
<!--            <td>19,49zł</td>-->
<!--            <td>24,49zł</td>-->
<!--            <td>19,49zł</td>-->
<!--            <td>19,49zł</td>-->
<!--            <td>24,49zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>3 kg</td>-->
<!--            <td>59,49zł</td>-->
<!--            <td>29,49zł</td>-->
<!--            <td>19,49zł</td>-->
<!--            <td>34,49zł</td>-->
<!--            <td>19,49zł</td>-->
<!--            <td>19,49zł</td>-->
<!--            <td>24,49zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>5 kg</td>-->
<!--            <td>59,49zł</td>-->
<!--            <td>29,49zł</td>-->
<!--            <td>19,49zł</td>-->
<!--            <td>45,49zł</td>-->
<!--            <td>21,49zł</td>-->
<!--            <td>20,49zł</td>-->
<!--            <td>29,49zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>10 kg</td>-->
<!--            <td>64,49zł</td>-->
<!--            <td>44,49zł</td>-->
<!--            <td>54,49zł</td>-->
<!--            <td>74,49zł</td>-->
<!--            <td>25,49zł</td>-->
<!--            <td>30,49zł</td>-->
<!--            <td>34,99zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>15 kg</td>-->
<!--            <td>64,49zł</td>-->
<!--            <td>44,49zł</td>-->
<!--            <td>54,49zł</td>-->
<!--            <td>74,49zł</td>-->
<!--            <td>39,49zł</td>-->
<!--            <td>44,49zł</td>-->
<!--            <td>44,49zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>20 kg</td>-->
<!--            <td>64,49zł</td>-->
<!--            <td>44,49zł</td>-->
<!--            <td>54,49zł</td>-->
<!--            <td>74,49zł</td>-->
<!--            <td>39,49zł</td>-->
<!--            <td>44,49zł</td>-->
<!--            <td>44,49zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>25 kg</td>-->
<!--            <td>64,49zł</td>-->
<!--            <td>44,49zł</td>-->
<!--            <td>54,49zł</td>-->
<!--            <td>79,49zł</td>-->
<!--            <td>44,49zł</td>-->
<!--            <td>44,49zł</td>-->
<!--            <td>44,99zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>30 kg</td>-->
<!--            <td>64,49zł</td>-->
<!--            <td>44,49zł</td>-->
<!--            <td>54,49zł</td>-->
<!--            <td>79,49zł</td>-->
<!--            <td>44,49zł</td>-->
<!--            <td>44,49zł</td>-->
<!--            <td>44,99zł</td>-->
<!--          </tr>-->
<!--          </tbody>-->
<!--        </table>-->

<!--        <div>-->
<!--          <p class="priceList_infoTxt">Uwaga:</p>-->
<!--          <p class="priceList_infoTxt">Aby skorzystać z cenników indywidualnych, dopasowanych do Twoich potrzeb, napisz na oferta@blpaczka.com</p>-->
<!--        </div>-->
<!--      </div>-->

<!--      <div class="row">-->
<!--        <table class="priceList_table">-->
<!--          <thead>-->
<!--          <tr>-->
<!--            <th colspan="3">Orientacyjny czas dostawy i wymiary maksymalne:</th>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <th>Kraj</th>-->
<!--            <th>Orientacyjny czas dostawy (dni)</th>-->
<!--            <th>Max. Wymiary (cm)</th>-->
<!--            <th>Max. obwód D+2x(SZER+WYS)</th>-->
<!--          </tr>-->
<!--          </thead>-->
<!--          <tbody>-->
<!--          <tr>-->
<!--            <td>Niemcy</td>-->
<!--            <td>1</td>-->
<!--            <td>120/60/60</td>-->
<!--            <td>300</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Holandia</td>-->
<!--            <td>3</td>-->
<!--            <td>120/60/60</td>-->
<!--            <td>300</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Belgia</td>-->
<!--            <td>3</td>-->
<!--            <td>120/60/60</td>-->
<!--            <td>300</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Francja</td>-->
<!--            <td>3</td>-->
<!--            <td>120/60/60</td>-->
<!--            <td>300</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Austria</td>-->
<!--            <td>2</td>-->
<!--            <td>120/60/60</td>-->
<!--            <td>300</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Czechy</td>-->
<!--            <td>2</td>-->
<!--            <td>120/60/60</td>-->
<!--            <td>300</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Słowacja</td>-->
<!--            <td>2</td>-->
<!--            <td>120/60/60</td>-->
<!--            <td>300</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Słowenia</td>-->
<!--            <td>3</td>-->
<!--            <td>120/60/60</td>-->
<!--            <td>300</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Włochy</td>-->
<!--            <td>3</td>-->
<!--            <td>120/60/60</td>-->
<!--            <td>300</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Dania</td>-->
<!--            <td>3</td>-->
<!--            <td>120/60/60</td>-->
<!--            <td>300</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Węgry</td>-->
<!--            <td>3</td>-->
<!--            <td>120/60/60</td>-->
<!--            <td>300</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Luksemburg</td>-->
<!--            <td>3</td>-->
<!--            <td>120/60/60</td>-->
<!--            <td>300</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Chorwacja</td>-->
<!--            <td>3</td>-->
<!--            <td>120/60/60</td>-->
<!--            <td>300</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Szwecja</td>-->
<!--            <td>3</td>-->
<!--            <td>120/60/60</td>-->
<!--            <td>300</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Finlandia</td>-->
<!--            <td>4</td>-->
<!--            <td>120/60/60</td>-->
<!--            <td>300</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Hiszpania</td>-->
<!--            <td>4</td>-->
<!--            <td>120/60/60</td>-->
<!--            <td>300</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Portugalia</td>-->
<!--            <td>5</td>-->
<!--            <td>120/60/60</td>-->
<!--            <td>300</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Bułgaria</td>-->
<!--            <td>3</td>-->
<!--            <td>120/60/60</td>-->
<!--            <td>300</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Rumunia</td>-->
<!--            <td>3</td>-->
<!--            <td>120/60/60</td>-->
<!--            <td>300</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Grecja</td>-->
<!--            <td>4</td>-->
<!--            <td>120/60/60</td>-->
<!--            <td>300</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Litwa</td>-->
<!--            <td>3</td>-->
<!--            <td>120/60/60</td>-->
<!--            <td>300</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Łotwa</td>-->
<!--            <td>3</td>-->
<!--            <td>120/60/60</td>-->
<!--            <td>300</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Estonia</td>-->
<!--            <td>3</td>-->
<!--            <td>120/60/60</td>-->
<!--            <td>300</td>-->
<!--          </tr>-->
<!--          </tbody>-->
<!--        </table>-->
<!--      </div>-->

<!--      <div class="row">-->
<!--        <table class="priceList_table">-->
<!--          <thead>-->
<!--          <tr>-->
<!--            <th></th>-->
<!--            <th>Niemcy</th>-->
<!--            <th>Holandia</th>-->
<!--            <th>Belgia</th>-->
<!--            <th>Francja</th>-->
<!--            <th>Austria</th>-->
<!--            <th>Czechy</th>-->
<!--            <th>Słowacja</th>-->
<!--            <th>Słowenia</th>-->
<!--            <th>Włochy</th>-->
<!--            <th>Dania</th>-->
<!--            <th>Węgry</th>-->
<!--            <th>Luksemburg</th>-->
<!--          </tr>-->
<!--          </thead>-->
<!--          <tbody>-->
<!--          <tr>-->
<!--            <td>NIESTANDARD</td>-->
<!--            <td>141,00 zł</td>-->
<!--            <td>141,00 zł</td>-->
<!--            <td>141,00 zł</td>-->
<!--            <td>141,00 zł</td>-->
<!--            <td>141,00 zł</td>-->
<!--            <td>141,00 zł</td>-->
<!--            <td>141,00 zł</td>-->
<!--            <td>141,00 zł</td>-->
<!--            <td>141,00 zł</td>-->
<!--            <td>141,00 zł</td>-->
<!--            <td>141,00 zł</td>-->
<!--            <td>141,00 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>COD (Pobranie) tylko do 5kg</td>-->
<!--            <td>34,99 zł</td>-->
<!--            <td>34,99 zł</td>-->
<!--            <td>34,99 zł</td>-->
<!--            <td>34,99 zł</td>-->
<!--            <td>34,99 zł</td>-->
<!--            <td>9,99 zł</td>-->
<!--            <td>9,99 zł</td>-->
<!--            <td>9,99 zł</td>-->
<!--            <td>9,99 zł</td>-->
<!--            <td>9,99 zł</td>-->
<!--            <td>9,99 zł</td>-->
<!--            <td>9,99 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Maksymalna kwota COD</td>-->
<!--            <td>3500 EUR</td>-->
<!--            <td>3500 EUR</td>-->
<!--            <td>3500 EUR</td>-->
<!--            <td>3500 EUR</td>-->
<!--            <td>3500 EUR</td>-->
<!--            <td>50 000 CZK</td>-->
<!--            <td>830 EUR</td>-->
<!--            <td>500 EUR</td>-->
<!--            <td>500 EUR</td>-->
<!--            <td>100 000 Ft</td>-->
<!--            <td>100 000 Ft</td>-->
<!--            <td>3500 EUR</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>ZWROT NIEDORĘCZALNY</td>-->
<!--            <td>25,99 zł</td>-->
<!--            <td>25,99 zł</td>-->
<!--            <td>25,99 zł</td>-->
<!--            <td>25,99 zł</td>-->
<!--            <td>25,99 zł</td>-->
<!--            <td>25,99 zł</td>-->
<!--            <td>25,99 zł</td>-->
<!--            <td>25,99 zł</td>-->
<!--            <td>25,99 zł</td>-->
<!--            <td>25,99 zł</td>-->
<!--            <td>25,99 zł</td>-->
<!--            <td>25,99 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Dopłata strefowa</td>-->
<!--            <td>23,99 zł</td>-->
<!--            <td>23,99 zł</td>-->
<!--            <td>23,99 zł</td>-->
<!--            <td>23,99 zł</td>-->
<!--            <td>23,99 zł</td>-->
<!--            <td>0,99 zł</td>-->
<!--            <td>0,99 zł</td>-->
<!--            <td>0,99 zł</td>-->
<!--            <td>0,99 zł</td>-->
<!--            <td>0,99 zł</td>-->
<!--            <td>0,99 zł</td>-->
<!--            <td>23,99 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Opłata sezonowa (10-12)</td>-->
<!--            <td>0,99 zł</td>-->
<!--            <td>0,99 zł</td>-->
<!--            <td>0,99 zł</td>-->
<!--            <td>0,99 zł</td>-->
<!--            <td>0,99 zł</td>-->
<!--            <td>0,99 zł</td>-->
<!--            <td>0,99 zł</td>-->
<!--            <td>0,99 zł</td>-->
<!--            <td>0,99 zł</td>-->
<!--            <td>0,99 zł</td>-->
<!--            <td>0,99 zł</td>-->
<!--            <td>0,99 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Zaniżenie wagi paczki</td>-->
<!--            <td>9,99 zł</td>-->
<!--            <td>9,99 zł</td>-->
<!--            <td>9,99 zł</td>-->
<!--            <td>9,99 zł</td>-->
<!--            <td>9,99 zł</td>-->
<!--            <td>9,99 zł</td>-->
<!--            <td>9,99 zł</td>-->
<!--            <td>9,99 zł</td>-->
<!--            <td>9,99 zł</td>-->
<!--            <td>9,99 zł</td>-->
<!--            <td>9,99 zł</td>-->
<!--            <td>9,99 zł</td>-->
<!--          </tr>-->
<!--          </tbody>-->
<!--        </table>-->
<!--      </div>-->

<!--      <div class="row">-->
<!--        <table class="priceList_table">-->
<!--          <thead>-->
<!--          <tr>-->
<!--            <th></th>-->
<!--            <th>Chorwacja</th>-->
<!--            <th>Szwecja</th>-->
<!--            <th>Finlandia</th>-->
<!--            <th>Hiszpania</th>-->
<!--            <th>Portugalia</th>-->
<!--            <th>Bułgaria</th>-->
<!--            <th>Rumunia</th>-->
<!--            <th>Grecja</th>-->
<!--            <th>Litwa</th>-->
<!--            <th>Łotwa</th>-->
<!--            <th>Estonia</th>-->
<!--          </tr>-->
<!--          </thead>-->
<!--          <tbody>-->
<!--          <tr>-->
<!--            <td>NIESTANDARD</td>-->
<!--            <td>141,00 zł</td>-->
<!--            <td>141,00 zł</td>-->
<!--            <td>141,00 zł</td>-->
<!--            <td>141,00 zł</td>-->
<!--            <td>141,00 zł</td>-->
<!--            <td>141,00 zł</td>-->
<!--            <td>141,00 zł</td>-->
<!--            <td>141,00 zł</td>-->
<!--            <td>141,00 zł</td>-->
<!--            <td>141,00 zł</td>-->
<!--            <td>141,00 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>COD (Pobranie) tylko do 5kg</td>-->
<!--            <td>9,99 zł</td>-->
<!--            <td>9,99 zł</td>-->
<!--            <td>9,99 zł</td>-->
<!--            <td>9,99 zł</td>-->
<!--            <td>9,99 zł</td>-->
<!--            <td>9,99 zł</td>-->
<!--            <td>9,99 zł</td>-->
<!--            <td>9,99 zł</td>-->
<!--            <td>9,99 zł</td>-->
<!--            <td>9,99 zł</td>-->
<!--            <td>9,99 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Maksymalna kwota COD</td>-->
<!--            <td>1650 EUR</td>-->
<!--            <td>1650 EUR</td>-->
<!--            <td>1650 EUR</td>-->
<!--            <td>1650 EUR</td>-->
<!--            <td>1650 EUR</td>-->
<!--            <td>5000 BGN</td>-->
<!--            <td>5000 lei</td>-->
<!--            <td>1500 EUR</td>-->
<!--            <td>1500 EUR</td>-->
<!--            <td>1500 EUR</td>-->
<!--            <td>1500 EUR</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>ZWROT NIEDORĘCZALNY</td>-->
<!--            <td>25,99 zł</td>-->
<!--            <td>25,99 zł</td>-->
<!--            <td>25,99 zł</td>-->
<!--            <td>25,99 zł</td>-->
<!--            <td>25,99 zł</td>-->
<!--            <td>25,99 zł</td>-->
<!--            <td>25,99 zł</td>-->
<!--            <td>25,99 zł</td>-->
<!--            <td>25,99 zł</td>-->
<!--            <td>25,99 zł</td>-->
<!--            <td>25,99 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Dopłata strefowa</td>-->
<!--            <td>0,99 zł</td>-->
<!--            <td>0,99 zł</td>-->
<!--            <td>0,99 zł</td>-->
<!--            <td>0,99 zł</td>-->
<!--            <td>0,99 zł</td>-->
<!--            <td>0,99 zł</td>-->
<!--            <td>0,99 zł</td>-->
<!--            <td>0,99 zł</td>-->
<!--            <td>0,99 zł</td>-->
<!--            <td>0,99 zł</td>-->
<!--            <td>0,99 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Opłata sezonowa (10-12)</td>-->
<!--            <td>0,99 zł</td>-->
<!--            <td>0,99 zł</td>-->
<!--            <td>0,99 zł</td>-->
<!--            <td>0,99 zł</td>-->
<!--            <td>0,99 zł</td>-->
<!--            <td>0,99 zł</td>-->
<!--            <td>0,99 zł</td>-->
<!--            <td>0,99 zł</td>-->
<!--            <td>0,99 zł</td>-->
<!--            <td>0,99 zł</td>-->
<!--            <td>0,99 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Zaniżenie wagi paczki</td>-->
<!--            <td>9,99 zł</td>-->
<!--            <td>9,99 zł</td>-->
<!--            <td>9,99 zł</td>-->
<!--            <td>9,99 zł</td>-->
<!--            <td>9,99 zł</td>-->
<!--            <td>9,99 zł</td>-->
<!--            <td>9,99 zł</td>-->
<!--            <td>9,99 zł</td>-->
<!--            <td>9,99 zł</td>-->
<!--            <td>9,99 zł</td>-->
<!--            <td>9,99 zł</td>-->
<!--          </tr>-->
<!--          </tbody>-->
<!--        </table>-->

<!--        <p class="priceList_infoTxt">Adres zwrotny (zwrot) - klient wysyła na swój koszt przesyłkę do magazynu np. w Niemczech a sprzedawca ponosi koszt transportu z magazynu w Niemczech do magazynu w Zielonej Górze.</p>-->
<!--        <p class="priceList_infoTxt">Dostępne adresy do zwrotów:</p>-->
<!--      </div>-->

<!--      <div class="row">-->
<!--        <table class="priceList_table">-->
<!--          <thead>-->
<!--          <tr>-->
<!--            <th>Kraj</th>-->
<!--            <th>Adres</th>-->
<!--          </tr>-->
<!--          </thead>-->
<!--          <tbody>-->
<!--          <tr>-->
<!--            <td>Niemcy</td>-->
<!--            <td>CBL / 1048 / Merchant_ID<br>Forster str.12, 03172 Guben</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Rumunia</td>-->
<!--            <td>CBL / 1048 / Merchant_ID<br>Str. Săntion nr.702B, Hala C2, 417078 Săntion</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Węgry</td>-->
<!--            <td>PACTIC<br>Nádas utca 4, 2142 Nagytarcsa</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Włochy</td>-->
<!--            <td>CrossBorder Logistics / 1048 / Merchant_ID<br>c/o Suedtirol Post Gmbh, V. Righi 13, I-39100 Bozen – Bolzano</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Słowacja</td>-->
<!--            <td>PACTIC (Furgefutar.hu)<br>945 01 Komárno, P.O. BOX 5</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Słowenia</td>-->
<!--            <td>GLS HUB Slovenia – (Allpacka/Furgefutar váczlia za HU)<br>CBL / 1048 / Merchant_ID, 1000 Ljubljana, Cesta v Prod 84</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Austria</td>-->
<!--            <td>C/O MKB Global Mail & Freight GmbH / Pactic / CBL / 1048 / Merchant_ID<br>1220 Wien, Hosnedlgasse 8</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Bułgaria</td>-->
<!--            <td>PACTIC<br>бул. Липник 106, 7000 Русе</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Chorwacja</td>-->
<!--            <td>GLS HUB Croatia - (Allpacka/Furgefutar)<br>CBL / 1048 / Merchant_ID, 10255 Donji Stupnik, R-Stupnickie Skopovine 22</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Czechy</td>-->
<!--            <td>C/O Olza Logistic - PACTIC<br>CROSSBORDER LOGISTICS / 1048 / Merchant_ID, Karvinská 1897, 737 01 Český Těšín</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Francja</td>-->
<!--            <td>GL-NET / CBL / 1048 / Merchant_ID<br>7 rue du Meunier, 95729 Roissy CDG CEDEX</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Grecja</td>-->
<!--            <td>Pactic- GR HUB<br>CBL / 1048 / Merchant_ID, 19400 Athens, 8th KM Varis – Koropiou Avenue, Koropi</td>-->
<!--          </tr>-->
<!--          </tbody>-->
<!--        </table>-->
<!--      </div>-->

<!--      <div class="row">-->
<!--        <table class="priceList_table">-->
<!--          <thead>-->
<!--          <tr>-->
<!--            <th>Waga</th>-->
<!--            <th>Niemcy</th>-->
<!--            <th>Francja</th>-->
<!--            <th>Austria</th>-->
<!--            <th>Czechy</th>-->
<!--            <th>Słowacja</th>-->
<!--            <th>Słowenia</th>-->
<!--            <th>Włochy</th>-->
<!--            <th>Węgry</th>-->
<!--            <th>Chorwacja</th>-->
<!--            <th>Bułgaria</th>-->
<!--            <th>Rumunia</th>-->
<!--            <th>Grecja</th>-->
<!--          </tr>-->
<!--          </thead>-->
<!--          <tbody>-->
<!--          <tr>-->
<!--            <td>30kg</td>-->
<!--            <td>6,99 zł</td>-->
<!--            <td>49,99 zł</td>-->
<!--            <td>23,99 zł</td>-->
<!--            <td>14,99 zł</td>-->
<!--            <td>34,99 zł</td>-->
<!--            <td>81,99 zł</td>-->
<!--            <td>49,99 zł</td>-->
<!--            <td>34,99 zł</td>-->
<!--            <td>89,99 zł</td>-->
<!--            <td>69,99 zł</td>-->
<!--            <td>36,99 zł</td>-->
<!--            <td>139,99 zł</td>-->
<!--          </tr>-->
<!--          </tbody>-->
<!--        </table>-->

<!--        <p class="priceList_infoTxt">Zwrot konsumencki - przesyłka na etykiecie zwrotnej od klienta do sprzedawcy towaru. Koszt transportu ponosi sprzedawca.</p>-->
<!--      </div>-->

<!--      <div class="row">-->
<!--        <table class="priceList_table">-->
<!--          <thead>-->
<!--          <tr>-->
<!--            <th>Waga</th>-->
<!--            <th>Niemcy</th>-->
<!--            <th>Holandia</th>-->
<!--            <th>Belgia</th>-->
<!--            <th>Francja</th>-->
<!--            <th>Austria</th>-->
<!--            <th>Czechy</th>-->
<!--            <th>Słowacja</th>-->
<!--            <th>Słowenia</th>-->
<!--            <th>Włochy</th>-->
<!--            <th>Dania</th>-->
<!--            <th>Węgry</th>-->
<!--            <th>Luksemburg</th>-->
<!--          </tr>-->
<!--          </thead>-->
<!--          <tbody>-->
<!--          <tr>-->
<!--            <td>30 kg</td>-->
<!--            <td>29,99 zł</td>-->
<!--            <td>49,99 zł</td>-->
<!--            <td>49,99 zł</td>-->
<!--            <td>74,99 zł</td>-->
<!--            <td>49,99 zł</td>-->
<!--            <td>49,99 zł</td>-->
<!--            <td>49,99 zł</td>-->
<!--            <td>49,99 zł</td>-->
<!--            <td>74,99 zł</td>-->
<!--            <td>49,99 zł</td>-->
<!--            <td>49,99 zł</td>-->
<!--            <td>49,99 zł</td>-->
<!--          </tr>-->
<!--          </tbody>-->
<!--        </table>-->
<!--      </div>-->

<!--      <div class="row">-->
<!--        <table class="priceList_table">-->
<!--          <thead>-->
<!--          <tr>-->
<!--            <th>Waga</th>-->
<!--            <th>Chorwacja</th>-->
<!--            <th>Szwecja</th>-->
<!--            <th>Finlandia</th>-->
<!--            <th>Hiszpania</th>-->
<!--            <th>Portugalia</th>-->
<!--            <th>Bułgaria</th>-->
<!--            <th>Rumunia</th>-->
<!--            <th>Grecja</th>-->
<!--            <th>Litwa</th>-->
<!--            <th>Łotwa</th>-->
<!--            <th>Estonia</th>-->
<!--          </tr>-->
<!--          </thead>-->
<!--          <tbody>-->
<!--          <tr>-->
<!--            <td>30 kg</td>-->
<!--            <td>49,99 zł</td>-->
<!--            <td>49,99 zł</td>-->
<!--            <td>49,99 zł</td>-->
<!--            <td>49,99 zł</td>-->
<!--            <td>74,99 zł</td>-->
<!--            <td>49,99 zł</td>-->
<!--            <td>49,99 zł</td>-->
<!--            <td>74,99 zł</td>-->
<!--            <td>49,99 zł</td>-->
<!--            <td>49,99 zł</td>-->
<!--            <td>49,99 zł</td>-->
<!--          </tr>-->
<!--          </tbody>-->
<!--        </table>-->
<!--        <div>-->
<!--          <p class="priceList_infoTxt"><strong>Ważne! Kwota pobrania powinna być wpisana w walucie kraju docelowego (bez przeliczania na PLN).</strong></p>-->
<!--          <p class="priceList_infoTxt">Maksymalna kwota ubezpieczenia: 500 zł - jej koszt jest już uwzględniony w cenie bazowej usługi.</p>-->
<!--          <p class="priceList_infoTxt">Koszt przesyłki zwrotnej - 150% ceny bazowej, nie mniej niż 29,99 zł netto.</p>-->
<!--          <p class="priceList_infoTxt">Wzór na wagę objętościową w usłudze BLP Cross-Border: długość x szerokość x wysokość / 5000.</p>-->
<!--        </div>-->
<!--      </div>-->

<!--      <div class="row">-->
<!--        &lt;!&ndash;    NIEMCY!!!!!!!!!&ndash;&gt;-->
<!--        <div>-->
<!--          <h3>BLPaczka Cross-Border Przesyłka Economy do Niemiec</h3>-->
<!--          <p class="priceList_infoTxt"><strong>Cena: 9,99 zł netto</strong></p>-->
<!--          <p class="priceList_infoTxt">Specjalna cena dla przesyłek do 1 kg.</p>-->
<!--          <ul>-->
<!--            <li>Możliwe opakowania: karton, foliopak lub koperta.</li>-->
<!--            <li>Maksymalne wymiary: 35.3 x 25 x 5 cm</li>-->
<!--            <li>Minimalne wymiary: 7 x 10 x 0,1 cm</li>-->
<!--            <li>Doręczenia od poniedziałku do soboty</li>-->
<!--            <li>Dostępne śledzenie przesyłek</li>-->
<!--            <li>Prognozowany czas doręczenia - 5 dni roboczych</li>-->
<!--            <li>Brak ubezpieczenia przesyłki</li>-->
<!--          </ul>-->
<!--          <h4>Jak to działa?</h4>-->
<!--          <ol>-->
<!--            <li>Generujemy etykietę przewoźnika korkowego w danym kraju, następnie naklejamy ją na gotową paczkę z konkretnym zamówieniem.</li>-->
<!--            <li>Po przygotowaniu wszystkich zamówień danego dnia konsolidujemy paczki w jedno opakowanie zbiorcze. Ważne, żeby opakowanie zbiorcze było dodatkowo właściwie oznaczone – poprzez umieszczenie na nim liter „K”. Umieszczenie tego symbolu na bokach opakowania zagwarantuje zachowanie prawidłowego procesu sortowania.</li>-->
<!--            <li>Przez system send.blpaczka.com lub BaseLinker zamawiamy dowolnego kuriera krajowego, wskazując jako adres odbiorcy następujące dane: CBLlog, ul. Generała Józefa Sowińskiego 42A, 65-419 Zielona Góra</li>-->
<!--            <li>Na miejscu opakowanie zbiorcze jest otwierane a przesyłki zagraniczne sortowane i wysyłane w dalszą trasę do Niemiec.</li>-->
<!--          </ol>-->
<!--          <h4>Opłaty dodatkowe:</h4>-->
<!--          <table class="priceList_table">-->
<!--            <tr>-->
<!--              <td>Niestandard</td>-->
<!--              <td>141,00zł</td>-->
<!--            </tr>-->
<!--            <tr>-->
<!--              <td>Zwrot niedoręczalny</td>-->
<!--              <td>5,50 EUR</td>-->
<!--            </tr>-->
<!--          </table>-->
<!--        </div>-->
<!--      </div>-->




<!--    </div>-->
<!--  </div>-->

</template>

<style scoped>

</style>