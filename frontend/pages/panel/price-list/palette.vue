<script setup lang="ts">
import usePageStore from "~/stores/usePageStore";

const { t } = useI18n();
const { setPageValues } = usePageStore();

setPageValues(
    t('page.panel.price-list.palette.title'),
);

useHead({
  title: t('page.panel.price-list.palette.title')
});

definePageMeta({
  middleware: 'auth',
  layout: 'panel',
})
</script>

<template>
<!--  <div class="panel_mainContainer">-->
<!--    <div class="priceList_panel">-->
<!--      <div class="priceList_header">Palety</div>-->
<!--      <div class="priceList_content">-->
<!--        <div class="row">-->
<!--          &lt;!&ndash;    https://send.blpaczka.com/cennik-palet-i-polpalet&ndash;&gt;-->
<!--          <table class="priceList_table">-->
<!--            <caption>Cennik palet i półpalet</caption>-->
<!--            <thead>-->
<!--            <tr>-->
<!--              <th>Paleta 120 x 120 cm</th>-->
<!--              <th>do 200 kg</th>-->
<!--              <th>do 400 kg</th>-->
<!--              <th>do 500 kg</th>-->
<!--              <th>do 600 kg</th>-->
<!--              <th>do 700 kg</th>-->
<!--              <th>do 800 kg</th>-->
<!--              <th>do 900 kg</th>-->
<!--              <th>do 1000 kg</th>-->
<!--              <th>Uwagi</th>-->
<!--            </tr>-->
<!--            </thead>-->
<!--            <tbody>-->
<!--            <tr>-->
<!--              <td>GEIS</td>-->
<!--              <td>170,00 zł</td>-->
<!--              <td>170,00 zł</td>-->
<!--              <td>180,00 zł</td>-->
<!--              <td>180,00 zł</td>-->
<!--              <td>180,00 zł</td>-->
<!--              <td>180,00 zł</td>-->
<!--              <td>180,00 zł</td>-->
<!--              <td>280,00 zł</td>-->
<!--              <td>max. wys. 220 cm</td>-->
<!--            </tr>-->
<!--            <tr>-->
<!--              <td>GEODIS</td>-->
<!--              <td>190,00 zł</td>-->
<!--              <td>210,00 zł</td>-->
<!--              <td>220,00 zł</td>-->
<!--              <td>220,00 zł</td>-->
<!--              <td>230,00 zł</td>-->
<!--              <td>230,00 zł</td>-->
<!--              <td>260,00 zł</td>-->
<!--              <td>260,00 zł</td>-->
<!--              <td>max. wys. 220 cm</td>-->
<!--            </tr>-->
<!--            <tr>-->
<!--              <td>POCZTA POLSKA</td>-->
<!--              <td>230,00 zł</td>-->
<!--              <td>240,00 zł</td>-->
<!--              <td>240,00 zł</td>-->
<!--              <td>250,00 zł</td>-->
<!--              <td>250,00 zł</td>-->
<!--              <td>250,00 zł</td>-->
<!--              <td>260,00 zł</td>-->
<!--              <td>260,00 zł</td>-->
<!--              <td>max. wys. 200 cm</td>-->
<!--            </tr>-->
<!--            </tbody>-->
<!--          </table>-->
<!--        </div>-->

