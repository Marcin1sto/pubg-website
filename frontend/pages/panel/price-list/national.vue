<script setup lang="ts">
import usePageStore from "~/stores/usePageStore";

const {t} = useI18n();
const {setPageValues} = usePageStore();

setPageValues(
    t('page.panel.price-list.national.title'),
);

useHead({
  title: t('page.panel.price-list.national.title')
});

definePageMeta({
  middleware: 'auth',
  layout: 'panel',
})
</script>

<template>
<!--  <div class="panel_mainContainer">-->
<!--    <div class="priceList_panel">-->
<!--      <div class="priceList_header">Cennik BLPaczka dla paczek do 31,5 kg</div>-->
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

<!--        <h2 class="priceList_contentHeader">Dostawa do punktu/automatu Point Delivery)</h2>-->

<!--        <table class="priceList_table">-->
<!--          <tr class="priceList_tableRow">-->
<!--            <th class="priceList_tableHeader"></th>-->
<!--            <th class="priceList_tableHeader">-->
<!--              &lt;!&ndash;                <NuxtImg src="images/priceList/inPostCennik.png" class="footer_logo"/>&ndash;&gt;-->
<!--              inPost Paczkomat Ekonomiczna-->
<!--            </th>-->
<!--            <th class="priceList_tableHeader">Maksymalna waga</th>-->
<!--          </tr>-->

<!--          <tr>-->
<!--            <th class="priceList_tableHeader">Gabaryt A</th>-->
<!--            <td class="priceList_tableCell">7,99 zł</td>-->
<!--            <td class="priceList_tableCell">do 0.5kg</td>-->
<!--          </tr>-->

<!--          <tr>-->
<!--            <th class="priceList_tableHeader">Gabaryt B</th>-->
<!--            <td class="priceList_tableCell">7,99 zł</td>-->
<!--            <td class="priceList_tableCell">do 3kg</td>-->
<!--          </tr>-->

<!--          <tr>-->
<!--            <th class="priceList_tableHeader">Gabaryt C</th>-->
<!--            <td class="priceList_tableCell">7,99 zł</td>-->
<!--            <td class="priceList_tableCell">do 10kg</td>-->
<!--          </tr>-->
<!--        </table>-->

<!--        <div class="row row&#45;&#45;alignBaseline">-->
<!--          <span class="priceList_infoTxt">Ceny obowiązują od 8 maja br. do odwołania.</span>-->
<!--          <button class="form_buttonSecondary ">Eksportuj cennik</button>-->
<!--        </div>-->

<!--        <table class="priceList_table">-->
<!--          <tr class="priceList_tableRow">-->
<!--            <th class="priceList_tableHeader"></th>-->
<!--            <th class="priceList_tableHeader">-->
<!--              &lt;!&ndash;                <NuxtImg src="images/priceList/inPostCennik.png" class="footer_logo"/>&ndash;&gt;-->
<!--              inPost Paczkomat-->
<!--            </th>-->
<!--            <th class="priceList_tableHeader"></th>-->
<!--            <th class="priceList_tableHeader"></th>-->
<!--          </tr>-->

<!--          <tr>-->
<!--            <td class="priceList_tableHeader"></td>-->
<!--            <td class="priceList_tableCellHeader">Użytkownik platformy BaseLinker <br> nadający > 1000 przesyłek-->
<!--              miesięcznie-->
<!--            </td>-->
<!--            <td class="priceList_tableCellHeader">Użytkownik platformy BaseLinker <br> nadający < 1000 przesyłek-->
<!--              miesięcznie-->
<!--            </td>-->
<!--            <td class="priceList_tableCellHeader">Użytkownik nadający przesyłki bezpośrednio <br> w serwisie-->
<!--              blpaczka.com-->
<!--            </td>-->
<!--          </tr>-->

<!--          <tr>-->
<!--            <th class="priceList_tableHeader">Gabaryt A</th>-->
<!--            <td class="priceList_tableCell">9,99 zł</td>-->
<!--            <td class="priceList_tableCell">10,49 zł</td>-->
<!--            <td class="priceList_tableCell">10,99 zł</td>-->
<!--          </tr>-->

<!--          <tr>-->
<!--            <th class="priceList_tableHeader">Gabaryt B</th>-->
<!--            <td class="priceList_tableCell">10,99 zł</td>-->
<!--            <td class="priceList_tableCell">11,49 zł</td>-->
<!--            <td class="priceList_tableCell">11,99 zł</td>-->
<!--          </tr>-->

<!--          <tr>-->
<!--            <th class="priceList_tableHeader">Gabaryt C</th>-->
<!--            <td class="priceList_tableCell">11,99 zł</td>-->
<!--            <td class="priceList_tableCell">12,49 zł</td>-->
<!--            <td class="priceList_tableCell">12,99 zł</td>-->
<!--          </tr>-->
<!--        </table>-->

<!--        <div class="row row&#45;&#45;alignBaseline">-->
<!--            <span class="priceList_infoTxt">INFO: Dodatkowe informacje dotyczące realizacji usługi InPost Paczkomat® Paczka Ekonomiczna są dostępne w FAQ. -->
<!--Liczba paczek nadanych w danym miesiącu dotyczy wszystkich paczek od wszystkich przewoźników w tym również Allegro Smart.-->
<!--Prawo do ceny jak w przypadku "Użytkownik platformy BaseLinker nadający miesięcznie ≥ 1000paczek nabywane jest w miesiącu poprzednim i obowiązuje w pełnym kolejnym miesiącu</span>-->
<!--          <button class="form_buttonSecondary ">Eksportuj cennik</button>-->
<!--        </div>-->
<!--      </div>-->
<!--    </div>-->
<!--  </div>-->

<!--  <div class="panel_mainContainer">-->
<!--    <div class="priceList_panel">-->
<!--      <div class="priceList_content">-->
<!--        <h2 class="priceList_contentHeader">Dostawa do punktu/automatu (Point Delivery)</h2>-->
<!--      </div>-->

