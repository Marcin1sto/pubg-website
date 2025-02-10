<template>
  <div class="navigation navigation--lp">
    <div class="navigation_row">
      <nuxt-link-locale to="/"><NuxtImg src="icons/blpLogoMain.png" class="navigation_logo navigation_logo--lp"/></nuxt-link-locale>
    </div>

    <div class="navigation_row rightNavigation rightNavigation--lp">
      <nuxt-link-locale to="register" class="navigation_buttonPrimary">{{ t('page.register.btnTitle') }}</nuxt-link-locale>
    </div>
  </div>
</template>
<script setup lang="ts">
const { t } = useI18n();

const showOptions = ref(false);
const showPackages = ref(false);

const mainPageUrl = window.location.origin + '/'
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
}

.rightNavigation--lp {
  @media (max-width: 599px) {
    display: none;
  }
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