<!--        <div class="row">-->
<!--          <table class="priceList_table">-->
<!--            <caption>Paleta 120 x 100 cm</caption>-->
<!--            <thead>-->
<!--            <tr>-->
<!--              <th></th>-->
<!--              <th>do 200 kg</th>-->
<!--              <th>do 400kg</th>-->
<!--              <th>do 500kg</th>-->
<!--              <th>do 600 kg</th>-->
<!--              <th>do 700 kg</th>-->
<!--              <th>do 800 kg</th>-->
<!--              <th>do 900 kg</th>-->
<!--              <th>do 1000 kg</th>-->
<!--              <th>Uwagi</th>-->
<!--            </tr>-->
<!--            </thead>-->
<!--            <tbody>-->
<!--            <tr>-->
<!--              <td>GEIS</td>-->
<!--              <td>160,00 zł</td>-->
<!--              <td>160,00 zł</td>-->
<!--              <td>170,00 zł</td>-->
<!--              <td>170,00 zł</td>-->
<!--              <td>170,00 zł</td>-->
<!--              <td>170,00 zł</td>-->
<!--              <td>170,00 zł</td>-->
<!--              <td>270,00 zł</td>-->
<!--              <td>max. wys. 220 cm</td>-->
<!--            </tr>-->
<!--            <tr>-->
<!--              <td>GEODIS</td>-->
<!--              <td>170,00 zł</td>-->
<!--              <td>180,00 zł</td>-->
<!--              <td>190,00 zł</td>-->
<!--              <td>190,00 zł</td>-->
<!--              <td>230,00 zł</td>-->
<!--              <td>230,00 zł</td>-->
<!--              <td>250,00 zł</td>-->
<!--              <td>250,00 zł</td>-->
<!--              <td>max. wys. 220 cm</td>-->
<!--            </tr>-->
<!--            <tr>-->
<!--              <td>POCZTA POLSKA</td>-->
<!--              <td>190,00 zł</td>-->
<!--              <td>200,00 zł</td>-->
<!--              <td>205,00 zł</td>-->
<!--              <td>215,00 zł</td>-->
<!--              <td>215,00 zł</td>-->
<!--              <td>220,00 zł</td>-->
<!--              <td>240,00 zł</td>-->
<!--              <td>240,00 zł</td>-->
<!--              <td>max. wys. 200 cm</td>-->
<!--            </tr>-->
<!--            <tr>-->
<!--              <td>HELLMANN</td>-->
<!--              <td>190,00 zł</td>-->
<!--              <td>200,00 zł</td>-->
<!--              <td>220,00 zł</td>-->
<!--              <td>220,00 zł</td>-->
<!--              <td>250,00 zł</td>-->
<!--              <td>250,00 zł</td>-->
<!--              <td>250,00 zł</td>-->
<!--              <td>250,00 zł</td>-->
<!--              <td>max. wys. 200 cm</td>-->
<!--            </tr>-->
<!--            </tbody>-->
<!--          </table>-->
<!--        </div>-->

<!--        <div class="row">-->
<!--          <table class="priceList_table">-->
<!--            <caption>Paleta 120 x 80 cm</caption>-->
<!--            <thead>-->
<!--            <tr>-->
<!--              <th></th>-->
<!--              <th>do 100 kg</th>-->
<!--              <th>do 200 kg</th>-->
<!--              <th>do 400 kg</th>-->
<!--              <th>do 500 kg</th>-->
<!--              <th>do 600 kg</th>-->
<!--              <th>do 700 kg</th>-->
<!--              <th>do 800 kg</th>-->
<!--              <th>do 1000 kg</th>-->
<!--              <th>Uwagi</th>-->
<!--            </tr>-->
<!--            </thead>-->
<!--            <tbody>-->
<!--            <tr>-->
<!--              <td>GEIS</td>-->
<!--              <td>130,00 zł</td>-->
<!--              <td>130,00 zł</td>-->
<!--              <td>130,00 zł</td>-->
<!--              <td>130,00 zł</td>-->
<!--              <td>140,00 zł</td>-->
<!--              <td>140,00 zł</td>-->
<!--              <td>210,00 zł</td>-->
<!--              <td>210,00 zł</td>-->
<!--              <td>max. wys. 220 cm</td>-->
<!--            </tr>-->
<!--            <tr>-->
<!--              <td>FedEx</td>-->
<!--              <td>130,00 zł</td>-->
<!--              <td>140,00 zł</td>-->
<!--              <td>160,00 zł</td>-->
<!--              <td>170,00 zł</td>-->
<!--              <td>490,00 zł</td>-->
<!--              <td>550,00 zł</td>-->
<!--              <td>630,00 zł</td>-->
<!--              <td>800,00 zł</td>-->
<!--              <td>max. wys. 180 cm</td>-->
<!--            </tr>-->
<!--            <tr>-->
<!--              <td>POCZTA POLSKA</td>-->
<!--              <td>140,00 zł</td>-->
<!--              <td>140,00 zł</td>-->
<!--              <td>160,00 zł</td>-->
<!--              <td>165,00 zł</td>-->
<!--              <td>170,00 zł</td>-->
<!--              <td>170,00 zł</td>-->
<!--              <td>180,00 zł</td>-->
<!--              <td>180,00 zł</td>-->
<!--              <td>max. wys. 200 cm</td>-->
<!--            </tr>-->
<!--            <tr>-->
<!--              <td>DPD</td>-->
<!--              <td>150,00 zł</td>-->
<!--              <td>160,00 zł</td>-->
<!--              <td>180,00 zł</td>-->
<!--              <td>180,00 zł</td>-->
<!--              <td>230,00 zł</td>-->
<!--              <td>230,00 zł</td>-->
<!--              <td>230,00 zł</td>-->
<!--              <td>230,00 zł</td>-->
<!--              <td>max. wys. 180 cm</td>-->
<!--            </tr>-->
<!--            <tr>-->
<!--              <td>DHL</td>-->
<!--              <td>140,00 zł</td>-->
<!--              <td>160,00 zł</td>-->
<!--              <td>170,00 zł</td>-->
<!--              <td>190,00 zł</td>-->
<!--              <td>190,00 zł</td>-->
<!--              <td>205,00 zł</td>-->
<!--              <td>205,00 zł</td>-->
<!--              <td>225,00 zł</td>-->
<!--              <td>max. wys. 210 cm</td>-->
<!--            </tr>-->
<!--            <tr>-->
<!--              <td>GEODIS</td>-->
<!--              <td>160,00 zł</td>-->
<!--              <td>160,00 zł</td>-->
<!--              <td>170,00 zł</td>-->
<!--              <td>190,00 zł</td>-->
<!--              <td>190,00 zł</td>-->
<!--              <td>230,00 zł</td>-->
<!--              <td>230,00 zł</td>-->
<!--              <td>250,00 zł</td>-->
<!--              <td>max. wys. 220 cm</td>-->
<!--            </tr>-->
<!--            <tr>-->
<!--              <td>HELLMANN</td>-->
<!--              <td>170,00 zł</td>-->
<!--              <td>170,00 zł</td>-->
<!--              <td>175,00 zł</td>-->
<!--              <td>190,00 zł</td>-->
<!--              <td>190,00 zł</td>-->
<!--              <td>215,00 zł</td>-->
<!--              <td>215,00 zł</td>-->
<!--              <td>250,00 zł</td>-->
<!--              <td>max. wys. 220 cm</td>-->
<!--            </tr>-->
<!--            </tbody>-->
<!--          </table>-->
<!--        </div>-->

