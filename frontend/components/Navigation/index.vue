<template>
  <div class="navigation" style="flex-wrap: wrap">
    <div class="navigation_row">
      <nuxt-link-locale to="/"><NuxtImg src="icons/blpLogoMain.png" class="navigation_logo"/></nuxt-link-locale>
      <ul class="navigation_ul hideOnMobile">


        <li class="navigation_li" :class="!isC2C ? 'navigation_li--clientTypeActive' : ''" @click="isC2C = false"><nuxt-link-locale to="#" class="navigation_link">Dla firm</nuxt-link-locale></li>
        <li class="navigation_li" :class="isC2C ? 'navigation_li--clientTypeActive' : ''" @click="isC2C = true"><nuxt-link-locale to="#" class="navigation_link">Dla klientów indywidualnych</nuxt-link-locale></li>
<!--        <li class="navigation_li"><nuxt-link-locale to="blog" class="navigation_link">Blog</nuxt-link-locale></li>-->
      </ul>
    </div>

    <div class="navigation_row rightNavigation">
<!--      <div class="smallNavigation">-->
<!--        <nuxt-link-locale to="login" class="smallNavigation_item">-->
<!--          <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">-->
<!--            <path d="M9.00064 9.30979C10.9113 9.30979 12.4621 7.75901 12.4621 5.84826C12.4621 3.93749 10.9113 2.38672 9.00064 2.38672C7.08983 2.38672 5.53906 3.93749 5.53906 5.84826C5.53906 7.75901 7.08983 9.30979 9.00064 9.30979ZM9.00064 3.77133C10.1452 3.77133 11.0775 4.70364 11.0775 5.84826C11.0775 6.99287 10.1452 7.92521 9.00064 7.92521C7.85599 7.92521 6.92367 6.99287 6.92367 5.84826C6.92367 4.70364 7.85599 3.77133 9.00064 3.77133Z" fill="#727272"/>-->
<!--            <path d="M15.8492 14.8246C17.1877 13.2553 18 11.2154 18 9C18 4.03384 13.9661 0 9 0C4.03384 0 0 4.03384 0 9C0 11.2247 0.81231 13.2553 2.15077 14.8246C2.20616 14.9353 2.29847 15.0277 2.4 15.1016C4.04308 16.8739 6.38769 18 8.99078 18C11.5939 18 13.9384 16.8831 15.5816 15.1016C15.6923 15.0277 15.7846 14.9353 15.8308 14.8246H15.8492ZM9 1.38461C13.2 1.38461 16.6153 4.8 16.6153 9C16.6153 10.5692 16.1353 12.0277 15.3231 13.2461C14.1046 11.3908 11.6861 10.1539 9 10.1539C6.31384 10.1539 3.89539 11.3816 2.67692 13.2461C1.85539 12.0369 1.38461 10.5692 1.38461 9C1.38461 4.8 4.8 1.38461 9 1.38461ZM3.61846 14.3815C4.45846 12.6923 6.59077 11.5385 9 11.5385C11.4092 11.5385 13.5415 12.6923 14.3815 14.3815C13.0061 15.7569 11.1047 16.6153 9 16.6153C6.89539 16.6153 5.00308 15.7661 3.61846 14.3815Z" fill="#727272"/>-->
<!--          </svg>-->
<!--          Logowanie-->
<!--        </nuxt-link-locale>-->
<!--      </div>-->
      <nuxt-link-locale to="login" class="navigation_buttonSecondary">Zaloguj się</nuxt-link-locale>
      <nuxt-link-locale to="register" class="navigation_buttonPrimary">{{ t('page.register.btnTitle') }}</nuxt-link-locale>
    </div>
    <div class="navigationMobile">

    </div>
<!--  </div>-->

