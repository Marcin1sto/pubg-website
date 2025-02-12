<script setup lang="ts">
  import bgImage from '@/public/assets/img/bg/video_bg.jpg'
</script>

<template>
  <!-- video-area done -->
  <section class="video__area video-bg tg-jarallax bg-center bg-cover min-h-[565px] flex items-center relative z-[1] px-0 py-[100px] before:content-[''] before:absolute before:w-full before:h-full before:opacity-[0.22] before:z-[-1] before:left-0 before:top-0 after:content-[''] after:absolute after:w-full after:h-full after:bg-[url(./assets/img/bg/video\_overlay.png)] after:bg-center after:bg-cover after:opacity-[0.38] after:z-[-1] after:left-0 after:top-0 before:bg-[#1b242e]" :style="{backgroundImage: `url(${bgImage})`}" :data-background="bgImage">
    <div class="container">
      <div class="flex flex-wrap mx-[-15px]  justify-center ">
        <div class="w-6/12 basis-6/12 xl:w-6/12 xl:basis-6/12 lg:w-8/12 lg:basis-8/12 md:w-11/12 md:basis-11/12 sm:w-full sm:basis-full xsm:w-full xsm:basis-full relative px-[15px]">
          <div class="video__content text-center">
            <a href="https://www.youtube.com/watch?v=ssrNcwxALS4" class="popup-video inline-block text-[86px] leading-none shadow-[0px_5px_12px_0px_rgba(0,0,0,0.13)] text-[#fff] mt-0 mb-3.5 mx-0 hover:text-[#45f882]"><i class="flaticon-play"></i></a>
            <h2 class="title text-[55px] font-extrabold tracking-[3px] mt-0 mb-1.5 mx-0 drop-shadow-[0px_3px_7px_rgba(0,0,0,0.33)]
                            sm:text-[48px] sm:tracking-[1px] sm:leading-[1.1]
                            xsm:text-[48px] xsm:tracking-[1px] xsm:leading-[1.1]
                            ">WSTĄP DO <span class=" text-[#45f882]">EKIPY</span></h2>
            <p class=" text-[16px] font-medium text-[#fefefe] tracking-[0.9px] mt-0 mb-[30px] mx-0">I graj z nami w ulubione gry.</p>
            <a href="https://discord.com/" target="_blank" class="video__btn tg-btn-1"><span>Dołącz do Discorda</span></a>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- video-area-end -->

</template>

<style scoped lang="css">

</style>