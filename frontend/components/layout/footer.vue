<script setup lang="ts">
let currentDate = new Date();
let currentYear = currentDate.getFullYear();
</script>

<template>
  <footer class="footer-style-one">
    <div class="copyright__wrap px-0 py-5 bg-[#090d10]">
      <div class="container">
        <div class="flex flex-wrap mx-[-15px]  items-center ">
          <div class="w-7/12 basis-7/12 2xl:w-7/12 2xl:basis-7/12 xl:w-7/12 xl:basis-7/12 lg:w-7/12 lg:basis-7/12 md:w-7/12 md:basis-7/12 sm:w-full sm:basis-full xsm:w-full xsm:basis-full relative px-[15px]">
            <div class="copyright__text text-left sm:text-center xsm:text-center">
              <p class=" text-[14px] font-semibold uppercase text-[#9f9f9f] m-0 font-Barlow">Copyright © {{ currentYear }} - All Rights Reserved By <nuxt-link-locale to="aboutUs" class=" text-[#45f882]">This developers</nuxt-link-locale></p>
            </div>
          </div>
          <div class="w-5/12 basis-5/12 2xl:w-5/12 2xl:basis-5/12 xl:w-5/12 xl:basis-5/12 lg:w-5/12 lg:basis-5/12 md:w-5/12 md:basis-5/12 sm:w-full sm:basis-full xsm:w-full xsm:basis-full relative px-[15px]">
            <div class="copyright__card float-right sm:float-none sm:text-center sm:mt-[10px] sm:m-[0_auto] xsm:float-none xsm:text-center xsm:mt-[10px] xsm:m-[0_auto]">

            </div>
          </div>
        </div>
      </div>
    </div>
  </footer>
</template>

<style scoped lang="css">

</style>