<!--        <div class="row">-->
<!--          <table class="priceList_table">-->
<!--            <caption>Paleta 80 x 60 cm</caption>-->
<!--            <thead>-->
<!--            <tr>-->
<!--              <th></th>-->
<!--              <th>do 100 kg</th>-->
<!--              <th>do 200 kg</th>-->
<!--              <th>do 300 kg</th>-->
<!--              <th>do 400 kg</th>-->
<!--              <th>do 500 kg</th>-->
<!--              <th>Uwagi</th>-->
<!--            </tr>-->
<!--            </thead>-->
<!--            <tbody>-->
<!--            <tr>-->
<!--              <td>GEIS</td>-->
<!--              <td>80,00 zł</td>-->
<!--              <td>-&#45;&#45;</td>-->
<!--              <td>-&#45;&#45;</td>-->
<!--              <td>-&#45;&#45;</td>-->
<!--              <td>-&#45;&#45;</td>-->
<!--              <td>max. wys. 180 cm</td>-->
<!--            </tr>-->
<!--            <tr>-->
<!--              <td>GEODIS</td>-->
<!--              <td>110,00 zł</td>-->
<!--              <td>120,00 zł</td>-->
<!--              <td>130,00 zł</td>-->
<!--              <td>140,00 zł</td>-->
<!--              <td>-&#45;&#45;</td>-->
<!--              <td>max. wys. 180 cm</td>-->
<!--            </tr>-->
<!--            <tr>-->
<!--              <td>POCZTA POLSKA</td>-->
<!--              <td>110,00 zł</td>-->
<!--              <td>110,00 zł</td>-->
<!--              <td>120,00 zł</td>-->
<!--              <td>120,00 zł</td>-->
<!--              <td>120,00 zł</td>-->
<!--              <td>max. wys. 140 cm</td>-->
<!--            </tr>-->
<!--            <tr>-->
<!--              <td>HELLMANN</td>-->
<!--              <td>125,00 zł</td>-->
<!--              <td>125,00 zł</td>-->
<!--              <td>-&#45;&#45;</td>-->
<!--              <td>-&#45;&#45;</td>-->
<!--              <td>-&#45;&#45;</td>-->
<!--              <td>max. wys. 220 cm</td>-->
<!--            </tr>-->
<!--            <tr>-->
<!--              <td>DHL</td>-->
<!--              <td>110,00 zł</td>-->
<!--              <td>120,00 zł</td>-->
<!--              <td>-&#45;&#45;</td>-->
<!--              <td>-&#45;&#45;</td>-->
<!--              <td>-&#45;&#45;</td>-->
<!--              <td>max. wys. 160 cm</td>-->
<!--            </tr>-->
<!--            </tbody>-->
<!--          </table>-->
<!--        </div>-->

