<script setup lang="ts">
import bgImage from '@/public/assets/img/bg/team_bg.jpg'

const { selectedGame } = storeToRefs(usePagesStore())
const { getPageSubTitle } = usePagesStore()
const {t} = useI18n()
</script>

<template>
  <main class="main--area overflow-x-hidden">
    <!-- slider-area done -->
    <section class="slider__area slider__bg bg-center bg-cover z-[1] pt-[158px] pb-[54px] px-0 relative after:right-0 before:content-[''] before:absolute before:w-6/12 before:bg-[#45f882] before:h-[50px] before:left-0 before:bottom-0 before:clip-path-polygon-[0_0,_0_100%,_100%_100%] after:content-[''] after:absolute after:w-6/12 after:bg-[#45f882] after:h-[50px] after:left-auto after:bottom-0 after:clip-path-polygon-[100%_0,_0_100%,_100%_100%]
        xl:before:h-[40px] xl:after:h-[40px]
        lg:before:h-[30px] lg:after:h-[30px]
        md:before:h-[30px] md:after:h-[30px]
        sm:before:h-[20px] sm:after:h-[20px]
        xsm:before:h-[20px] xsm:after:h-[20px]
        "
             :style="{ backgroundImage: `url(${bgImage})`}"
             :data-background="bgImage">
      <div class="slider-activee">
        <div class="single-slider">
          <div class="container custom-container">
            <div class="flex flex-wrap mx-[-15px] justify-between">
              <div class="w-6/12 basis-6/12 xxl:w-6/12 xxl:basis-6/12 xl:w-6/12 xl:basis-6/12 lg:w-6/12 lg:basis-6/12 md:w-full md:basis-full sm:w-full sm:basis-full  xsm:w-full xsm:basis-full relative px-[15px]">
                <div class="slider__content relative z-[2] ml-10 mr-0 mt-[135px] mb-0 xl:m-[90px_0_0_0] text-left

                                2xl:mt-[135px] 2xl:mb-0 2xl:mx-0
                                xl:mt-[90px]  xl:xl:mb-0 mx-0
                                lg:m-[90px_0_0_0]
                                md:text-center md:mt-0 md:mb-[70px] md:mx-0
                                sm:mt-0 sm:mb-[50px] sm:mx-0 sm:text-center
                                xsm:mt-0 xsm:mb-[50px] xsm:mx-0 xsm:text-center
                                ">
                  <h6 class="sub-title leading-none font-bold tracking-[4px] text-[20px] text-[#45f882] relative mt-0 mb-[19px] mx-0 pl-5 pr-0 py-[17px] before:content-[''] before:absolute before:bg-[url(./assets/img/slider/text\_gradient\_bg.png)] before:w-full before:h-full before:bg-no-repeat before:z-[-1] before:opacity-[0.28] before:left-0 before:top-0 font-Poppins wow fadeInUp
                                    lg:text-base lg:pl-5 lg:pr-0 lg:py-[15px] lg:before:bg-contain
                                    md:text-lg md:px-5 md:py-[15px] md:before:w-[297px] md:before:mx-auto  md:before:my-0 md:before:left-[86px] md:before:right-0  md:before:top-0 md:before:bg-contain
                                    sm:text-[17px] sm:px-5 sm:py-[15px] sm:before:w-64 sm:before:mx-auto sm:before:my-0 sm:before:left-[55px] sm:before:top-0 sm:before:right-0 sm:before:bg-contain
                                    xsm:text-[17px] xsm:px-5 xsm:py-[15px] xsm:before:w-64 xsm:before:mx-auto xsm:before:my-0 xsm:before:left-[55px] xsm:before:top-0 xsm:before:right-0 xsm:before:bg-contain
                                    " data-wow-delay=".2s">Czas na</h6>
                  <h2 class="title text-[150px] leading-[0.8] mt-0 mb-[21px] mx-0 font-berlin
                                    drop-shadow-[-1px_5px_0px_rgba(69,248,130,0.66)] wow fadeInUp
                                    md:text-[120px]
                                    lg:text-[94px]
                                    xl:text-[118px]
                        sm:text-[14vw] sm:drop-shadow-[-1px_5px_0px_rgba(69,248,130,0.66)] sm:mt-0 sm:mb-[21px] sm:mx-0
                        xsm:text-[14vw] xsm:drop-shadow-[-1px_5px_0px_rgba(69,248,130,0.66)] xsm:mt-0 xsm:mb-[21px] xsm:mx-0
                                    " data-wow-delay=".5s">{{ getPageSubTitle() ? getPageSubTitle() : (selectedGame ? t('games-names.'+selectedGame) : 'Granie') }}</h2>
                </div>
              </div>
              <div class="w-6/12 basis-6/12 xxl:w-5/12 xxl:basis-5/12 xl:w-5/12 xl:basis-5/12 lg:w-6/12 lg:basis-6/12 md:w-full md:basis-full sm:w-full sm:basis-full xsm:w-full xsm:basis-full relative px-[15px]">
                <div class="slider__img text-center">
                  <img class=" mx-auto my-0 max-w-full
                                        md:mx-auto md:my-0
                                        lg:ml-auto lg:mr-0 lg:my-0
                                        sm:mx-auto sm:my-0
                                        xsm:mx-auto xsm:my-0
                                        max-h-[600px] max-w-[600px] object-cover
                                    " :src="selectedGame ? `/assets/img/games/${selectedGame}.png` : '/assets/img/slider/slider_img01.png'" data-magnetic alt="gameimage">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="slider__shapes opacity-[0.27]">
        <img src="/assets/img/slider/slider_shape01.png" alt="shape" class=" absolute animate-[shapeBlinker_1.5s_linear_infinite] opacity-0 z-[-1] left-[23%] top-[17%] delay-[0.2s]
                md:left-[13%] md:top-[12%]
                sm:left-[11%] sm:top-[11%]
                xsm:left-[11%] xsm:top-[11%]
                ">
        <img src="/assets/img/slider/slider_shape02.png" alt="shape" class=" absolute animate-[shapeBlinker_1.5s_linear_infinite] opacity-0 z-[-1] left-[29%] bottom-[45%] delay-[0.4s]
                md:left-[12%] md:bottom-[45%]
                sm:left-[10%] sm:bottom-[55%]
                xsm:left-[10%] xsm:bottom-[55%]">
        <img src="/assets/img/slider/slider_shape03.png" alt="shape" class=" absolute animate-[shapeBlinker_1.5s_linear_infinite] opacity-0 z-[-1] right-[47%] top-[20%] delay-[0.2s]
                md:right-[23%] md:top-[15%]
                sm:right-[10%] sm:top-[17%]
                xsm:right-[10%] xsm:top-[17%]">
        <img src="/assets/img/slider/slider_shape04.png" alt="shape" class=" absolute animate-[shapeBlinker_1.5s_linear_infinite] opacity-0 z-[-1] right-[42%] top-[23%] delay-[0.6s]
                xl:right-[40%] xl:top-[28%]
                lg:right-[40%] lg:top-[28%]
                md:right-[20%] md:top-[35%]
                sm:right-[14%] sm:top-[33%]
                xsm:right-[14%] xsm:top-[33%]">
      </div>
    </section>
    <!-- slider-area-end -->

  </main>
</template>

<style scoped lang="css">

</style>