<!--  <div class="navigation navigation&#45;&#45;secondRow">-->
    <div class="navigation_row" style="width: 100%; padding: 0 0 16px; margin-left: 260px">
      <ul class="navigation_ul hideOnMobile">
        <li class="navigation_li"><a :href="mainPageUrl + '#kalkulatorWyceny'" class="navigation_link">Nadaj paczkę</a></li>
        <li class="navigation_li" @click="showPackages = true; showAboutUs = false"><nuxt-link-locale to="#" class="navigation_link">Oferta<NuxtImg src="icons/navigation/navigationArrowDown.png" class="navigation_linkImg"/></nuxt-link-locale></li>
        <li class="navigation_li" @click="showPackages = false; showAboutUs = true"><nuxt-link-locale to="#" class="navigation_link">O nas<NuxtImg src="icons/navigation/navigationArrowDown.png" class="navigation_linkImg"/></nuxt-link-locale></li>
        <!--        <li class="navigation_li"><nuxt-link-locale to="#" class="navigation_link">O nas<NuxtImg src="icons/navigation/navigationArrowDown.png" class="navigation_linkImg"/></nuxt-link-locale></li>-->
        <!--        <li class="navigation_li"><a href="/#onas" class="navigation_link">O nas</a></li>-->
        <li class="navigation_li"><nuxt-link-locale to="contact" class="navigation_link">Kontakt</nuxt-link-locale></li>
      </ul>
    </div>
  </div>


  <div class="options" v-show="showPackages" @mouseleave="showPackages = false;">
    <div class="options_items" v-show="showPackages">
      <div class="options_item">
        <div class="options_item--title">
          <NuxtImg src="icons/paczkaKalkulator.png" width="27px" height="26px"/> Krajowe
        </div>
        <div class="options_item--description">Wszystkie popularne formy przesyłek krajowych...</div>
        <nuxt-link to="krajowe" class="options_item--link">Zobacz więcej</nuxt-link>
      </div>
      <div class="options_item" v-if="!isC2C">
        <div class="options_item--title">
          <NuxtImg src="icons/paczkaKalkulator.png" width="27px" height="26px"/> Międzynarodowe
        </div>
        <div class="options_item--description">Do ponad 20 krajów! W tym USA i Kanada...</div>
        <nuxt-link to="miedzynarodowe" class="options_item--link" style="margin-top: 16px">Zobacz więcej</nuxt-link>
      </div>
      <div class="options_item" v-if="!isC2C">
        <div class="options_item--title">
          <NuxtImg src="icons/paletaKalkulator.png" width="42px" height="23px"/> Paletowe
        </div>
        <div class="options_item--description">Ćwierćpalety, półpalety, europalety i palety przemysłowe...</div>
        <nuxt-link to="paletowe" class="options_item--link">Zobacz więcej</nuxt-link>
      </div>
      <div class="options_item">
        <div class="options_item--title">
          <NuxtImg src="icons/niestandardKalkulator.png" width="26px" height="26px"/> Niestandardowe
        </div>
        <div class="options_item--description">Najlepsze rozwiązanie dla przesyłek o niestandardowych kształtach...</div>
        <nuxt-link to="niestandardowe" class="options_item--link">Zobacz więcej</nuxt-link>
      </div>
    </div>
  </div>

  <div class="options" v-show="showAboutUs" @mouseleave="showAboutUs = false;">
    <div class="options_items" v-show="showAboutUs">
      <div class="options_item">
        <div class="options_item--title">
          <NuxtImg src="icons/aboutUs/JakKorzystac.png" width="26px" height="26px"/> Jak korzystać z BLPaczka?
        </div>
        <div class="options_item--description">Zobacz jak łatwo przesyłać razem z nami</div>
        <nuxt-link-locale to="panel-klienta" class="options_item--link" style="margin-top: 16px">Zobacz więcej</nuxt-link-locale>
      </div>
      <div class="options_item">
        <div class="options_item--title">
          <NuxtImg src="icons/aboutUs/Aktualnosci.png" width="26px" height="26px"/> Aktualności
        </div>
        <div class="options_item--description">Nowości w BLPaczce i komunikaty przewoźników</div>
        <nuxt-link-locale to="aktualnosci" class="options_item--link">Zobacz więcej</nuxt-link-locale>
      </div>
      <div class="options_item">
        <div class="options_item--title">
          <NuxtImg src="icons/aboutUs/Blog.png" width="26px" height="26px"/> Blog
        </div>
        <div class="options_item--description">Informacje o logistyce i e-commerce</div>
        <nuxt-link-locale to="blog" class="options_item--link" style="margin-top: 16px">Zobacz więcej</nuxt-link-locale>
      </div>
      <div class="options_item">
        <div class="options_item--title">
          <NuxtImg src="icons/aboutUs/FAQ.png" width="26px" height="26px"/> FAQ
        </div>
        <div class="options_item--description">Odpowiedzi na najczęściej zadawane pytania</div>
        <nuxt-link-locale to="faq" class="options_item--link" style="margin-top: 16px">Zobacz więcej</nuxt-link-locale>
      </div>
    </div>
  </div>
</template>
<script setup lang="ts">
  import useC2CStore from "~/stores/useC2CStore";

  const { t } = useI18n();
  const showOptions = ref(false);
  const showPackages = ref(false);
  const showAboutUs = ref(false);
  const mainPageUrl = window.location.origin + '/'
  const { isC2C } = storeToRefs(useC2CStore());
</script>

<style scoped lang="scss">
.options {
  //min-height: 278px;
  width: 100%;
  background-color: #FFFFFF;
  box-shadow: 0px 24px 24px 0px #0000000A;
  position: fixed;
  z-index: 10;

  .options_items {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 16px;
    padding: 16px;

    .options_item {
        width: 300px;
        min-height: 136px;
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        gap: 16px;
        border-radius: 8px;
        padding: 16px;

      &--title {
        display: flex;
        align-items: center;
        gap: 8px;
        font-family: Open Sans;
        font-size: 16px;
        font-weight: 600;
        line-height: 21.6px;
        //color: #727272;
      }

      &--description {
        font-family: Open Sans;
        font-size: 12px;
        font-weight: 400;
        line-height: 16px;
        color: #727272;
        max-width: 360px;
      }

      &--link {
        display: flex;
        text-decoration: underline;
        font-family: Open Sans;
        font-size: 13.33px;
        font-weight: 700;
        line-height: 17.33px;
        text-align: right;
        color: #4285F4;
        cursor: pointer;
      }
    }
  }
}

.navigationMobile {
  @media screen and (max-width: 1024px) {
    display: block;
  }

  @media screen and (min-width: 1025px) {
    display: none;
  }
}

.hideOnMobile {
  @media screen and (max-width: 1024px) {
    display: none;
  }
}

.rightNavigation {
  flex-direction: row;
  margin-bottom: 16px;
  margin-top: 16px;
  gap: 16px;

  //@media screen and (max-width: 1024px) {
  //  flex-direction: row;
  //}
}

.smallNavigation {
  width: 100%;
  display: flex;
  justify-content: center;
  align-items: center;
  height: 50px;

  @media screen and (max-width: 799px) {
    &--centeredMobile {
      justify-content: center;
    }
  }

  &_item {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 6px;
    text-decoration: none;
    color: #727272;
    font-family: Open Sans;
    font-size: 11.11px;
    font-weight: 600;
    line-height: 15.13px;
    text-align: left;
  }
}

</style>