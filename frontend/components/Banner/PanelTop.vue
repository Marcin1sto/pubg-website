<template>
  <div class="bannerTopCarousel" v-if="banners?.breakingnews?.length > 0 && panel_top_txt_banner_visible">
    <carousel :items-to-show="1" :autoplay="banners?.breakingnews?.length > 0 ? 10000 : 0" :wrap-around="true">
      <slide v-for="news in banners.breakingnews" :key="news.Banner.id">
        <nuxt-link-locale :to="news.Banner.url" class="bannerTopLink">
          <div class="bannerTop" v-html="news.Banner.name"></div>
        </nuxt-link-locale>
      </slide>
    </carousel>
    <svg width="34" height="34" viewBox="0 0 27 27" fill="none" xmlns="http://www.w3.org/2000/svg" class="bannerCloseIcon" @click="panel_top_txt_banner_visible = false">
      <rect x="0.121109" y="24.041" width="34" height="3" rx="1.5" transform="rotate(-45 0.121109 24.041)" fill="#ffffff"/>
      <rect x="2.12111" y="0.0410156" width="34" height="3" rx="1.5" transform="rotate(45 2.12111 0.0410156)" fill="#ffffff"/>
    </svg>
  </div>

  <div class="bannerTopCarousel" v-if="banners?.panel_top_images?.length > 0 && panel_top_images_visible">
    <carousel :items-to-show="1" :autoplay="banners?.panel_top_images?.length > 0 ? 10000 : 0" :wrap-around="true">
      <slide v-for="news in banners.panel_top_images" :key="news.Banner.id">
        <nuxt-link-locale :to="news.Banner.url" class="bannerTopImgWrapper">
          <NuxtImg :src="news.Banner.s3" class="bannerTopImg"/>
        </nuxt-link-locale>
      </slide>
    </carousel>
    <svg width="34" height="34" viewBox="0 0 27 27" fill="none" xmlns="http://www.w3.org/2000/svg" class="bannerCloseIcon" @click="panel_top_images_visible = false">
      <rect x="0.121109" y="24.041" width="34" height="3" rx="1.5" transform="rotate(-45 0.121109 24.041)" fill="#262B44"/>
      <rect x="2.12111" y="0.0410156" width="34" height="3" rx="1.5" transform="rotate(45 2.12111 0.0410156)" fill="#262B44"/>
    </svg>
  </div>
</template>

<script setup lang="ts">
import 'vue3-carousel/dist/carousel.css';
import {useBannersStore} from "~/stores/useBannerStore";
import useUserStore from "~/stores/useUserStore";
const { getBanners } = useBannersStore();
const { banners } = storeToRefs(useBannersStore());
const { panel_top_images_visible, panel_top_txt_banner_visible, userExternalData } = storeToRefs(useUserStore());

onMounted(() => {
  getBanners('breakingnews', userExternalData.value?.Broker?.consumer_account);
  getBanners('panel_top_images', userExternalData.value?.Broker?.consumer_account);
});
</script>

<style scoped lang="scss">
.bannerTop {
  padding: 16px 32px;
  text-align: center;
  font-family: "Open Sans", sans-serif;
  font-size: 16px;
  line-height: 18px;
  background: #4285F4;
  color: #ffffff;
  width: 100%;
  margin-bottom: 1px;
  text-decoration: none;
}

.bannerTopImgWrapper {
  width: 100%;
  margin: 0 auto 1px;
  position: relative;
  display: block;
}

.bannerTopLink {
  width: 100%;
  text-decoration: none;
}

.bannerTopImg {
  width: 100%;
  height: auto;
}

.bannerCloseIcon {
  cursor: pointer;
  position: absolute;
  top: 16px;
  right: 16px;
  width: 16px;
  height: 16px;
}

.bannerTopCarousel {
  width: calc(100vw - 284px);
  margin: 0 auto 1px;
  position: relative;

  @media screen and (max-width: 768px) {
    width: 100%
  }
}
</style>