<!--      <table class="priceList_table">-->
<!--        <thead>-->
<!--        <tr class="priceList_tableRow">-->
<!--          <th class="priceList_tableCellHeader" rowspan="2"></th>-->
<!--          <th class="priceList_tableCellHeader" colspan="1">-->
<!--            &lt;!&ndash;            <div class="priceList_tableLogoWrapper">&ndash;&gt;-->
<!--            &lt;!&ndash;              <NuxtImg src="images/kurierzyCenniki/inPost.png" width="51px" height="26px"/>&ndash;&gt;-->
<!--            &lt;!&ndash;            </div>&ndash;&gt;-->
<!--            InPost Paczkomat® Paczka Ekonomiczna-->
<!--          </th>-->
<!--          <th class="priceList_tableCellHeader" rowspan="2">Maksymalna waga</th>-->
<!--        </tr>-->
<!--        </thead>-->
<!--        <tbody>-->
<!--        <tr>-->
<!--          <td class="priceList_tableCellHeader">Gabaryt A</td>-->
<!--          <td class="priceList_tableCell" rowspan="3">7,99 zł</td>-->
<!--          <td class="priceList_tableCell">do 0,5 kg</td>-->
<!--        </tr>-->
<!--        <tr>-->
<!--          <td class="priceList_tableCellHeader">Gabaryt B</td>-->
<!--          <td class="priceList_tableCell">do 3 kg</td>-->
<!--        </tr>-->
<!--        <tr>-->
<!--          <td class="priceList_tableCellHeader">Gabaryt C</td>-->
<!--          <td class="priceList_tableCell">do 10 kg</td>-->
<!--        </tr>-->
<!--        </tbody>-->
<!--      </table>-->

<!--      <div class="row row&#45;&#45;alignBaseline">-->
<!--        <span class="priceList_infoTxt priceList_infoTxt&#45;&#45;small">Ceny obowiązujące od 8 maja br. do odwołania</span>-->
<!--        &lt;!&ndash;        <button class="form_buttonSecondary ">Eksportuj cennik</button>&ndash;&gt;-->
<!--      </div>-->

<!--      <div class="row">-->
<!--        <table class="priceList_table">-->
<!--          <thead>-->
<!--          <tr class="priceList_tableRow">-->
<!--            <th rowspan="2" class="priceList_tableCellHeader"></th>-->
<!--            <th colspan="3" class="priceList_tableCellHeader">InPost Paczkomat®</th>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <th class="priceList_tableCellHeader">Użytkownik platformy BaseLinker nadający ≥ 1000 przesyłek-->
<!--              miesięcznie-->
<!--            </th>-->
<!--            <th class="priceList_tableCellHeader">Użytkownik platformy BaseLinker nadający &lt; 1000 przesyłek-->
<!--              miesięcznie-->
<!--            </th>-->
<!--            <th class="priceList_tableCellHeader">Użytkownik nadający przesyłki bezpośrednio w serwisie blpaczka.com-->
<!--            </th>-->
<!--          </tr>-->
<!--          </thead>-->
<!--          <tbody>-->
<!--          <tr>-->
<!--            <td class="priceList_tableCellHeader">Gabaryt A</td>-->
<!--            <td class="priceList_tableCell">9,99 zł</td>-->
<!--            <td class="priceList_tableCell">10,49 zł</td>-->
<!--            <td class="priceList_tableCell">10,99 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td class="priceList_tableCellHeader">Gabaryt B</td>-->
<!--            <td class="priceList_tableCell">10,99 zł</td>-->
<!--            <td class="priceList_tableCell">11,49 zł</td>-->
<!--            <td class="priceList_tableCell">11,99 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td class="priceList_tableCellHeader">Gabaryt C</td>-->
<!--            <td class="priceList_tableCell">11,99 zł</td>-->
<!--            <td class="priceList_tableCell">12,49 zł</td>-->
<!--            <td class="priceList_tableCell">12,99 zł</td>-->
<!--          </tr>-->
<!--          </tbody>-->
<!--        </table>-->
<!--      </div>-->

<!--      <div class="row">-->
<!--        <p class="priceList_infoTxt"><strong>INFO:</strong> Dodatkowe informacje dotyczące realizacji usługi InPost-->
<!--          Paczkomat® Paczka Ekonomiczna są dostępne w <a href="#">FAQ</a>.-->
<!--          Liczba paczek nadanych w danym miesiącu dotyczy wszystkich paczek od wszystkich przewoźników w tym również-->
<!--          Allegro Smart.-->
<!--          Prawo do ceny jak w przypadku "Użytkownik platformy BaseLinker nadający miesięcznie ≥ 1000 paczek nabywane-->
<!--          jest w miesiącu poprzednim i obowiązuje w pełnym kolejnym miesiącu</p>-->
<!--      </div>-->

<!--      <div class="row">-->
<!--        <table class="priceList_table">-->
<!--          <thead>-->
<!--          <tr>-->
<!--            <th rowspan="2" class="priceList_tableCellHeader"></th>-->
<!--            <th colspan="4" class="priceList_tableCellHeader">ORLEN Paczka</th>-->
<!--            <th colspan="4" class="priceList_tableCellHeader">Pocztex</th>-->
<!--            <th rowspan="2" class="priceList_tableCellHeader">Uwagi</th>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <th class="priceList_tableCellHeader">Rozmiar S</th>-->
<!--            <th class="priceList_tableCellHeader">Rozmiar M</th>-->
<!--            <th class="priceList_tableCellHeader">Rozmiar L</th>-->
<!--            <th class="priceList_tableCellHeader">Rozmiar XL</th>-->
<!--            <th class="priceList_tableCellHeader">Rozmiar S</th>-->
<!--            <th class="priceList_tableCellHeader">Rozmiar M</th>-->
<!--            <th class="priceList_tableCellHeader">Rozmiar L</th>-->
<!--            <th class="priceList_tableCellHeader">Rozmiar XL</th>-->
<!--          </tr>-->
<!--          </thead>-->
<!--          <tbody>-->
<!--          <tr>-->
<!--            <td class="priceList_tableCell"></td>-->
<!--            <td class="priceList_tableCell">7,99 zł</td>-->
<!--            <td class="priceList_tableCell">7,99 zł</td>-->
<!--            <td class="priceList_tableCell">7,99 zł</td>-->
<!--            <td class="priceList_tableCell">7,99 zł</td>-->
<!--            <td class="priceList_tableCell">8,49 zł</td>-->
<!--            <td class="priceList_tableCell">8,99 zł</td>-->
<!--            <td class="priceList_tableCell">8,99 zł</td>-->
<!--            <td class="priceList_tableCell">16,49 zł</td>-->
<!--            <td class="priceList_tableCell">Nadanie w punkcie; max. waga 20 kg</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td class="priceList_tableCell"></td>-->
<!--            <td class="priceList_tableCell" colspan="4"></td>-->
<!--            <td class="priceList_tableCell">10,49 zł</td>-->
<!--            <td class="priceList_tableCell">10,49 zł</td>-->
<!--            <td class="priceList_tableCell">10,49 zł</td>-->
<!--            <td class="priceList_tableCell">18,99 zł</td>-->
<!--            <td class="priceList_tableCell">Odbiór przez kuriera; max. waga 20 kg</td>-->
<!--          </tr>-->
<!--          </tbody>-->
<!--        </table>-->
<!--      </div>-->

