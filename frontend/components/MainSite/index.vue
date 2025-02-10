<template>
  <div class="container">
    <MainSiteB2BBanerContainer v-if="!isC2C"/>

    <MainSiteC2CBanerContainer v-if="isC2C"/>

    <FormB2BQuickQuote id="postPackage" v-if="!isC2C"/>

    <FormC2CQuickQuote id="postPackage" v-if="isC2C"/>

    <div class="oszczednosc">
      <div class="container">
        <div class="row row--relative row--oszczednosc">
          <div>
            <h2 class="oszczednosc_title" v-if="!isC2C">Wysyłka paczek od 7,37zł brutto <br> (5,99 netto)!</h2>
            <h2 class="oszczednosc_title" v-if="isC2C">Wysyłka paczek od 7,37zł brutto!</h2>
            <p class="oszczednosc_subtitle">Sprawdź ile zaoszczędzisz!</p>

            <div class="oszczednosc_row">
              <nuxt-link to="krajowe" class="oszczednosc_button">Krajowe</nuxt-link>
              <nuxt-link to="miedzynarodowe" class="oszczednosc_button" v-if="!isC2C">Międzynarodowe</nuxt-link>
              <nuxt-link to="paletowe" class="oszczednosc_button" v-if="!isC2C">Paletowe</nuxt-link>
              <nuxt-link to="niestandardowe" class="oszczednosc_button">Niestandardowe</nuxt-link>
            </div>
          </div>
          <NuxtImg src="images/skarbonka.png" class="oszczednosc_img"/>
        </div>
      </div>
    </div>

<!--    <div class="row przesylki">-->
<!--      <div class="col-50">-->
<!--        <h2 class="header3 przesylkiTitle">Niezawodne przesyłki</h2>-->

<!--        <ul class="przesylki_list">-->
<!--          <li class="przesylki_listItem">Curabitur ullamcorper ultricies nisi. Nam eget dui. In hac habitasse platea dictumst.</li>-->
<!--          <li class="przesylki_listItem">In ut quam vitae odio lacinia tincidunt. Vivamus consectetuer hendrerit lacus.</li>-->
<!--          <li class="przesylki_listItem">Curabitur ullamcorper ultricies nisi. Nam eget dui.</li>-->
<!--        </ul>-->

<!--        <button class="przesylki_button">Załóż bezpłatne konto</button>-->
<!--      </div>-->

<!--      <div style="width: 100%" id="onas">-->
<!--        <h2 class="header3 przesylkiTitle">O nas</h2>-->

<!--        <div class="">-->
<!--          <p class="przesylki_rotatorTxt przesylki_rotatorTxt&#45;&#45;big">-->
<!--            <span class="przesylki_rotatorTxt przesylki_rotatorTxt&#45;&#45;bigBold">BLPaczka</span> jest częścią grupy <span class="przesylki_rotatorTxt przesylki_rotatorTxt&#45;&#45;bigBold">BaseLinker</span>, oferującej najlepszy system zarządzania dla e-commerce na rynku. Korzystając z doświadczenia partnerów, stworzyliśmy zintegrowane i bezkonkurencyjne rozwiązanie będące odpowiedzią na rosnące zainteresowanie dla tanich, niezawodnych oraz elastycznych form dostaw przesyłek.-->
<!--            Pełna lista usług oraz preferencyjne ceny dostępne są już od pierwszej paczki.-->
<!--          </p>-->

<!--          <p class="przesylki_rotatorTxt przesylki_rotatorTxt&#45;&#45;big" style="margin-bottom: 72px">-->
<!--            Nasza oferta <span class="przesylki_rotatorTxt przesylki_rotatorTxt&#45;&#45;bigBold">B2B</span> to idealne rozwiązanie zarówno dla zaawansowanych użytkowników BaseLinker jak i mniejszych e sklepów bez subskrypcji w tym systemie, bez kryteriów ilościowych czy innych zobowiązań.-->
<!--          </p>-->
<!--        </div>-->
<!--      </div>-->

<!--      <div style="width: 100%">-->
<!--        <h2 class="header3 przesylkiTitle">Nasi klienci</h2>-->

<!--        <div class="przesylki_rotatorPanel">-->
<!--          <h3 class="przesylki_rotatorTitle">OneDayMore</h3>-->

