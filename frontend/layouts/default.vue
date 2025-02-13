<script setup lang="ts">
useHead({
  titleTemplate: (titleChunk) => {
    return titleChunk ? `${ titleChunk } - Grywalnia` : 'Grywalnia';
  },
});

const router = useRouter();
const { getSelectedGame } = usePagesStore();
watch(router.currentRoute, () => {
  getSelectedGame(router.currentRoute.value.fullPath);
})

// const { getSelectedGame } = usePagesStore();

// import('public/assets/js/vendor/jquery-3.6.0.min.js');
// import('public/assets/js/jquery.magnific-popup.min.js');
// import('public/assets/js/jquery.countdown.min.js');
// import('public/assets/js/jquery.waypoints.min.js');
// import('public/assets/js/jquery.odometer.min.js');
// import('public/assets/js/simpleParallax.min.js');
// import('public/assets/js/jquery-ui.min.js');
// import('public/assets/js/gsap.min.js');
// import('public/assets/js/scrollTrigger.min.js');
// import('public/assets/js/splitText.min.js');
// import('public/assets/js/jquery.appear.js');
// import('public/assets/js/tg-cursor.min.js');
// import('public/assets/js/swiper-bundle.js');
// import('public/assets/js/jarallax.min.js');
// import('public/assets/js/parallax.min.js');
// import('public/assets/js/slick.min.js');
// import('public/assets/js/ajax-form.js');
// import('public/assets/js/vivus.min.js');
// import('public/assets/js/wow.min.js');
// import('~/assets/js/flowbite.min.js');
// import('~/assets/js/main.js');
</script>

<template>
  <LayoutMenu />
  <SectionsMainArea />
  <slot/>
  <SectionsJoinUs />
  <SectionsSocials />
  <LayoutFooter />
</template>

<style lang="css">
@import "~/assets/css/animate.min.css";
@import "~/assets/css/flaticon.css";
@import "~/assets/css/flowbite.min.css";
@import "~/assets/css/fontawesome-all.min.css";
@import "~/assets/css/jquery-ui.css";
@import "~/assets/css/magnific-popup.css";
@import "~/assets/css/odometer.css";
@import "~/assets/css/slick.css";
@import "~/assets/css/swiper-bundle.css";
@import "~/assets/css/tg-cursor.css";
@import "~/assets/css/style.css";
</style>