<!--      <div class="row">-->
<!--        <table class="priceList_table">-->
<!--          <thead>-->
<!--          <tr>-->
<!--            <th rowspan="2" class="priceList_tableCellHeader"></th>-->
<!--            <th colspan="7" class="priceList_tableCellHeader">DHL POP BOX</th>-->
<!--            <th rowspan="2" class="priceList_tableCellHeader">Uwagi</th>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <th class="priceList_tableCellHeader">do 1 kg</th>-->
<!--            <th class="priceList_tableCellHeader">do 5 kg</th>-->
<!--            <th class="priceList_tableCellHeader">do 10 kg</th>-->
<!--            <th class="priceList_tableCellHeader">do 15 kg</th>-->
<!--            <th class="priceList_tableCellHeader">do 20 kg</th>-->
<!--            <th class="priceList_tableCellHeader">do 25 kg</th>-->
<!--            <th class="priceList_tableCellHeader">do 31,5 kg</th>-->
<!--          </tr>-->
<!--          </thead>-->
<!--          <tbody>-->
<!--          <tr>-->
<!--            <td class="priceList_tableCell"></td>-->
<!--            <td class="priceList_tableCell">7,99 zł</td>-->
<!--            <td class="priceList_tableCell">7,99 zł</td>-->
<!--            <td class="priceList_tableCell">7,99 zł</td>-->
<!--            <td class="priceList_tableCell">12,99 zł</td>-->
<!--            <td class="priceList_tableCell">12,99 zł</td>-->
<!--            <td class="priceList_tableCell">12,99 zł</td>-->
<!--            <td class="priceList_tableCell">12,99 zł</td>-->
<!--            <td class="priceList_tableCell">Max. rozm. 41 x 38 x 64 cm</td>-->
<!--          </tr>-->
<!--          </tbody>-->
<!--        </table>-->
<!--      </div>-->

<!--      <div class="row">-->
<!--        <table class="priceList_table">-->
<!--          <thead>-->
<!--          <tr>-->
<!--            <th rowspan="2" class="priceList_tableCellHeader"></th>-->
<!--            <th colspan="7" class="priceList_tableCellHeader">DHL Service Point</th>-->
<!--            <th rowspan="2" class="priceList_tableCellHeader">Uwagi</th>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <th class="priceList_tableCellHeader">do 1 kg</th>-->
<!--            <th class="priceList_tableCellHeader">do 5 kg</th>-->
<!--            <th class="priceList_tableCellHeader">do 10 kg</th>-->
<!--            <th class="priceList_tableCellHeader">do 15 kg</th>-->
<!--            <th class="priceList_tableCellHeader">do 20 kg</th>-->
<!--            <th class="priceList_tableCellHeader">do 25 kg</th>-->
<!--            <th class="priceList_tableCellHeader">do 31,5 kg</th>-->
<!--          </tr>-->
<!--          </thead>-->
<!--          <tbody>-->
<!--          <tr>-->
<!--            <td class="priceList_tableCell"></td>-->
<!--            <td class="priceList_tableCell">7,99 zł</td>-->
<!--            <td class="priceList_tableCell">7,99 zł</td>-->
<!--            <td class="priceList_tableCell">7,99 zł</td>-->
<!--            <td class="priceList_tableCell">12,99 zł</td>-->
<!--            <td class="priceList_tableCell">12,99 zł</td>-->
<!--            <td class="priceList_tableCell">12,99 zł</td>-->
<!--            <td class="priceList_tableCell">12,99 zł</td>-->
<!--            <td class="priceList_tableCell">Max. rozm. 120 x 60 x 60 cm</td>-->
<!--          </tr>-->
<!--          </tbody>-->
<!--        </table>-->
<!--      </div>-->

<!--      <div class="row">-->
<!--        <table class="priceList_table">-->
<!--          <thead>-->
<!--          <tr>-->
<!--            <th rowspan="2" class="priceList_tableCellHeader"></th>-->
<!--            <th colspan="5" class="priceList_tableCellHeader">DPD</th>-->
<!--            <th colspan="5" class="priceList_tableCellHeader">FEDEX</th>-->
<!--            <th rowspan="2" class="priceList_tableCellHeader">Uwagi</th>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <th class="priceList_tableCellHeader">do 1 kg</th>-->
<!--            <th class="priceList_tableCellHeader">do 2 kg</th>-->
<!--            <th class="priceList_tableCellHeader">do 5 kg</th>-->
<!--            <th class="priceList_tableCellHeader">do 10 kg</th>-->
<!--            <th class="priceList_tableCellHeader">do 20 kg</th>-->
<!--            <th class="priceList_tableCellHeader">do 1 kg</th>-->
<!--            <th class="priceList_tableCellHeader">do 2 kg</th>-->
<!--            <th class="priceList_tableCellHeader">do 5 kg</th>-->
<!--            <th class="priceList_tableCellHeader">do 10 kg</th>-->
<!--            <th class="priceList_tableCellHeader">do 20 kg</th>-->
<!--          </tr>-->
<!--          </thead>-->
<!--          <tbody>-->
<!--          <tr>-->
<!--            <td class="priceList_tableCell"></td>-->
<!--            <td class="priceList_tableCell">8,99 zł</td>-->
<!--            <td class="priceList_tableCell">8,99 zł</td>-->
<!--            <td class="priceList_tableCell">8,99 zł</td>-->
<!--            <td class="priceList_tableCell">12,59 zł</td>-->
<!--            <td class="priceList_tableCell">12,59 zł</td>-->
<!--            <td class="priceList_tableCell">10,49 zł</td>-->
<!--            <td class="priceList_tableCell">10,79 zł</td>-->
<!--            <td class="priceList_tableCell">10,99 zł</td>-->
<!--            <td class="priceList_tableCell">12,99 zł</td>-->
<!--            <td class="priceList_tableCell">14,49 zł</td>-->
<!--            <td class="priceList_tableCell">Max. 20 kg</td>-->
<!--          </tr>-->
<!--          </tbody>-->
<!--        </table>-->
<!--      </div>-->

