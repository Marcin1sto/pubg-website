<template>
  <footer class="footer">
    <div class="container">
      <div class="footer_logoWrapper">
        <NuxtImg src="icons/blpLogo2.png" width="200px" class="footer_logo"/>
      </div>
      <div class="row">
        <div class="footerColumn">
          <h3 class="footerColumn_title">Kontakt</h3>
          <a href="tel:+48 564 753 193" class="footerColumn_link" v-if="!isC2C">+48 56 475 31 93</a>
          <a href="mailto:info@blpaczka.com" class="footerColumn_link">info@blpaczka.com</a>

          <div class="footer_socialMediaWrapper">
            <a href="https://www.facebook.com/profile.php?id=100086448834292" class="footerColumn_link footerColumn_link--img">
              <NuxtImg src="icons/facebookIcon.png" width="40px" height="40px" />
            </a>
            <a href="https://www.linkedin.com/company/blpaczka-by-baselinker/" class="footerColumn_link footerColumn_link--img">
              <NuxtImg src="icons/linkedinIcon.png" width="40px" height="40px" />
            </a>
          </div>
        </div>

        <div class="footerColumn">
          <h3 class="footerColumn_title">Oferta</h3>
          <a :href="mainPageUrl + '#kalkulatorWyceny'" class="footerColumn_link">Nadaj paczkę</a>
          <nuxt-link to="krajowe" class="footerColumn_link">Wysyłki krajowe</nuxt-link>
          <nuxt-link to="miedzynarodowe" class="footerColumn_link" v-if="!isC2C">Wysyłki międzynarodowe</nuxt-link>
          <nuxt-link to="paletowe" class="footerColumn_link" v-if="!isC2C">Palety i półpalety</nuxt-link>
          <nuxt-link to="niestandardowe" class="footerColumn_link">Niestandardowe</nuxt-link>
        </div>
        <div class="footerColumn">
          <h3 class="footerColumn_title">Pomoc</h3>
          <nuxt-link-locale to="panel-klienta" class="footerColumn_link">Panel klienta</nuxt-link-locale>
          <nuxt-link-locale to="complaints" class="footerColumn_link">Reklamacje</nuxt-link-locale>
          <nuxt-link-locale to="faq" class="footerColumn_link">Pytania i odpowiedzi</nuxt-link-locale>
          <nuxt-link-locale to="plugins" class="footerColumn_link">Integracje</nuxt-link-locale>
        </div>
        <div class="footerColumn">
          <h3 class="footerColumn_title">Informacje</h3>
          <nuxt-link-locale to="regulations" class="footerColumn_link">Regulamin</nuxt-link-locale>
          <nuxt-link-locale to="privacy-policy" class="footerColumn_link">Polityka Prywatności</nuxt-link-locale>
        </div>
<!--        <div class="footerColumn footerColumn&#45;&#45;xl">-->
<!--          <NuxtImg src="icons/baselinkerLogo.png" class="footer_minilogo"/>-->
<!--          <p class="footerColumn_txt"><a href="" class="footerColumn_link">BaseLinker</a> to narzędzie przeznaczone do integracji e-commerce i zarządzania sprzedażą. Posiada ponad 1000 integracji: Allegro, Amazon, eBay, PrestaShop i innych.</p>-->
<!--        </div>-->
      </div>
    </div>
  </footer>
</template>
<script setup lang="ts">
import useC2CStore from "~/stores/useC2CStore";

const mainPageUrl = window.location.origin + '/';
const { isC2C } = storeToRefs(useC2CStore());
</script>