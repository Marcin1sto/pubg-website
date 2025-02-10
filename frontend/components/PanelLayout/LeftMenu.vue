<template>
  <div class="left-menu mobile-hidden" :class="openedMenu ? 'menu-has-opened' : ''">
    <div style="position: sticky; top: 0">
      <nuxt-link-locale to="panel" v-if="!openedMenu"><IconLogoMini class="logo"/></nuxt-link-locale>
      <nuxt-link-locale to="panel" v-else ><NuxtImg src="icons/blpLogoMain.png" class="logo" width="200px" height="50px"/></nuxt-link-locale>
      <div class="beam"></div>
      <ul class="menu-items">
        <li v-for="item in menuItems" v-if="!isSemiUser" :class="openedMenu ? 'menu-items--long' : 'menu-items--short'">
          <ButtonMenuDropdown v-if="item.isDropdown" :item="item">{{ item.title }}</ButtonMenuDropdown>
          <ButtonMenu v-else @click="closeDropdowns()" :item="item">{{ item.title }}</ButtonMenu>
        </li>
      </ul>
      <div class="menu-swiper" :class="openedMenu ? 'gap-16' : 'menu-swiper--short'" @click="toggleMenu" v-if="!isSemiUser">
        <IconMenuClose v-if="openedMenu" class="close-icon"/>
        <IconMenuOpen v-else class="open-icon"/>
        <span>{{ openedMenu ? 'Zwiń' : 'Rozwiń'}}</span>
      </div>
      <nuxt-link-locale :to="firstBanner.url" v-show="openedMenu && Object.keys(firstBanner).length > 0">
        <img class="leftMenuBanner" width="200px" height="150px" :alt="firstBanner?.container_name" :src="firstBanner?.s3"/>
      </nuxt-link-locale>
    </div>
  </div>
</template>

<script setup lang="ts">
import useLeftMenuStore from "~/stores/useLeftMenuStore";
import {useBannersStore} from "~/stores/useBannerStore";

const { openedMenu, menuItems } = storeToRefs(useLeftMenuStore());
const { toggleMenu, closeDropdowns, findActiveMenu } = useLeftMenuStore();
const { isSemiUser } = storeToRefs(useAuthStore());
const { getBanners } = useBannersStore();
const { banners } = storeToRefs(useBannersStore());
const { userExternalData } = storeToRefs(useUserStore());
const firstBanner = ref({});

onMounted(async () => {
  findActiveMenu();
  getBanners('client_page', userExternalData.value?.Broker?.consumer_account);

  if (isSemiUser.value) {
    openedMenu.value = false;
  }
})

watch(() => banners.value, (newVal) => {
  if (!banners?.value?.client_page) return;
    firstBanner.value = banners?.value?.client_page[0].Banner;
}, { deep: true})
</script>

<style scoped lang="scss">
.close-icon {
  color: #000000;
  cursor: pointer;
}

.open-icon {
  color: #000000;
  cursor: pointer;
}

.menu-swiper {
  display: flex;
  justify-content: center;
  align-items: center;
  height: auto;
  padding: 10px;
  max-width: 200px;
  margin-top: 20px;

  &--short {
    flex-direction: column;
  }
}

.gap-16 {
  gap: 16px;
}

.menu-has-opened {
  flex: 0 0 264px !important;

  .menu-items {
    min-width: 200px;
  }

  .beam {
    min-width: 200px !important;
  }

  .menu-swiper {
    min-width: 200px !important;
  }
}

.left-menu {
  background-color: #F2F5FB;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  min-height: 100vh;
  margin: 0;
  max-width: 264px;
  min-width: 104px;
  display: flex;
  flex-direction: column;
  align-items: center;
  font-family: Open Sans, sans-serif;
  font-size: 13.33px;
  line-height: 18.15px;
  flex: 0 0 104px;
  z-index: 4;

  .logo {
    margin-top: 34px;
    margin-bottom: 34px;
    max-width: 200px;
  }

  .beam {
    height: 1px;
    max-width: 200px;
    min-width: 40px;
    background-color: rgba(204, 207, 218, 1);
  }

  .menu-items {
    margin-top: 34px;
    max-width: 200px;
    width: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;

    &--long {
      width: 200px;
    }

    &--short {
      width: 44px;
    }

    li {
      list-style: none;
    }
  }

  .leftMenuBanner {
    border-radius: 8px;
    overflow: hidden;
    width: 100%;
    height: 100%;
    max-width: 200px;
    max-height: 150px;
    margin-top: 16px;
  }
}
</style>