<!--      <div class="row">-->
<!--        <table class="priceList_table">-->
<!--          <thead>-->
<!--          <tr>-->
<!--            <th rowspan="2" class="priceList_tableCellHeader"></th>-->
<!--            <th colspan="3" class="priceList_tableCellHeader">InPost Kurier</th>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <th class="priceList_tableCellHeader">Użytkownik platformy BaseLinker nadający ≥ 1000 przesyłek-->
<!--              miesięcznie-->
<!--            </th>-->
<!--            <th class="priceList_tableCellHeader">Użytkownik platformy BaseLinker nadający &lt; 1000 przesyłek-->
<!--              miesięcznie-->
<!--            </th>-->
<!--            <th class="priceList_tableCellHeader">Użytkownik nadający przesyłki bezpośrednio w serwisie blpaczka.com-->
<!--            </th>-->
<!--          </tr>-->
<!--          </thead>-->
<!--          <tbody>-->
<!--          <tr>-->
<!--            <td class="priceList_tableCellHeader">do 10 kg</td>-->
<!--            <td class="priceList_tableCell">11,49 zł</td>-->
<!--            <td class="priceList_tableCell">11,99 zł</td>-->
<!--            <td class="priceList_tableCell">12,49 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td class="priceList_tableCellHeader">do 20 kg</td>-->
<!--            <td class="priceList_tableCell">13,49 zł</td>-->
<!--            <td class="priceList_tableCell">13,99 zł</td>-->
<!--            <td class="priceList_tableCell">14,49 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td class="priceList_tableCellHeader">do 30 kg</td>-->
<!--            <td class="priceList_tableCell">15,49 zł</td>-->
<!--            <td class="priceList_tableCell">15,99 zł</td>-->
<!--            <td class="priceList_tableCell">16,49 zł</td>-->
<!--          </tr>-->
<!--          </tbody>-->
<!--        </table>-->
<!--      </div>-->

<!--      <div class="row">-->
<!--        <table class="priceList_table">-->
<!--          <thead>-->
<!--          <tr>-->
<!--            <th></th>-->
<!--            <th>do 1 kg</th>-->
<!--            <th>Uwagi</th>-->
<!--          </tr>-->
<!--          </thead>-->
<!--          <tbody>-->
<!--          <tr class="gabarit-row">-->
<!--            <td>Przesyłka e-Commerce (Poczta Polska)</td>-->
<!--            <td>5,49 zł</td>-->
<!--            <td>-->
<!--              Dostępne formy opakowania Przesyłki e-Commerce: koperta/foliopak/karton<br>-->
<!--              Maksymalne wymiary: (dł. + szer. + wys.) ≤ 70 cm<br>-->
<!--              Max. długość ≤ 50 cm | Max. wysokość ≤ 6 cm-->
<!--            </td>-->
<!--          </tr>-->
<!--          </tbody>-->
<!--        </table>-->
<!--      </div>-->

<!--      <div class="row">-->
<!--        <table class="priceList_table">-->
<!--          <thead>-->
<!--          <tr>-->
<!--            <th></th>-->
<!--            <th>Gabaryt S</th>-->
<!--            <th>Gabaryt M</th>-->
<!--            <th>Gabaryt L</th>-->
<!--            <th>Gabaryt XL</th>-->
<!--            <th>Gabaryt 2XL</th>-->
<!--            <th>Uwagi</th>-->
<!--          </tr>-->
<!--          </thead>-->
<!--          <tbody>-->
<!--          <tr class="gabarit-row">-->
<!--            <td>Pocztex</td>-->
<!--            <td>8,99 zł<br>11,49 zł</td>-->
<!--            <td>9,49 zł<br>11,49 zł</td>-->
<!--            <td>9,49 zł<br>11,49 zł</td>-->
<!--            <td>16,49 zł<br>18,99 zł</td>-->
<!--            <td>23,99 zł<br>25,99 zł</td>-->
<!--            <td>-->
<!--              Nadanie w punkcie; max. waga: S-XL 20 kg; 2XL 30 kg<br>-->
<!--              Odbiór przez kuriera; max. waga: S-XL 20 kg; 2XL 30 kg-->
<!--            </td>-->
<!--          </tr>-->
<!--          </tbody>-->
<!--        </table>-->
<!--      </div>-->

<!--      <div class="row">-->
<!--        <table class="priceList_table">-->
<!--          <thead>-->
<!--          <tr>-->
<!--            <th></th>-->
<!--            <th>do 1 kg</th>-->
<!--            <th>do 2 kg</th>-->
<!--            <th>do 5 kg</th>-->
<!--            <th>do 10 kg</th>-->
<!--            <th>do 20 kg</th>-->
<!--            <th>do 30 kg</th>-->
<!--            <th>do 31,5 kg</th>-->
<!--          </tr>-->
<!--          </thead>-->
<!--          <tbody>-->
<!--          <tr class="gabarit-row">-->
<!--            <td>DHL</td>-->
<!--            <td>11,49 zł</td>-->
<!--            <td>11,99 zł</td>-->
<!--            <td>11,99 zł</td>-->
<!--            <td>13,99 zł</td>-->
<!--            <td>16,49 zł</td>-->
<!--            <td>16,49 zł</td>-->
<!--            <td>18,49 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>DPD</td>-->
<!--            <td>14,49 zł</td>-->
<!--            <td>14,49 zł</td>-->
<!--            <td>15,49 zł</td>-->
<!--            <td>18,99 zł</td>-->
<!--            <td>20,49 zł</td>-->
<!--            <td>22,99 zł</td>-->
<!--            <td>22,99 zł</td>-->
<!--          </tr>-->
<!--          <tr class="gabarit-row">-->
<!--            <td>FedEx</td>-->
<!--            <td>12,49 zł</td>-->
<!--            <td>12,49 zł</td>-->
<!--            <td>12,49 zł</td>-->
<!--            <td>13,99 zł</td>-->
<!--            <td>14,49 zł</td>-->
<!--            <td>14,99 zł</td>-->
<!--            <td>14,99 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>GLS</td>-->
<!--            <td>12,49 zł</td>-->
<!--            <td>12,49 zł</td>-->
<!--            <td>13,49 zł</td>-->
<!--            <td>15,99 zł</td>-->
<!--            <td>18,99 zł</td>-->
<!--            <td>27,99 zł</td>-->
<!--            <td>27,99 zł</td>-->
<!--          </tr>-->
<!--          <tr class="gabarit-row">-->
<!--            <td>UPS</td>-->
<!--            <td>16,49 zł</td>-->
<!--            <td>16,49 zł</td>-->
<!--            <td>16,49 zł</td>-->
<!--            <td>16,49 zł</td>-->
<!--            <td>17,99 zł</td>-->
<!--            <td>19,49 zł</td>-->
<!--            <td>26,99 zł</td>-->
<!--          </tr>-->
<!--          </tbody>-->
<!--        </table>-->
<!--      </div>-->

