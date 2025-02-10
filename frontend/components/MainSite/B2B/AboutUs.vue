<template>
  <div class="row przesylki" id="onas">
    <div class="aboutUs_col">
      <div>
        <h2 class="header3 przesylkiTitle">O nas</h2>

        <div>
          <p class="przesylki_rotatorTxt przesylki_rotatorTxt--big"><span class="przesylki_rotatorTxt przesylki_rotatorTxt--bigBold">BLPaczka</span> jest częścią <span class="przesylki_rotatorTxt przesylki_rotatorTxt--bigBold">Grupy BaseLinker</span> - dostawcy najpopularniejszego w Polsce narzędzia do integracji i zarządzania sprzedażą w e-commerce. Korzystając z doświadczenia i pozycji rynkowej BaseLinkera stworzyliśmy kompleksowe, a zarazem łatwe w użyciu rozwiązania dla tanich i niezawodnych form dostaw przesyłek - <span class="przesylki_rotatorTxt przesylki_rotatorTxt--bigBold">dostępne nie tylko dla klientów BaseLinkera</span>.</p>
          <p class="przesylki_rotatorTxt przesylki_rotatorTxt--big">Nasza oferta jest skierowana do przedsiębiorców (b2b) będących zaawansowanymi użytkownikami BaseLinkera, prowadzących małe i średnie e-sklepy, jak również <span class="przesylki_rotatorTxt przesylki_rotatorTxt--bigBold">korzystających z tanich i niezawodnych przesyłek poza światem e-commerce</span>.</p>
          <p class="przesylki_rotatorTxt przesylki_rotatorTxt--big">Pełna oferta oraz atrakcyjne ceny dostępne są już od pierwszej paczki - <span class="przesylki_rotatorTxt przesylki_rotatorTxt--bigBold">bez abonamentu, bez kryteriów ilościowych i bez innych zobowiązań</span>!</p>
        </div>
      </div>
    </div>
    <div class="aboutUs_col">
      <div>
        <h2 class="header3 przesylkiTitle przesylkiTitle--sliderTitle">Nasi klienci</h2>

        <!--          <div class="przesylki_rotatorPanel">-->
        <!--            <h3 class="przesylki_rotatorTitle">OneDayMore</h3>-->

        <!--            &lt;!&ndash;          <h3 class="przesylki_rotatorTitle">Piotr Bach <br> www.centrumstrazaka.pl</h3>&ndash;&gt;-->

        <!--            <p class="przesylki_rotatorTxt">Profesjonalny kontakt i obsługa. Konkurencyjna oferta. Korzystanie z BL Paczki jest dla mnie łatwe i przyjemne. Kurierzy dbają o paczki, co możemy zauważyć chociażby po zmniejszonej liczbie reklamacji transportowych</p>-->

        <!--            &lt;!&ndash;          <p class="przesylki_rotatorTxt">Bardzo się cieszę, że BaseLinker <span class="przesylki_rotatorTxt przesylki_rotatorTxt&#45;&#45;bold">odciąża mnie w kolejnym obszarze sprzedaży internetowej</span> i kolejne zaoszczędzone <span class="przesylki_rotatorTxt przesylki_rotatorTxt&#45;&#45;bold">godziny pracy i pieniądze</span>.</p>&ndash;&gt;-->
        <!--          </div>-->
        <carousel :items-to-show="1" :autoplay="5000" :wrap-around="true">
          <slide v-for="opinion in opinions" :key="opinion">
            <div class="przesylki_rotatorPanel">
              <h3 class="przesylki_rotatorTitle">{{ opinion.name }}</h3>

              <!--          <h3 class="przesylki_rotatorTitle">Piotr Bach <br> www.centrumstrazaka.pl</h3>-->

              <p class="przesylki_rotatorTxt">{{ opinion.content }}</p>

              <!--          <p class="przesylki_rotatorTxt">Bardzo się cieszę, że BaseLinker <span class="przesylki_rotatorTxt przesylki_rotatorTxt&#45;&#45;bold">odciąża mnie w kolejnym obszarze sprzedaży internetowej</span> i kolejne zaoszczędzone <span class="przesylki_rotatorTxt przesylki_rotatorTxt&#45;&#45;bold">godziny pracy i pieniądze</span>.</p>-->
            </div>
          </slide>

          <template #addons>
            <navigation />
          </template>
        </carousel>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
const opinions = ref([
  { name: 'OneDayMore.pl', content: 'Profesjonalny kontakt i obsługa. Konkurencyjna oferta. Korzystanie z BL Paczki jest dla mnie łatwe i przyjemne. Kurierzy dbają o paczki, co możemy zauważyć chociażby po zmniejszonej liczbie reklamacji transportowych.' },
  { name: '7more7.com', content: 'Jesteśmy bardzo zadowoleni ze współpracy z dedykowanym opiekunem oraz z obsługi BLPaczki. Bardzo fajne akcje promocyjne dla różnych przewoźników, z których chętnie korzystam' },
  { name: 'Light-mobile.com', content: 'BLPaczka wyróżnia się swoją szeroką ofertą usług. Bez względu na to, czy wysyłam paczkę lokalnie czy międzynarodowo, zawsze znajduję idealne rozwiązanie w ich bogatej gamie usług' },
  { name: 'Nudyess.com', content: 'BLPaczka zaskakuje mnie swoją wszechstronnością. Mając do wyboru tak szeroki zakres usług, zawsze mam pewność, że moje przesyłki są w najlepszych rękach' },
  { name: 'polskibanan.pl', content: 'Zdecydowanie polecam usługi BLPaczki. Szeroka oferta i profesjonalna obsługa sprawiają, że proces wysyłki staje się łatwy i przyjemny' }
]);

const couriersLogos = ref([
  {src: 'images/kurierzyV2/FedEx.png'},
  {src: 'images/kurierzyV2/GLS.png'},
  {src: 'images/kurierzyV2/Inpost.png'},
  {src: 'images/kurierzyV2/Pocztex.png'},
  {src: 'images/kurierzyV2/UPS.png'},
  {src: 'images/kurierzyV2/DHL.png'},
  {src: 'images/kurierzyV2/OP.png'},
  {src: 'images/kurierzyV2/Hellmann.png'},
  {src: 'images/kurierzyV2/geodis3.svg'},
  {src: 'images/kurierzyV2/Geis.png'},
  {src: 'images/kurierzyV2/AmbroExpress.png'},
  {src: 'images/kurierzyV2/DPD.png'}
]);
</script>

<script lang="ts">
import 'vue3-carousel/dist/carousel.css'
import { Carousel, Slide, Pagination, Navigation } from 'vue3-carousel'

export default {
  name: 'App',
  components: {
    Carousel,
    Slide,
    Pagination,
    Navigation,
  },
}
</script>