<!--        <div class="row">-->
<!--          <table class="priceList_table">-->
<!--            <caption>Paleta 60 x 40 cm</caption>-->
<!--            <thead>-->
<!--            <tr>-->
<!--              <th>GEODIS</th>-->
<!--              <th>do 100 kg</th>-->
<!--              <th>do 200 kg</th>-->
<!--              <th>do 300 kg</th>-->
<!--              <th>Uwagi</th>-->
<!--            </tr>-->
<!--            </thead>-->
<!--            <tbody>-->
<!--            <tr>-->
<!--              <td>GEODIS</td>-->
<!--              <td>80,00 zł</td>-->
<!--              <td>90,00 zł</td>-->
<!--              <td>100,00 zł</td>-->
<!--              <td>max. wys. 120 cm</td>-->
<!--            </tr>-->
<!--            </tbody>-->
<!--          </table>-->

<!--          <div id="site_cart_body"><p dir="ltr"><span>Cennik usług dodatkowych dot. usług&nbsp;<strong>Hellmann Palety</strong>:</span></p><ul><li dir="ltr"><p dir="ltr">Pobranie (COD) - 2,49 zł netto (max. kwota 5 000 zł)</p></li><li dir="ltr"><p dir="ltr">Ubezpieczenie: w cenie do 1 000 zł, powyżej tej kwoty 0,25 zł za każdy rozpoczęty 1 000 zł</p></li><li dir="ltr"><p dir="ltr">Odbiór przesyłek następuje w kolejnym dniu roboczym od wygenerowania zamówienia</p></li><li dir="ltr"><p dir="ltr">Dostawa na kody pocztowe odległe +15 zł (kody pocztowe zaczynające się na 10-29, 35-39, 72-78)</p></li></ul><span>Cennik usług dodatkowych dot. usług&nbsp;<strong>Poczta Polska</strong>&nbsp;Palety:</span><br><ul><li dir="ltr"><p dir="ltr">Pobranie (COD) - 2,49 zł netto (max. kwota 15 000 zł)</p></li><li dir="ltr"><p dir="ltr">Odbiór przesyłek następuje w tym samym dniu roboczym (zlecenie do godz. 10:00) lub w kolejnym dniu roboczym od wygenerowania zamówienia</p></li><li dir="ltr"><p dir="ltr">Przesyłki są dostarczane odbiorcy w ciągu 1-2 dni roboczych od odbioru&nbsp;</p></li><li dir="ltr"><p dir="ltr">Opłaty za świadczenie pozostałych usług dodatkowych realizowane są zgodnie z cennikiem lub informacjami przekazanymi przez operatora&nbsp;</p></li></ul><p class="priceList_infoTxt"><span>Cennik usług dodatkowych dot. usług&nbsp;<strong>GEIS</strong>&nbsp;Palety:</span></p><ul><li>Pobranie (COD) - 10 zł netto&nbsp; (max. kwota 15 000 zł)</li><li>Doręczenie do osoby fizycznej - 30 zł netto</li><li>Powtórny dowóz z przyczyn niezależnych od spedytora - 40% dopłaty do ceny za Usługę Podstawową&nbsp;</li><li>Przestój przy załadunku/rozładunku -&nbsp;40 zł netto za każde rozpoczęte 60 minut, licząc powyżej godziny</li><li>Przechowanie Przesyłki powyżej 2 dób -&nbsp;10 zł za jedno miejsce paletowe/dobę</li><li>Zmiana adresu dostawy po przyjęciu przesyłki - 10 zł netto</li><li>Opłata za zmianę parametrów przesyłki - 15 zł netto za przesyłkę</li><li>Przepakowanie/zapakowanie przesyłki - 25 zł za każde rozpoczęte 100 kg</li><li>Deklaracja wartości do 50 000 PLN - 4,50 zł netto</li></ul><p class="priceList_infoTxt"><span>Cennik usług dodatkowych dot. usług&nbsp;<strong>GEODIS</strong>&nbsp;Palety:</span></p><ul><li>Pobranie (COD) - 11 zł netto&nbsp; (max. kwota 10 000 zł)</li><li>Koszt zwiększenia odpowiedzialności GEODIS dla przesyłek z deklaracją wartości do 50 000 PLN - 4,50 zł netto</li><li>Opłata za korektę zaniżonej wagi przesyłki (dodatkowo: wycena frachtu wg faktycznej wagi) -&nbsp;30 zł netto + wycena frachtu wg faktycznej wagi</li><li>Opłata za korektę danych podanych w dokumentach przewozowych dotyczących: wymiarów, liczby jednostek logistycznych, sposobu pakowania -&nbsp;30 zł netto + wycena frachtu wg faktycznych parametrów</li><li>Opłata za obsługę elementów przekraczających maksymalne parametry. Dotyczy przesyłek przekraczających dopuszczalne maksymalne parametry określone dla danej usługi) -&nbsp;50 zł netto&nbsp; + wycena frachtu wg faktycznych parametrów</li><li>Korekta błędnych lub niepełnych danych o przesyłce. Dotyczy korekty danych adresowych i kontaktowych Odbiorcy, danych dotyczących ADR, pobrań lub innych opłat i usług dodatkowych) - 10 zł netto</li><li>Nieuzasadniony podjazd pod załadunek – brak przesyłek przygotowanych do odbioru pomimo złożonego zlecenia -plus 50% ceny frachtu</li><li>Anulowanie zlecenia po rozpoczęciu realizacji -&nbsp;plus 50% ceny frachtu</li><li>Ponowna dostawa przesyłki do Odbiorcy z przyczyn nieleżących po stronie GEODIS -&nbsp;plus 35% ceny frachtu</li><li>Dodatkowy czas postoju samochodu pod załadunkiem: powyżej 30 min dla odbiorów naczepą; powyżej 30 min dla odbiorów samochodem dystrybucyjnym -&nbsp;50 zł za każde rozpoczęte 30 min</li><li>Składowanie przesyłki, której nie można dostarczyć następnego dnia roboczego z przyczyn leżących po stronie Nadawcy lub Odbiorcy – pierwsza doba bez opłat -&nbsp;5 PLN za każde rozpoczęte 10 kg wagi przesyłki za dobę</li><li>Zmiana adresu dostawy w trakcie trwania usługi (od momentu odbioru przesyłek) – informacja przekazana do GEODIS do godziny 18:00 w dniu odbioru przesyłek - 10 zł netto</li><li>Zmiana adresu dostawy w trakcie trwania usługi (od momentu odbioru przesyłek) – informacja przekazana do GEODIS po godzinie 18:00 w dniu odbioru przesyłek lub w dniach następnych -&nbsp;10 PLN + dodatkowy frach liczony pomiędzy pierwotnie</li></ul><p class="priceList_infoTxt">&nbsp;</p></div>-->
<!--        </div>-->