<!--      <div class="row">-->
<!--        <table class="priceList_table">-->
<!--          <thead>-->
<!--          <tr>-->
<!--            <th></th>-->
<!--            <th>Gabaryt A</th>-->
<!--            <th>Gabaryt B</th>-->
<!--            <th>Gabaryt C</th>-->
<!--          </tr>-->
<!--          </thead>-->
<!--          <tbody>-->
<!--          <tr class="gabarit-row">-->
<!--            <td>InPost Paczkomat® do drzwi</td>-->
<!--            <td>11,49 zł</td>-->
<!--            <td>12,49 zł</td>-->
<!--            <td>13,49 zł</td>-->
<!--          </tr>-->
<!--          </tbody>-->
<!--        </table>-->
<!--      </div>-->

<!--      <div class="row">-->
<!--        <table class="priceList_table">-->
<!--          <thead>-->
<!--          <tr>-->
<!--            <th>Paczki</th>-->
<!--            <th>do 40 kg</th>-->
<!--            <th>do 50 kg</th>-->
<!--            <th>do 60 kg</th>-->
<!--          </tr>-->
<!--          </thead>-->
<!--          <tbody>-->
<!--          <tr class="gabarit-row">-->
<!--            <td>InPost</td>-->
<!--            <td>74,99 zł</td>-->
<!--            <td>89,99 zł</td>-->
<!--            <td></td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>DPD</td>-->
<!--            <td>79,99 zł</td>-->
<!--            <td>84,99 zł</td>-->
<!--            <td></td>-->
<!--          </tr>-->
<!--          <tr class="gabarit-row">-->
<!--            <td>DHL</td>-->
<!--            <td>94,99 zł</td>-->
<!--            <td>104,99 zł</td>-->
<!--            <td></td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>FEDEX</td>-->
<!--            <td>29,99 zł</td>-->
<!--            <td>92,00 zł</td>-->
<!--            <td></td>-->
<!--          </tr>-->
<!--          <tr class="gabarit-row">-->
<!--            <td>UPS</td>-->
<!--            <td>45,20 zł</td>-->
<!--            <td>50,20 zł</td>-->
<!--            <td>55,20 zł</td>-->
<!--          </tr>-->
<!--          </tbody>-->
<!--        </table>-->

<!--        <p class="priceList_infoTxt">Ważne: W przypadku chęci skorzystania z oferty GLS, prosimy o wcześniejszy-->
<!--          kontakt.</p>-->
<!--        <p class="priceList_infoTxt">Maksymalne wymiary paczek do Paczkomatu/Automatu:</p>-->
<!--      </div>-->

<!--      <div class="row">-->
<!--        <table class="priceList_table">-->
<!--          <thead>-->
<!--          <tr>-->
<!--            <th></th>-->
<!--            <th>gab. A</th>-->
<!--            <th>gab. B</th>-->
<!--            <th>gab. C</th>-->
<!--          </tr>-->
<!--          </thead>-->
<!--          <tbody>-->
<!--          <tr class="gabarit-row">-->
<!--            <td>InPost Paczkomat®</td>-->
<!--            <td>64 x 38 x 8 cm</td>-->
<!--            <td>64 x 38 x 19 cm</td>-->
<!--            <td>64 x 38 x 41 cm</td>-->
<!--          </tr>-->
<!--          </tbody>-->
<!--        </table>-->
<!--      </div>-->

<!--      <div class="row">-->
<!--        <table class="priceList_table">-->
<!--          <thead>-->
<!--          <tr>-->
<!--            <th></th>-->
<!--            <th>rozm. S</th>-->
<!--            <th>rozm. M</th>-->
<!--            <th>rozm. L</th>-->
<!--          </tr>-->
<!--          </thead>-->
<!--          <tbody>-->
<!--          <tr class="gabarit-row">-->
<!--            <td>ORLEN Paczka</td>-->
<!--            <td>60 x 38 x 8 cm</td>-->
<!--            <td>60 x 38 x 19 cm</td>-->
<!--            <td>60 x 38 x 41 cm</td>-->
<!--          </tr>-->
<!--          </tbody>-->
<!--        </table>-->
<!--      </div>-->

<!--      <div class="row">-->
<!--        <table class="priceList_table">-->
<!--          <thead>-->
<!--          <tr>-->
<!--            <th></th>-->
<!--            <th>rozm. S</th>-->
<!--            <th>rozm. M</th>-->
<!--            <th>rozm. L</th>-->
<!--          </tr>-->
<!--          </thead>-->
<!--          <tbody>-->
<!--          <tr class="gabarit-row">-->
<!--            <td>Pocztex</td>-->
<!--            <td>65 x 40 x 9 cm</td>-->
<!--            <td>65 x 40 x 20 cm</td>-->
<!--            <td>65 x 40 x 42 cm</td>-->
<!--          </tr>-->
<!--          </tbody>-->
<!--        </table>-->

<!--        <p class="priceList_infoTxt">Formy płatności za wysyłki:</p>-->
<!--        <ul class="priceList_infoTxt">-->
<!--          <li>płatność odroczona</li>-->
<!--          <li>skarbonka</li>-->
<!--        </ul>-->
<!--      </div>-->

<!--      <div class="row">-->
<!--        <table class="priceList_table">-->
<!--          <thead>-->
<!--          <tr>-->
<!--            <th colspan="2" style="background-color: #d9e1f2;">Wykaz opłat dodatkowych, stałych dla wszystkich-->
<!--              przewoźników (w zł netto):-->
<!--            </th>-->
<!--          </tr>-->
<!--          </thead>-->
<!--          <tbody>-->
<!--          <tr>-->
<!--            <td>Przesyłka za pobraniem (COD)</td>-->
<!--            <td>2,49 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Ubezpieczenie do 1 000 zł</td>-->
<!--            <td>0,00 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>- za każdy kolejny rozpoczęty 1 000 zł</td>-->
<!--            <td>0,25 zł</td>-->
<!--          </tr>-->
<!--          </tbody>-->
<!--        </table>-->
<!--      </div>-->

<!--      <div class="row">-->
<!--        <table class="priceList_table">-->
<!--          <thead>-->
<!--          <tr>-->
<!--            <th colspan="2" style="background-color: #d9e1f2;">Wykaz opłat dodatkowych zgodnych z cennikiem danego-->
<!--              przewoźnika (w zł netto):-->
<!--            </th>-->
<!--          </tr>-->
<!--          </thead>-->
<!--          <tbody>-->
<!--          &lt;!&ndash; Add rows for specific carrier fees here if necessary &ndash;&gt;-->
<!--          </tbody>-->
<!--        </table>-->
<!--      </div>-->

