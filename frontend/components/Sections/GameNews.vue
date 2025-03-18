<script setup lang="ts">
const route = useRoute();
// const newsLink = route.meta.find((meta) => meta.newsLink)?.newsLink;
</script>

<template>
  <!-- about-area done -->
  <section
      class="about__area-two pt-[160px]  pb-[190px] lg:p-[120px_0_25px] md:p-[120px_0_25px] sm:p-[120px_0_25px] xsm:p-[120px_0_25px]">
    <div class="container">
      <div class="flex flex-wrap mx-[-15px]  justify-center   items-center ">
        <div
            class="w-6/12 basis-6/12 xl:w-6/12 xl:basis-6/12 lg:w-6/12 lg:basis-6/12 md:w-full md:basis-full sm:w-full sm:basis-full xsm:w-full xsm:basis-full relative px-[15px] order-2 xl:order-2 lg:order-2 md:order-none sm:order-none xsm:order-none">
          <div class="about__funFact-images relative max-w-[511px] z-[1] ml-auto mr-[25px] mt-[60px] mb-0 after:content-[''] after:absolute after:w-full after:h-[calc(100%_+_15px)] after:rotate-[5deg] after:origin-bottom-right after:transition-all after:duration-[0.3s] after:ease-[ease-out] after:delay-[0s] after:opacity-[0.84] after:z-[-1] after:right-0 after:bottom-0 hover:after:rotate-0 hover:after:h-[calc(100%_+_0px)] after:bg-[#45f882]
                        md:max-w-[510px] md:mt-[60px] md:mb-[30px] md:mx-auto
                        sm:max-w-[480px] sm:ml-0 sm:mr-10 sm:mt-[60px] sm:mb-[30px]
                        xsm:max-w-[400px] xsm:m-[60px_25px_30px_0]
                        ">
            <img src="/assets/img/others/fun_fact_shape.png" alt="background" class="bg-shape">
            <img src="/assets/img/others/fun_fact.png" class="main-img absolute max-w-[382px] mx-auto my-0 bottom-0 inset-x-0
                            lg:max-w-[315px]
                            md:max-w-[350px]
                            sm:max-w-[260px]
                            xsm:max-w-[260px]
                            " alt="image">
          </div>
          <div class="about__funFact-trophy flex flex-row-reverse justify-start items-center ml-0 mr-[25px] mt-[35px] mb-0
                        md:max-w-[510px] md:m-[35px_auto_40px]
                        sm:m-[35px_25px_40px_auto]
                        xsm:m-[35px_25px_40px_auto]
                        ">
<!--            <div-->
<!--                class="icon relative z-[1] ml-[22px] after:content-[''] after:absolute after:-translate-x-2/4 after:-translate-y-2/4 after:bg-[url(./assets/img/icons/trophy\_color.png)] after:w-[95px] after:h-24 after:bg-center after:bg-contain after:bg-no-repeat after:z-[-1] after:left-2/4 after:top-2/4">-->
<!--              <img class=" max-h-10" src="/assets/img/icons/trophy.png" alt="trophy">-->
<!--            </div>-->
<!--            <div class="content text-right">-->
<!--              <h5 class=" text-[22px] mt-0 mb-0.5 mx-0">Tournament</h5>-->
<!--              <span class=" block uppercase text-[14px] font-medium">Development</span>-->
<!--            </div>-->
          </div>
        </div>
        <div
            class="w-6/12 basis-6/12 xl:w-6/12 xl:basis-6/12 lg:w-6/12 lg:basis-6/12 md:w-10/12 md:basis-10/12 sm:w-full sm:basis-full xsm:w-full xsm:basis-full relative px-[15px]">
          <div
              class="section__title mb-[30px] text-left  relative after:content-[''] after:block after:bg-[url(./assets/img/bg/title\_shape.svg)] after:w-[65px] after:h-[5px] after:mt-5 after:mb-0 after:mx-0">
            <h3 class="title  text-[45px] font-extrabold tracking-[1px] m-0 leading-[1.15] sm:text-[35px] xsm:text-[35px]">
              Update alert</h3>
          </div>
          <div class="about__content-two" v-html="route.meta?.newsDesc">
          </div>
          <div class="about__content-bottom flex flex-row-reverse justify-end items-center relative mt-[50px] mb-0 mx-0 lg:m-[40px_0_0] lg:items-start
                            sm:items-start sm:flex-col-reverse sm:gap-y-[30px] sm:m-[40px_0_0]
                            xsm:items-start xsm:flex-col-reverse xsm:gap-y-[30px] xsm:m-[40px_0_0]">
            <div class="about__funFact-wrap grow">
              <div v-if="route.meta?.newsLink" class="about__content-btns flex items-center gap-[20px_30px] mt-10 mb-0 mx-0">
                <a :href="route.meta?.newsLink" target="_blank" class="tg-btn-3 tg-svg hover:opacity-500">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 152.29 47" class="svg-icon" id="svg-2">
                    <path id="shape02" class="cls-1" d="M1.13,24l12-23h125l13,22-13,23h-125Z"/>
                  </svg>
                  <span>Czytaj więcej</span>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- about-area-end -->
</template>

<style scoped lang="css">

</style>