<!--&lt;!&ndash;          <h3 class="przesylki_rotatorTitle">Piotr Bach <br> www.centrumstrazaka.pl</h3>&ndash;&gt;-->

<!--          <p class="przesylki_rotatorTxt">Profesjonalny kontakt i obsługa. Konkurencyjna oferta. Korzystanie z BL Paczki jest dla mnie łatwe i przyjemne. Kurierzy dbają o paczki, co możemy zauważyć chociażby po zmniejszonej liczbie reklamacji transportowych</p>-->

<!--&lt;!&ndash;          <p class="przesylki_rotatorTxt">Bardzo się cieszę, że BaseLinker <span class="przesylki_rotatorTxt przesylki_rotatorTxt&#45;&#45;bold">odciąża mnie w kolejnym obszarze sprzedaży internetowej</span> i kolejne zaoszczędzone <span class="przesylki_rotatorTxt przesylki_rotatorTxt&#45;&#45;bold">godziny pracy i pieniądze</span>.</p>&ndash;&gt;-->
<!--        </div>-->
<!--      </div>-->
<!--    </div>-->

    <MainSiteB2BAboutUs v-if="!isC2C"/>
    <MainSiteC2CAboutUs v-if="isC2C"/>

    <div class="hero">
      <div class="row heroContainer">
        <div class="row">
          <span class="header3 przesylkiTitle">Tylko sprawdzeni kurierzy z najlepszymi ofertami</span>
        </div>
        <div class="row">
          <ul class="couriersList">
            <li class="couriersListItem" v-if="!isC2C"><NuxtImg src="images/kurierzyV2/FedEx.png" width="80px" height="60px" class="couriersListItem_img"/></li>
            <li class="couriersListItem" v-if="!isC2C"><NuxtImg src="images/kurierzyV2/GLS.png" width="80px" height="60px" class="couriersListItem_img"/></li>
            <li class="couriersListItem"><NuxtImg src="images/kurierzyV2/Inpost.png" width="80px" height="60px" class="couriersListItem_img"/></li>
            <li class="couriersListItem"><NuxtImg src="images/kurierzyV2/Pocztex.png" width="80px" height="60px" class="couriersListItem_img"/></li>
            <li class="couriersListItem" v-if="!isC2C"><NuxtImg src="images/kurierzyV2/UPS.png" width="80px" height="60px" class="couriersListItem_img"/></li>
            <li class="couriersListItem"><NuxtImg src="images/kurierzyV2/DHL.png" width="80px" height="60px" class="couriersListItem_img"/></li>
            <li class="couriersListItem"><NuxtImg src="images/kurierzyV2/DPD.png" width="80px" height="60px" class="couriersListItem_img"/></li>
            <li class="couriersListItem"><NuxtImg src="images/kurierzyV2/OP.png" width="80px" height="60px" class="couriersListItem_img"/></li>
            <li class="couriersListItem" v-if="!isC2C"><NuxtImg src="images/kurierzyV2/Hellmann.png" width="80px" height="60px" class="couriersListItem_img"/></li>
            <li class="couriersListItem" v-if="!isC2C"><NuxtImg src="images/kurierzyV2/geodis3.svg" width="65px" height="60px" class="couriersListItem_img"/></li>
            <li class="couriersListItem" v-if="!isC2C"><NuxtImg src="images/kurierzyV2/Geis.png" width="80px" height="60px" class="couriersListItem_img"/></li>
            <li class="couriersListItem"><NuxtImg src="images/kurierzyV2/AmbroExpress.png" width="80px" height="60px" class="couriersListItem_img"/></li>
          </ul>
        </div>
      </div>
    </div>
  </div>

  <MainSiteB2BProfits v-if="!isC2C"/>
  <MainSiteC2CProfits v-if="isC2C"/>

  <div v-if="articles.length > 2">
    <div>
      <div class="container">
        <div class="row">
          <h2 class="header3 newsTitle">Blog</h2>
          <a href="blog" class="news_link">Zobacz wszystkie wpisy <NuxtImg src="icons/linkArrow.png" class="przesylki_linkImg"/></a>
        </div>
      </div>
    </div>
    <div class="news">
    <div class="container">
      <div class="row row--news">
        <nuxt-link-locale :to="{ name: 'blog-slug', params: { slug: article.slug }}" class="blogCard blogCard--mainSite" v-for="article in articles.slice(0, 3)">
          <div class="blogCard_imgContainer">
            <NuxtImg :src="article.picture" class="blogCard_img" />
          </div>
          <div class="blogCard_txtContainer blogCard_txtContainer--blogSite">
            <span class="blogCard_subtitle">{{ article.category }}</span>
            <h3 class="blogCard_title">{{ article.title }}</h3>
            <span class="blogCard_date">{{article.publication_date}}</span>
            <p class="blogCard_txt" v-html="article.preview_text"></p>
            <span class="blogCard_link">Czytaj więcej</span>
          </div>
        </nuxt-link-locale>
      </div>
    </div>
  </div>
  </div>