<!--      <div class="row">-->
<!--        <table class="priceList_table">-->
<!--          <thead>-->
<!--          <tr>-->
<!--            <th>DHL</th>-->
<!--            <th></th>-->
<!--          </tr>-->
<!--          </thead>-->
<!--          <tbody>-->
<!--          <tr>-->
<!--            <td>Przesyłka za pobraniem (COD) w przypadku płatności kartą przez klienta</td>-->
<!--            <td>0,6% wartości pobrania<br>min 2,49 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Dopłata za wagę przestrzenną 31,5-50 kg</td>-->
<!--            <td>2,00 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Dopłata za wagę przestrzenną 50-110 kg</td>-->
<!--            <td>15,00 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Dopłata za wagę przestrzenną powyżej 110 kg</td>-->
<!--            <td>59,00 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Opłata za element niestandardowy do 31,5 kg</td>-->
<!--            <td>32,00 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Opłata za element niestandardowy powyżej 31,5 kg (w tym paleta przemysłowa)</td>-->
<!--            <td>87,70 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Dopłata za element dłużycowy</td>-->
<!--            <td>25,00 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Zwrot potwierdzonych dokumentów (ROD)</td>-->
<!--            <td>10,00 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Informacja przed doręczeniem (PDI)</td>-->
<!--            <td>0,50 zł</td>-->
<!--          </tr>-->
<!--          </tbody>-->
<!--        </table>-->

<!--        <p class="priceList_infoTxt">Dla każdego elementu obliczana jest waga przestrzenna według przelicznika:<br>-->
<!--          długość cm x szerokość cm x wysokość cm / 4000 lub 1m3 = 250 kg.<br>-->
<!--          Obowiązuje wybór wyższej wagi (rzeczywistej lub przestrzennej).<br>-->
<!--          Cena przesyłki wieloelementowej obliczana jest osobno dla każdego elementu.</p>-->

<!--        <p class="priceList_infoTxt">Ubezpieczenie do 1000 zł nie dotyczy przewoźnika InPost. Ceny ubezpieczenia InPost-->
<!--          zawarte są w tabeli poniżej.</p>-->
<!--      </div>-->

<!--      <div class="row">-->
<!--        <table class="priceList_table">-->
<!--          <thead>-->
<!--          <tr>-->
<!--            <th colspan="2" style="background-color: #d9e1f2;">Wykaz opłat dodatkowych zgodnych z cennikiem danego-->
<!--              przewoźnika (w zł netto):-->
<!--            </th>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <th>DHL</th>-->
<!--            <th></th>-->
<!--          </tr>-->
<!--          </thead>-->
<!--          <tbody>-->
<!--          <tr>-->
<!--            <td>Przesyłka za pobraniem (COD) w przypadku płatności kartą przez klienta</td>-->
<!--            <td>0,6% wartości pobrania<br>min 2,49 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Dopłata za wagę przestrzenną 31,5-50 kg</td>-->
<!--            <td>2,00 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Dopłata za wagę przestrzenną 50-110 kg</td>-->
<!--            <td>15,00 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Dopłata za wagę przestrzenną powyżej 110 kg</td>-->
<!--            <td>59,00 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Opłata za element niestandardowy do 31,5 kg</td>-->
<!--            <td>32,00 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Opłata za element niestandardowy powyżej 31,5 kg (w tym paleta przemysłowa)</td>-->
<!--            <td>87,70 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Dopłata za element dłużycowy</td>-->
<!--            <td>25,00 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Zwrot potwierdzonych dokumentów (ROD)</td>-->
<!--            <td>10,00 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Informacja przed doręczeniem (PDI)</td>-->
<!--            <td>0,50 zł</td>-->
<!--          </tr>-->
<!--          </tbody>-->
<!--        </table>-->

<!--        <p class="priceList_infoTxt">Dla każdego elementu obliczana jest waga przestrzenna według przelicznika:<br>-->
<!--          długość cm x szerokość cm x wysokość cm / 4000 lub 1m3 = 250 kg.<br>-->
<!--          Obowiązuje wybór wyższej wagi (rzeczywistej lub przestrzennej).<br>-->
<!--          Cena przesyłki wieloelementowej obliczana jest osobno dla każdego elementu.</p>-->

<!--        <p class="priceList_infoTxt">Ubezpieczenie do 1000 zł nie dotyczy przewoźnika InPost. Ceny ubezpieczenia InPost-->
<!--          zawarte są w tabeli poniżej.</p>-->
<!--      </div>-->

<!--      <div class="row">-->
<!--        <table class="priceList_table">-->
<!--          <thead>-->
<!--          <tr>-->
<!--            <th colspan="2">FedEx</th>-->
<!--          </tr>-->
<!--          </thead>-->
<!--          <tbody>-->
<!--          <tr>-->
<!--            <td>Opłata za element niestandardowy</td>-->
<!--            <td>200% Ceny podstawowej</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Opłata za element niesortowalny (opakowanie)</td>-->
<!--            <td>28,00 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Opłata za korektę zaniżonej wagi przesyłki</td>-->
<!--            <td>9,50 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Doręczenie do sieci handlowej</td>-->
<!--            <td>0,00 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Doręczenie do obszaru mieszkalnego (DOM)</td>-->
<!--            <td>0,00 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Pusty podjazd</td>-->
<!--            <td>8,40 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Zwrot niedoręczonej przesyłki</td>-->
<!--            <td>100% Ceny podstawowej</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Oczekiwanie na kuriera - nadanie</td>-->
<!--            <td>10,55 zł za każde rozpoczęte 15 min</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Oczekiwanie na kuriera - doręczenie</td>-->
<!--            <td>10,55 zł za każde rozpoczęte 15 min</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Usługa SMS</td>-->
<!--            <td>0,00 zł</td>-->
<!--          </tr>-->
<!--          </tbody>-->
<!--        </table>-->

<!--        <p class="priceList_infoTxt">Przelicznik wagi przestrzennej: długość cm x szerokość cm x wysokość cm / 4000</p>-->
<!--      </div>-->

<!--      <div class="row">-->
<!--        <table class="priceList_table">-->
<!--          <thead>-->
<!--          <tr>-->
<!--            <th colspan="2">DPD</th>-->
<!--          </tr>-->
<!--          </thead>-->
<!--          <tbody>-->
<!--          <tr>-->
<!--            <td>Paczka niestandardowa</td>-->
<!--            <td>12,00 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Paleta niestandardowa</td>-->
<!--            <td>40,00 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Paleta przemysłowa</td>-->
<!--            <td>50,00 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Pusty podjazd</td>-->
<!--            <td>11,00 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Błędne dane adresowe odbiorcy</td>-->
<!--            <td>1,20 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Brak lub błędny numer telefonu do odbiorcy</td>-->
<!--            <td>1,20 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Predict SMS</td>-->
<!--            <td>0,07 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Awizo SMS</td>-->
<!--            <td>0,07 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Predict E-mail</td>-->
<!--            <td>0,00 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Awizo E-mail</td>-->
<!--            <td>0,00 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Przesyłka zwrotna</td>-->
<!--            <td>wg. cennika podstawowego</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Dokumenty zwrotne</td>-->
<!--            <td>12,00 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Kolejna próba doręczenia (druga nieskuteczna i każda kolejna)</td>-->
<!--            <td>10,00 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Przepakowanie</td>-->
<!--            <td>10,00 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Doręczenie w 2 strefie</td>-->
<!--            <td>19,00 zł za każdą paczkę/paletę</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Doręczenie w 3 strefie</td>-->
<!--            <td>40,00 zł za każdą paczkę/paletę</td>-->
<!--          </tr>-->
<!--          </tbody>-->
<!--        </table>-->