<!--        <div class="row">-->
<!--          &lt;!&ndash;    https://send.blpaczka.com/cennik-miedzynarodowy-palety-hellmann&ndash;&gt;-->
<!--          <table class="priceList_table">-->
<!--            <caption>Cennik międzynarodowy - palety Hellmann</caption>-->
<!--            <thead>-->
<!--            <tr>-->
<!--              <th>Kraj</th>-->
<!--              <th>do 100 kg</th>-->
<!--              <th>do 200 kg</th>-->
<!--              <th>do 300 kg</th>-->
<!--              <th>do 400 kg</th>-->
<!--              <th>do 500 kg</th>-->
<!--              <th>do 600 kg</th>-->
<!--              <th>do 700 kg</th>-->
<!--              <th>do 800 kg</th>-->
<!--            </tr>-->
<!--            </thead>-->
<!--            <tbody>-->
<!--            <tr>-->
<!--              <td>Austria</td>-->
<!--              <td>250,00 zł</td>-->
<!--              <td>350,00 zł</td>-->
<!--              <td>500,00 zł</td>-->
<!--              <td>650,00 zł</td>-->
<!--              <td>700,00 zł</td>-->
<!--              <td>850,00 zł</td>-->
<!--              <td>960,00 zł</td>-->
<!--              <td>1 100,00 zł</td>-->
<!--            </tr>-->
<!--            <tr>-->
<!--              <td>Belgia</td>-->
<!--              <td>330,00 zł</td>-->
<!--              <td>420,00 zł</td>-->
<!--              <td>550,00 zł</td>-->
<!--              <td>650,00 zł</td>-->
<!--              <td>720,00 zł</td>-->
<!--              <td>820,00 zł</td>-->
<!--              <td>920,00 zł</td>-->
<!--              <td>1 040,00 zł</td>-->
<!--            </tr>-->
<!--            <tr>-->
<!--              <td>Bulgaria</td>-->
<!--              <td>450,00 zł</td>-->
<!--              <td>660,00 zł</td>-->
<!--              <td>900,00 zł</td>-->
<!--              <td>1 100,00 zł</td>-->
<!--              <td>1 350,00 zł</td>-->
<!--              <td>1 550,00 zł</td>-->
<!--              <td>1 700,00 zł</td>-->
<!--              <td>1 900,00 zł</td>-->
<!--            </tr>-->
<!--            <tr>-->
<!--              <td>Chorwacja</td>-->
<!--              <td>350,00 zł</td>-->
<!--              <td>500,00 zł</td>-->
<!--              <td>870,00 zł</td>-->
<!--              <td>1 000,00 zł</td>-->
<!--              <td>1 300,00 zł</td>-->
<!--              <td>1 350,00 zł</td>-->
<!--              <td>1 500,00 zł</td>-->
<!--              <td>1 600,00 zł</td>-->
<!--            </tr>-->
<!--            <tr>-->
<!--              <td>Czechy</td>-->
<!--              <td>160,00 zł</td>-->
<!--              <td>250,00 zł</td>-->
<!--              <td>350,00 zł</td>-->
<!--              <td>450,00 zł</td>-->
<!--              <td>500,00 zł</td>-->
<!--              <td>600,00 zł</td>-->
<!--              <td>700,00 zł</td>-->
<!--              <td>800,00 zł</td>-->
<!--            </tr>-->
<!--            <tr>-->
<!--              <td>Dania</td>-->
<!--              <td>300,00 zł</td>-->
<!--              <td>400,00 zł</td>-->
<!--              <td>500,00 zł</td>-->
<!--              <td>600,00 zł</td>-->
<!--              <td>700,00 zł</td>-->
<!--              <td>800,00 zł</td>-->
<!--              <td>900,00 zł</td>-->
<!--              <td>1 000,00 zł</td>-->
<!--            </tr>-->
<!--            <tr>-->
<!--              <td>Estonia</td>-->
<!--              <td>240,00 zł</td>-->
<!--              <td>350,00 zł</td>-->
<!--              <td>450,00 zł</td>-->
<!--              <td>550,00 zł</td>-->
<!--              <td>600,00 zł</td>-->
<!--              <td>680,00 zł</td>-->
<!--              <td>750,00 zł</td>-->
<!--              <td>820,00 zł</td>-->
<!--            </tr>-->
<!--            <tr>-->
<!--              <td>Finlandia</td>-->
<!--              <td>400,00 zł</td>-->
<!--              <td>600,00 zł</td>-->
<!--              <td>800,00 zł</td>-->
<!--              <td>1 000,00 zł</td>-->
<!--              <td>1 200,00 zł</td>-->
<!--              <td>1 400,00 zł</td>-->
<!--              <td>1 600,00 zł</td>-->
<!--              <td>1 850,00 zł</td>-->
<!--            </tr>-->
<!--            <tr>-->
<!--              <td>Francja</td>-->
<!--              <td>350,00 zł</td>-->
<!--              <td>500,00 zł</td>-->
<!--              <td>650,00 zł</td>-->
<!--              <td>800,00 zł</td>-->
<!--              <td>950,00 zł</td>-->
<!--              <td>1 100,00 zł</td>-->
<!--              <td>1 250,00 zł</td>-->
<!--              <td>1 450,00 zł</td>-->
<!--            </tr>-->
<!--            <tr>-->
<!--              <td>Grecja</td>-->
<!--              <td>450,00 zł</td>-->
<!--              <td>700,00 zł</td>-->
<!--              <td>950,00 zł</td>-->
<!--              <td>1 200,00 zł</td>-->
<!--              <td>1 400,00 zł</td>-->
<!--              <td>1 700,00 zł</td>-->
<!--              <td>1 900,00 zł</td>-->
<!--              <td>2 200,00 zł</td>-->
<!--            </tr>-->
<!--            <tr>-->
<!--              <td>Hiszpania</td>-->
<!--              <td>360,00 zł</td>-->
<!--              <td>550,00 zł</td>-->
<!--              <td>700,00 zł</td>-->
<!--              <td>900,00 zł</td>-->
<!--              <td>1 050,00 zł</td>-->
<!--              <td>1 250,00 zł</td>-->
<!--              <td>1 400,00 zł</td>-->
<!--              <td>1 650,00 zł</td>-->
<!--            </tr>-->
<!--            <tr>-->
<!--              <td>Holandia</td>-->
<!--              <td>300,00 zł</td>-->
<!--              <td>380,00 zł</td>-->
<!--              <td>500,00 zł</td>-->
<!--              <td>600,00 zł</td>-->
<!--              <td>670,00 zł</td>-->
<!--              <td>765,00 zł</td>-->
<!--              <td>900,00 zł</td>-->
<!--              <td>980,00 zł</td>-->
<!--            </tr>-->
<!--            <tr>-->
<!--              <td>Litwa</td>-->
<!--              <td>200,00 zł</td>-->
<!--              <td>300,00 zł</td>-->
<!--              <td>350,00 zł</td>-->
<!--              <td>400,00 zł</td>-->
<!--              <td>450,00 zł</td>-->
<!--              <td>500,00 zł</td>-->
<!--              <td>550,00 zł</td>-->
<!--              <td>600,00 zł</td>-->
<!--            </tr>-->