<!--  <div class="qa">-->
<!--    <div class="container">-->
<!--      <div class="row">-->
<!--        <h2 class="qa_title">Pytania i odpowiedzi</h2>-->
<!--        <a href="#" class="qa_titleLink">Przejdź do bazy wiedzy <NuxtImg src="icons/linkArrow.png" class="qa_linkImg"/></a>-->
<!--      </div>-->

<!--      <div class="row">-->
<!--        <h3 class="qa_subtitle">BLPaczka</h3>-->
<!--      </div>-->

<!--      <div class="row">-->
<!--        <div class="col-40">-->
<!--          <ul class="qa_list">-->
<!--            <li><a href="#" class="qa_listItem qa_listItem&#45;&#45;active">Jak działa BLPaczka?</a></li>-->
<!--            <li><a href="#" class="qa_listItem">Dlaczego warto zaufać BLPaczka?</a></li>-->
<!--            <li><a href="#" class="qa_listItem">Z jakimi przewoźnikami współpracuje BLPaczka?</a></li>-->
<!--            <li><a href="#" class="qa_listItem">Gdzie znajdę opinię klientów?</a></li>-->
<!--            <li><a href="#" class="qa_listItem">Jak działają reklamacje w BLPaczka?</a></li>-->
<!--          </ul>-->
<!--        </div>-->

<!--        <div class="col-60">-->
<!--          <p>Vel curabitur vestibulum sed facilisis dolor et vel nibh.-->
<!--            Adipiscing urna massa amet egestas nulla aliquet pharetra vitae.-->
<!--            Habitant a et quis nec et odio. Viverra porttitor adipiscing integer-->
<!--            mollis euismod ipsum viverra mauris urna. Morbi nunc ut vitae-->
<!--            gravida magna viverra egestas. A tellus in felis elit. Urna-->
<!--            platea ultricies risus tristique sed condimentum sed. Gravida-->
<!--            nunc pellentesque diam nec. Eget in nascetur eget consectetur orci.-->
<!--            Dignissim bibendum massa tristique sagittis nam nibh habitasse et.-->
<!--            Sit viverra rhoncus mauris tempus aenean condimentum praesent. Enim-->
<!--            euismod ornare sem donec. Massa auctor etiam quis.</p>-->
<!--        </div>-->
<!--      </div>-->
<!--    </div>-->
<!--  </div>-->
  <Cta />
</template>
<script setup lang="ts">
import useArticlesStore from "~/stores/useArticlesStore";
import useC2CStore from "~/stores/useC2CStore";

const { getArticles } = useArticlesStore();
const { articles } = storeToRefs(useArticlesStore());
const { isC2C } = storeToRefs(useC2CStore());

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

const plugins = [
  {
    name: 'WooCommerce',
    image: 'images/plugins/wooLogo.png',
    link: 'plugins/api'
  },
  {
    name: 'Allegro',
    image: 'icons/allegro.png',
    link: 'plugins/api'
  },
  {
    name: 'IdoSell',
    image: 'icons/idosell.png',
    link: 'plugins/api'
  },
  {
    name: 'BLPaczka API',
    image: 'icons/blp-api-logo.png',
    link: 'plugins/api'
  },
  {
    name: 'Baselinker',
    image: 'icons/Baselinker-logo-2.png',
    link: 'plugins/api'
  },
  {
    name: 'PrestaShop',
    image: 'images/plugins/prestashop.svg',
    link: 'plugins/api'
  }
]

onMounted(async () => {
  await getArticles();
});
</script>