<!--        <p class="priceList_infoTxt">Przelicznik wagi przestrzennej: długość cm x szerokość cm x wysokość cm / 6000</p>-->
<!--      </div>-->

<!--      <div class="row">-->
<!--        <table class="priceList_table">-->
<!--          <thead>-->
<!--          <tr>-->
<!--            <th colspan="2">GLS</th>-->
<!--          </tr>-->
<!--          </thead>-->
<!--          <tbody>-->
<!--          <tr>-->
<!--            <td>Anulowanie zlecenia</td>-->
<!--            <td>6,50 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Opłata za SMS</td>-->
<!--            <td>0,50 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Trzecia próba doręczenia</td>-->
<!--            <td>10,00 zł</td>-->
<!--          </tr>-->
<!--          </tbody>-->
<!--        </table>-->

<!--        <p class="priceList_infoTxt">Przelicznik wagi przestrzennej: długość cm x szerokość cm x wysokość cm / 6000</p>-->
<!--      </div>-->

<!--      <div class="row">-->
<!--        <table class="priceList_table">-->
<!--          <thead>-->
<!--          <tr>-->
<!--            <th colspan="2">InPost Paczkomat®</th>-->
<!--          </tr>-->
<!--          </thead>-->
<!--          <tbody>-->
<!--          <tr>-->
<!--            <td>Weryfikacja przesyłki przy zmianie gabarytu</td>-->
<!--            <td>3,80 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Weryfikacja wagi i wymiarów przesyłki</td>-->
<!--            <td>12,69 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Przesyłka ponadgabarytowa</td>-->
<!--            <td>19,03 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Przesyłka ponadgabarytowa II (powyżej 80x50x50 cm lub 30 kg)</td>-->
<!--            <td>253,74 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Podjazd kuriera* (nadanie od 1 do 4 przesyłek)</td>-->
<!--            <td>2,50 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Podjazd kuriera (nadanie od 5 przesyłek)</td>-->
<!--            <td>0,00 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Zwrot niedoręczonej przesyłki</td>-->
<!--            <td>100% ceny podstawowej</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Paczka w Weekend* (dla etykiet wygenerowanych od czwartku godz. 20:00 do piątku godz. 18:00)<br>-->
<!--              UWAGA: Paczki zostaną dostarczone do klientów w weekend, jeśli nadanie paczki do Paczkomatu lub POP albo-->
<!--              złożenie zlecenia na odbiór przez kuriera), nastąpi w godzinach granicznych dla danego kodu pocztowego.-->
<!--              Godziny graniczne można sprawdzić pod adresem <a href="https://inpost.pl/godziny-odbiorow">https://inpost.pl/godziny-odbiorow</a>-->
<!--            </td>-->
<!--            <td>2,99 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Zmiana adresu doręczenia w obrębie oddziału doręczającego</td>-->
<!--            <td>15,00 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Zmiana adresu doręczenia poza obszarem oddziału doręczającego</td>-->
<!--            <td>100% ceny podstawowej</td>-->
<!--          </tr>-->
<!--          </tbody>-->
<!--        </table>-->

<!--        <p class="priceList_infoTxt">*stawki promocyjne dla merchantów BLPaczka</p>-->
<!--      </div>-->

<!--      <div class="row">-->
<!--        <table class="priceList_table">-->
<!--          <thead>-->
<!--          <tr>-->
<!--            <th colspan="2">InPost Kurier</th>-->
<!--          </tr>-->
<!--          </thead>-->
<!--          <tbody>-->
<!--          <tr>-->
<!--            <td>Paczka niestandardowa</td>-->
<!--            <td>22,00 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Dopłata za kg powyżej 50 kg</td>-->
<!--            <td>3,00 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Weryfikacja wagi lub wymiarów przesyłki</td>-->
<!--            <td>13,00 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Paczka dłużycowa</td>-->
<!--            <td>100,00 zł / 100 cm</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Podjazd kuriera* (nadanie od 1 do 4 przesyłek)</td>-->
<!--            <td>2,50 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Podjazd kuriera (nadanie od 5 przesyłek)</td>-->
<!--            <td>0,00 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Zwrot niedoręczonej przesyłki</td>-->
<!--            <td>100% ceny podstawowej</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Zmiana adresu doręczenia w obrębie oddziału doręczającego</td>-->
<!--            <td>15,00 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Zmiana adresu doręczenia poza obszarem oddziału doręczającego</td>-->
<!--            <td>100% ceny podstawowej</td>-->
<!--          </tr>-->
<!--          </tbody>-->
<!--        </table>-->

<!--        <p class="priceList_infoTxt">Przelicznik wagi przestrzennej: długość cm x szerokość cm x wysokość cm / 6000</p>-->

<!--        <p class="priceList_infoTxt">*stawki promocyjne dla merchantów BLPaczka</p>-->

<!--        <p class="priceList_infoTxt">Koszty ubezpieczenia</p>-->
<!--      </div>-->

<!--      <div class="row">-->
<!--        <table class="priceList_table">-->
<!--          <thead>-->
<!--          <tr>-->
<!--            <th>Suma ubezpieczenia</th>-->
<!--            <th>Cena</th>-->
<!--          </tr>-->
<!--          </thead>-->
<!--          <tbody>-->
<!--          <tr>-->
<!--            <td colspan="2" style="background-color: #d9e1f2;">InPost Paczkomat® Paczka Ekonomiczna<br>InPost Paczkomat®-->
<!--            </td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>do 1000 zł</td>-->
<!--            <td>1,50 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>do 5000 zł</td>-->
<!--            <td>1,50 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>do 10 000 zł</td>-->
<!--            <td>2,10 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>do 20 000 zł</td>-->
<!--            <td>2,50 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td colspan="2" style="background-color: #d9e1f2;">InPost Kurier D2D</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>do 1000 zł</td>-->
<!--            <td>0,20 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>do 5000 zł</td>-->
<!--            <td>0,30 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>do 10 000 zł</td>-->
<!--            <td>1,50 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>do 20 000 zł</td>-->
<!--            <td>2,50 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>do 50 000 zł</td>-->
<!--            <td>5,00 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td colspan="2" style="background-color: #d9e1f2;">InPost Kurier P2D</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>do 1000 zł</td>-->
<!--            <td>1,50 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>do 5000 zł</td>-->
<!--            <td>1,50 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>do 10 000 zł</td>-->
<!--            <td>2,10 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>do 20 000 zł</td>-->
<!--            <td>2,50 zł</td>-->
<!--          </tr>-->
<!--          </tbody>-->
<!--        </table>-->
<!--      </div>-->