<!--            <tr>-->
<!--              <td>Luksemburg</td>-->
<!--              <td>250,00 zł</td>-->
<!--              <td>350,00 zł</td>-->
<!--              <td>450,00 zł</td>-->
<!--              <td>500,00 zł</td>-->
<!--              <td>550,00 zł</td>-->
<!--              <td>650,00 zł</td>-->
<!--              <td>750,00 zł</td>-->
<!--              <td>800,00 zł</td>-->
<!--            </tr>-->
<!--            <tr>-->
<!--              <td>Łotwa</td>-->
<!--              <td>200,00 zł</td>-->
<!--              <td>300,00 zł</td>-->
<!--              <td>350,00 zł</td>-->
<!--              <td>400,00 zł</td>-->
<!--              <td>500,00 zł</td>-->
<!--              <td>550,00 zł</td>-->
<!--              <td>600,00 zł</td>-->
<!--            </tr>-->
<!--            <tr>-->
<!--              <td>Niemcy</td>-->
<!--              <td>220,00 zł</td>-->
<!--              <td>320,00 zł</td>-->
<!--              <td>410,00 zł</td>-->
<!--              <td>500,00 zł</td>-->
<!--              <td>590,00 zł</td>-->
<!--              <td>690,00 zł</td>-->
<!--              <td>790,00 zł</td>-->
<!--              <td>890,00 zł</td>-->
<!--            </tr>-->
<!--            <tr>-->
<!--              <td>Portugalia</td>-->
<!--              <td>420,00 zł</td>-->
<!--              <td>620,00 zł</td>-->
<!--              <td>820,00 zł</td>-->
<!--              <td>1 050,00 zł</td>-->
<!--              <td>1 250,00 zł</td>-->
<!--              <td>1 450,00 zł</td>-->
<!--              <td>1 660,00 zł</td>-->
<!--              <td>1 920,00 zł</td>-->
<!--            </tr>-->
<!--            <tr>-->
<!--              <td>Rumunia</td>-->
<!--              <td>420,00 zł</td>-->
<!--              <td>620,00 zł</td>-->
<!--              <td>850,00 zł</td>-->
<!--              <td>1 050,00 zł</td>-->
<!--              <td>1 250,00 zł</td>-->
<!--              <td>1 450,00 zł</td>-->
<!--              <td>1 620,00 zł</td>-->
<!--              <td>1 800,00 zł</td>-->
<!--            </tr>-->
<!--            <tr>-->
<!--              <td>Słowacja</td>-->
<!--              <td>225,00 zł</td>-->
<!--              <td>350,00 zł</td>-->
<!--              <td>500,00 zł</td>-->
<!--              <td>600,00 zł</td>-->
<!--              <td>700,00 zł</td>-->
<!--              <td>800,00 zł</td>-->
<!--              <td>950,00 zł</td>-->
<!--              <td>1 060,00 zł</td>-->
<!--              <td>1 220,00 zł</td>-->
<!--            </tr>-->
<!--            <tr>-->
<!--              <td>Słowenia</td>-->
<!--              <td>320,00 zł</td>-->
<!--              <td>440,00 zł</td>-->
<!--              <td>570,00 zł</td>-->
<!--              <td>700,00 zł</td>-->
<!--              <td>800,00 zł</td>-->
<!--              <td>950,00 zł</td>-->
<!--              <td>1 060,00 zł</td>-->
<!--              <td>1 220,00 zł</td>-->
<!--            </tr>-->
<!--            <tr>-->
<!--              <td>Szwecja</td>-->
<!--              <td>420,00 zł</td>-->
<!--              <td>630,00 zł</td>-->
<!--              <td>850,00 zł</td>-->
<!--              <td>1 080,00 zł</td>-->
<!--              <td>1 280,00 zł</td>-->
<!--              <td>1 500,00 zł</td>-->
<!--              <td>1 700,00 zł</td>-->
<!--              <td>2 000,00 zł</td>-->
<!--            </tr>-->
<!--            <tr>-->
<!--              <td>Węgry</td>-->
<!--              <td>150,00 zł</td>-->
<!--              <td>250,00 zł</td>-->
<!--              <td>350,00 zł</td>-->
<!--              <td>450,00 zł</td>-->
<!--              <td>500,00 zł</td>-->
<!--              <td>600,00 zł</td>-->
<!--              <td>700,00 zł</td>-->
<!--              <td>800,00 zł</td>-->
<!--            </tr>-->
<!--            <tr>-->
<!--              <td>Włochy</td>-->
<!--              <td>220,00 zł</td>-->
<!--              <td>320,00 zł</td>-->
<!--              <td>450,00 zł</td>-->
<!--              <td>600,00 zł</td>-->
<!--              <td>750,00 zł</td>-->
<!--              <td>900,00 zł</td>-->
<!--              <td>1 020,00 zł</td>-->
<!--              <td>1 160,00 zł</td>-->
<!--            </tr>-->
<!--            </tbody>-->
<!--          </table>-->

