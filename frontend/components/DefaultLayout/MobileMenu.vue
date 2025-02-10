<template>
  <div class="mobileMenu">
    <div class="upper-beam">
      <nuxt-link-locale to="/" @click="openedMobileMenu = false">
        <NuxtImg src="icons/blpLogoMain.png" class="logo" width="200px" height="50px"/>
      </nuxt-link-locale>

      <div class="navigation_mobileButtonsWrapper">
        <nuxt-link-locale to="login" class="navigation_buttonSecondary" @click="openedMobileMenu = false">Zaloguj się</nuxt-link-locale>
        <nuxt-link-locale to="register" class="navigation_buttonPrimary" @click="openedMobileMenu = false">{{ t('page.register.btnTitle') }}</nuxt-link-locale>
        <IconMenuHamburger v-if="!openedMobileMenu" @click="openedMobileMenu = !openedMobileMenu"/>
        <IconMenuMobileClose v-if="openedMobileMenu" @click="openedMobileMenu = !openedMobileMenu"/>
      </div>
    </div>
    <div class="expanded-menu" :style="openedMobileMenu ? 'display: block' : 'display: none'">
      <div class="promotion-buttonMobileMenu"><nuxt-link-locale to="login" class="navigation_buttonSecondary" @click="openedMobileMenu = false">Zaloguj się</nuxt-link-locale></div>
      <div class="promotion-buttonMobileMenu"><nuxt-link-locale to="register" class="navigation_buttonPrimary" @click="openedMobileMenu = false">{{ t('page.register.btnTitle') }}</nuxt-link-locale></div>

      <div class="menu-items">
        <div class="menu-item"><a :href="mainPageUrl + '#kalkulatorWyceny'" class="beam" @click="openedMobileMenu = false">Nadaj paczkę</a></div>

        <div class="menu-item">
          <div class="beam" @click="showPackages = !showPackages">
            <span>Oferta</span>
            <IconArrowDown />
          </div>
          <div class="dropdown-items" v-show="showPackages">
            <ul class="items-list">
              <li><nuxt-link to="krajowe" @click="openedMobileMenu = false">Krajowe</nuxt-link></li>
              <li><nuxt-link to="miedzynarodowe" @click="openedMobileMenu = false">Międzynarodowe</nuxt-link></li>
              <li><nuxt-link to="paletowe" @click="openedMobileMenu = false">Paletowe</nuxt-link></li>
              <li><nuxt-link to="niestandardowe" @click="openedMobileMenu = false">Niestandardowe</nuxt-link></li>
            </ul>
          </div>
        </div>

        <div class="menu-item">
          <div class="beam" @click="showPackages = !showPackages">
            <span>O nas</span>
            <IconArrowDown />
          </div>
          <div class="dropdown-items" v-show="showPackages">
            <ul class="items-list">
              <li><nuxt-link-locale to="panel-klienta" @click="openedMobileMenu = false">Jak korzystać z BLPaczka?</nuxt-link-locale></li>
              <li><nuxt-link-locale to="aktualnosci" @click="openedMobileMenu = false">Aktualności</nuxt-link-locale></li>
              <li><nuxt-link-locale to="blog" @click="openedMobileMenu = false">Blog</nuxt-link-locale></li>
              <li><nuxt-link-locale to="faq" @click="openedMobileMenu = false">FAQ</nuxt-link-locale></li>
            </ul>
          </div>
        </div>

        <div class="menu-item"><nuxt-link-locale to="contact"  class="beam" @click="openedMobileMenu = false">Kontakt</nuxt-link-locale></div>

        <div class="menu-item"><nuxt-link-locale to="blog"  class="beam" @click="openedMobileMenu = false">Blog</nuxt-link-locale></div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">

const {t} = useI18n();
const mainPageUrl = window.location.origin + '/';
const showPackages = ref(false);
const openedMobileMenu = ref(false);

</script>

<style lang="scss">
@import "assets/styles/mobile.scss";

.mobileMenu {
  display: none;
  z-index: 200;
  top: 0;
  right: 0;
  left: 0;
  background-color: white;
  position: sticky;

  @media (max-width: 1269px) {
    display: block;

    .expanded-menu {
      left: 0;
      right: 0;
      background-color: white;
      height: calc(100vh - 105px);
      overflow: auto;
    }

    .upper-beam {
      padding: 24px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      cursor: pointer;
      border-bottom: 1px solid #F2F2F2;
    }

    .promotion-buttonMobileMenu {
      display: none;
      justify-content: flex-start;
      align-items: center;
      height: 104px;
      gap: 8px;
      padding: 16px;
      color: white;
      font-size: 14px;
      line-height: 19px;
      border-bottom: 1px solid #F2F2F2;

      @media (max-width: 819px) {
        display: flex;
        justify-content: center;
      }

      .navigation_buttonPrimary, .navigation_buttonSecondary {
        text-align: center;
        width: 265px;
      }
    }

    .menu-items {
      display: flex;
      flex-direction: column;
      gap: 8px;

      .menu-item {
        padding-inline: 24px;
        border-bottom: 1px solid #F2F2F2;

        .beam {
          min-height: 70px;
          display: flex;
          justify-content: space-between;
          align-items: center;
          text-decoration: none;
          color: black;
        }

        span {
          font-size: 16px;
          line-height: 21px;
          cursor: pointer;
        }

        .dropdown-items {
          width: 200px;
          margin-bottom: 24px;

          .items-list {
            list-style-type: none;
            padding: 0;
            margin: 0;

            li {
              font-size: 14px;
              line-height: 32px;
              padding: 8px 16px;
              cursor: pointer;

              a {
                text-decoration: none;
                color: #262B44;

                &:hover {
                  color: rgba(66, 133, 244, 1);
                }
              }
            }

            .router-link-active {
              color: rgba(66, 133, 244, 1);
            }
          }

          &:has(.router-link-active) {
            display: block;
          }
        }
      }
    }
  }
}

.top-menu {
  padding-left: 32px;
  margin-top: 20px;
  height: 83px;
  display: flex;
  justify-content: space-between;
  align-items: center;

  @media (max-width: 768px) {
    padding: 0;
  }
}

.left-section {
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 32px;

  @media (max-width: 768px) {
    display: none;
  }
}

.right-section {
  height: 100%;
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 32px;
  padding: 0 32px;
  border-radius: 0 0 0 8px;

  @media (max-width: 768px) {
    //background-color: rgba(242, 245, 251, 1);
    width: 100%;
    border-radius: 0;
    padding: 0;
  }

  .section-item {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 8px;
    font-size: 14px;
    line-height: 19px;
    cursor: pointer;

    .blue {
      color: rgba(66, 133, 244, 1);
    }
  }

  a {
    text-decoration: none;
    color: rgba(66, 133, 244, 1);
  }
}

.search-section {
  @media (max-width: 768px) {
    display: none;
  }
}

</style>