<!--      <div class="row">-->
<!--        <table class="priceList_table">-->
<!--          <thead>-->
<!--          <tr>-->
<!--            <th colspan="2">Pocztex</th>-->
<!--          </tr>-->
<!--          </thead>-->
<!--          <tbody>-->
<!--          <tr>-->
<!--            <td>Masa powyżej 30 kg do 50 kg (dotyczy przesyłek nadawanych w formacie 2XL)</td>-->
<!--            <td>16,00 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Przesyłka niestandardowa</td>-->
<!--            <td>15,00 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Przekroczenie wymiarów/masy<br>(dopłata za przesyłkę, której parametry: format/masa przekraczają-->
<!--              wartości graniczne określone w Regulaminie usługi Pocztex)-->
<!--            </td>-->
<!--            <td>44,00 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Ostrożnie</td>-->
<!--            <td>50% opłaty za przesyłkę</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Dokumenty zwrotne jako przesyłka Pocztex</td>-->
<!--            <td>10,00 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Sprawdzenie zawartości</td>-->
<!--            <td>4,00 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Potwierdzenie doręczenia albo zwrotu przesyłki SMS-em lub E-mailem</td>-->
<!--            <td>0,41 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Potwierdzenie odbioru jako formularz</td>-->
<!--            <td>2,11 zł</td>-->
<!--          </tr>-->
<!--          </tbody>-->
<!--        </table>-->
<!--      </div>-->

<!--      <div class="row">-->
<!--        <table class="priceList_table">-->
<!--          <thead>-->
<!--          <tr>-->
<!--            <th colspan="2">UPS</th>-->
<!--          </tr>-->
<!--          </thead>-->
<!--          <tbody>-->
<!--          <tr>-->
<!--            <td>Opłata za usługę odbioru tego samego dnia</td>-->
<!--            <td>4,93 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Opłata za usługę odbioru następnego dnia</td>-->
<!--            <td>2,41 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Opłata za dodatkową obsługę dla nietypowych przesyłek<br>(przesyłki, które nie mieszczą się w normach-->
<!--              UPS dotyczących pakowania)-->
<!--            </td>-->
<!--            <td>66,80 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Usługa doręczenia i odbioru w strefie rozszerzonej</td>-->
<!--            <td>6,19 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Opłata dodatkowa za dużą paczkę<br>-->
<!--              Dana paczka jest traktowana jako "Duża paczka" kiedy jej długość oraz obwód [ obwód = (2 x szerokość) + (2-->
<!--              x wysokość)] łącznie wynoszą więcej niż 300 cm, ale nie przekraczają maksymalnego rozmiaru UPS wynoszącego-->
<!--              400 cm. W przypadku dużych paczek stosowana jest minimalna waga podlegająca opłacie wynosząca 40 kg.-->
<!--              Ponadto zostanie zastosowana opłata dodatkowa za dużą paczkę.-->
<!--            </td>-->
<!--            <td>153,60 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Tygodniowa opłata za usługę odbioru<br>-->
<!--              Tygodniowa opłata za usługę odbioru będzie naliczana dla stałych zleceń odbioru.-->
<!--            </td>-->
<!--            <td>36,86 zł</td>-->
<!--          </tr>-->
<!--          </tbody>-->
<!--        </table>-->

<!--        <p class="priceList_infoTxt">Przelicznik wagi przestrzennej: długość cm x szerokość cm x wysokość cm / 5000</p>-->
<!--      </div>-->

<!--      <div class="row">-->
<!--        <table class="priceList_table">-->
<!--          <thead>-->
<!--          <tr>-->
<!--            <th colspan="2">Hellmann</th>-->
<!--          </tr>-->
<!--          </thead>-->
<!--          <tbody>-->
<!--          <tr>-->
<!--            <td>Składowanie towaru powyżej 3 dni</td>-->
<!--            <td>3,00 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Druga i każda kolejna próba dostawy</td>-->
<!--            <td>40% stawki transportowej</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Przestój samochodu pod załadunkiem/rozładunkiem powyżej 1 godziny</td>-->
<!--            <td>40 zł za każdą rozpoczętą godzinę</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Brak możliwości odbioru przesyłki z przyczyn leżących po stronie Zleceniodawcy/Nadawcy</td>-->
<!--            <td>35% stawki transportowej</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Korekta danych w zleceniu</td>-->
<!--            <td>15,00 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Doręczenie palety w strefie 2 kody zaczynające 10-29, 35-39, 72-78</td>-->
<!--            <td>15,00 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>Opłata za transport towarów podlegających pod konwencję ADR</td>-->
<!--            <td>+20% stawki transportowej</td>-->
<!--          </tr>-->
<!--          </tbody>-->
<!--        </table>-->

<!--        <p class="priceList_infoTxt">W sprawach nieregulowanych zastosowanie mają Ogólne Warunki Świadczenia Usług-->
<!--          Hellmann Worldwide Logistics Polska (dostępne na stronie <a href="http://www.hellmann.pl">www.hellmann.pl</a>)-->
<!--        </p>-->
<!--      </div>-->

<!--      <div class="row">-->
<!--        <table class="priceList_table">-->
<!--          <thead>-->
<!--          <tr>-->
<!--            <th colspan="2" style="background-color: #d9e1f2;">Pusty podjazd</th>-->
<!--          </tr>-->
<!--          </thead>-->
<!--          <tbody>-->
<!--          <tr>-->
<!--            <td>Pocztex</td>-->
<!--            <td>15,00 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>ORLEN Paczka</td>-->
<!--            <td>brak</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>InPost Kurier</td>-->
<!--            <td>brak</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>DHL</td>-->
<!--            <td>11,00 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>DPD</td>-->
<!--            <td>11,00 zł</td>-->
<!--          </tr>-->
<!--          <tr>-->
<!--            <td>FedEx</td>-->
<!--            <td>8,40 zł</td>-->
<!--          </tr>-->
<!--          </tbody>-->
<!--        </table>-->
<!--      </div>-->

<!--    </div>-->
<!--  </div>-->
</template>

<style scoped>

</style>