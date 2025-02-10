<template>
  <div class="mobile-top-menu">
    <div class="upper-beam">
      <nuxt-link-locale to="panel">
        <NuxtImg src="icons/blpLogoMain.png" class="logo"/>
      </nuxt-link-locale>
      <IconMenuHamburger v-if="!openedMobileMenu" @click="openedMobileMenu = !openedMobileMenu"/>
      <IconMenuMobileClose v-if="openedMobileMenu" @click="openedMobileMenu = !openedMobileMenu"/>
    </div>
    <div class="expanded-menu" :style="openedMobileMenu ? 'display: block' : 'display: none'">
      <div class="menu-items">
        <div v-for="item in menuItems" @click="toggleDropdown(menuItems.indexOf(item))">
          <div class="promotion-button" v-if="item.route === 'panel'">
            <nuxt-link-locale to="panel" class="navigation_buttonPrimary" @click="openedMobileMenu = false">
              {{ t('button.sendParcel') }}
            </nuxt-link-locale>
          </div>
          <div class="menu-item" v-else>
            <nuxt-link-locale v-if="!item.isDropdown" :to="item.route" class="beam" @click="openedMobileMenu = false">{{ item.title }}</nuxt-link-locale>
            <div class="beam" v-else>
              <span>{{ item.title }}</span>
              <IconArrowDown />
            </div>
            <div class="dropdown-items" v-if="item.isDropdown && item.isOpened">
              <ul class="items-list">
                <li v-for="(subItem, index) in item.items" @click="changeActiveSubItem(index, menuItems.indexOf(item), true)">
                  <nuxt-link-locale :to="subItem.route">{{ subItem.title }}</nuxt-link-locale>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="promotion-button">
        <button class="navigation_buttonSecondary" @click="logoutUser">
          {{ t('button.logout') }}
        </button>
      </div>
    </div>
  </div>
  <div class="top-menu" :style="!openedMobileMenu ? 'display: flex' : 'display: none'">
    <div class="left-section">
      <div class="page-title">
        <h2>{{ store.getPageName }}</h2>
      </div>
    </div>
    <div class="right-section">
      <nuxt-link-locale to="panel-user-notifications">
        <div class="section-item">
          <PanelLayoutTopMenuCircle :is-right="true" :is-red="true">
            <IconBell/>
            <template #badge>
              <UtilsBadge
                  color="red"
                  v-if="notificationsCount > 0">{{notificationsCount}}</UtilsBadge>
            </template>
          </PanelLayoutTopMenuCircle>
        </div>
      </nuxt-link-locale>
<!--      <nuxt-link-locale to="#" class="search-section">-->
<!--        <div class="section-item">-->
<!--          <PanelLayoutTopMenuCircle>-->
<!--            <IconLoupe/>-->
<!--          </PanelLayoutTopMenuCircle>-->
<!--        </div>-->
<!--      </nuxt-link-locale>-->
      <nuxt-link-locale to="panel-bank" @click="clickOnAnotherRoute" v-if="!isSemiUser">
        <div class="section-item">
          <PanelLayoutTopMenuCircle>
            <IconPiggyCoin/>
            <template #badge>
              <UtilsBadge>{{ formatBalance() }} zł</UtilsBadge>
            </template>
          </PanelLayoutTopMenuCircle>
        </div>
      </nuxt-link-locale>
      <nuxt-link-locale to="panel-order-shopping-cart" @click="clickOnAnotherRoute" v-if="!isSemiUser">
        <div class="section-item">
          <PanelLayoutTopMenuCircle
            :is-red="true"
            :is-right="true"
          >
            <IconShoppingCart/>
            <template #badge>
              <UtilsBadge
                  color="red"
                  v-if="preOrder?.length > 0">{{ preOrder.length }}</UtilsBadge>
            </template>
          </PanelLayoutTopMenuCircle>
        </div>
      </nuxt-link-locale>
<!--      <nuxt-link-locale to="#">-->
<!--        <div class="section-item">-->
<!--          <PanelLayoutTopMenuCircle>-->
<!--            <IconBell/>-->
<!--          </PanelLayoutTopMenuCircle>-->
<!--        </div>-->
<!--      </nuxt-link-locale>-->
      <PanelLayoutUserDropDown />
    </div>
  </div>
</template>

<script setup lang="ts">
import useLeftMenuStore from "~/stores/useLeftMenuStore";
import {storeToRefs} from "pinia";
import useUserStore from "~/stores/useUserStore";
import usePreOrderStore from "~/stores/panel/usePreOrderStore";
import usePageStore from "~/stores/usePageStore";
import useNotificationsStore from "~/stores/panel/useNotificationsStore";
import {useAuthStore} from "~/stores/useAuthStore";

const { notificationsCount } = storeToRefs(useNotificationsStore());

const {t} = useI18n();
const router = useRouter();
const {clickOnAnotherRoute, toggleDropdown, changeActiveSubItem, toggleMenu} = useLeftMenuStore();
const {openedMobileMenu, menuItems} = storeToRefs(useLeftMenuStore());
const { balance } = storeToRefs(useUserStore());
const { formatBalance } = useUserStore();
const { preOrder } = storeToRefs(usePreOrderStore());
const { authenticated, isSemiUser } = storeToRefs(useAuthStore());
const store = usePageStore();
const { logout } = useAuthStore();

const logoutUser = async (e) => {
  e.preventDefault();

  let loggedOut = await logout();

  if (loggedOut || !authenticated) {
    await router.push('/logowanie');
  }
}
</script>

<style lang="scss">
@import "assets/styles/mobile.scss";

.mobile-top-menu {
  display: none;
  z-index: 200;
  top: 0;
  right: 0;
  left: 0;
  background-color: white;
  position: sticky;

  @media screen and ((max-width: 768px) or (max-height: 700px)) {
    display: block;

    .expanded-menu {
      left: 0;
      right: 0;
      background-color: white;
      height: calc(100vh - 83px);
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

    .promotion-button {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 104px;
      gap: 8px;
      padding: 16px;
      color: white;
      font-size: 14px;
      line-height: 19px;
      border-bottom: 1px solid #F2F2F2;
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
    padding: 0 32px;
    position: sticky;
    top: 81px;
    border-bottom: 1px solid #F2F2F2;
    background-color: #ffffff;
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
    justify-content: flex-end;
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