<!--          <div>-->
<!--            <h2>Informacje dodatkowe dot. usługi Hellmann Palety:</h2>-->
<!--            <ul>-->
<!--              <li><strong>Odbiór przesyłek</strong> następuje w kolejnym dniu roboczym od wygenerowania zamówienia.</li>-->
<!--              <li><strong>Czas doręczenia</strong>: 2-5 dni roboczych (w zależności od kraju i strefy).</li>-->
<!--              <li><strong>Max. wymiar palety standardowej</strong>: 120 x 80 x 220 cm.</li>-->
<!--              <li><strong>Ubezpieczenie do max.</strong> 100 tys zł.</li>-->
<!--              <li><strong>Koszt ubezpieczenia</strong>: 90 zł netto za każde rozpoczęte 25 tys zł.</li>-->
<!--            </ul>-->
<!--          </div>-->


<!--          &lt;!&ndash;https://send.blpaczka.com/cennik-allegro-smart&ndash;&gt;-->
<!--          <div id="site_cart_body">-->
<!--            <p dir="ltr"><strong>Cennik za wygenerowanie pojedynczej etykiety Allegro SMART!:&nbsp;</strong></p><p dir="ltr"><strong>-0,15 zł netto</strong> - jeśli nadajesz mniej niż 1000 paczek miesięcznie&nbsp;</p><p dir="ltr"><strong>-0,10 zł netto </strong>- jeśli nadajesz więcej niż 1000 paczek miesięcznie&nbsp;</p><p dir="ltr"><span style="text-decoration: underline;">Ceny dotyczą wolumenów wysyłanych poprzez BLPaczkę nie wliczając usługi Allegro SMART!</span></p><p dir="ltr"><span style="text-decoration: underline;"> <br><br></span></p>        </div>-->
<!--        </div>-->

<!--      </div>-->
<!--    </div>-->
<!--  </div>-->

</template>

<style scoped>

</style>