<script setup lang="ts">
const props = defineProps<{
  text: string;
  items: any;
}>();

const router = useRouter();
const route = useRoute();

const activePage = computed(() => {
  if (route.path) return route.path.split('/');
  return '';
});
</script>

<template>
<!--  before:content-[''] before:absolute before:w-[42px] before:h-px before:transition-all before:duration-[0.3s] before:ease-[ease-out] before:delay-[0s] before:mx-auto before:my-0 before:top-2/4 before:inset-x-0 before:bg-[#45f882] text-[#45f882] before:opacity-100 before:-translate-y-2/4 before:rotate-[-40deg]-->
  <p class="cursor-pointer text-[15px] font-bold uppercase block leading-none relative tracking-[0.8px] z-[1] px-[23px] py-[38px] font-Barlow text-[#fff]">{{ text }}</p>
  <ul class="sub-menu absolute min-w-[230px] border border-[#22292f] origin-[0_0] transition-all duration-[0.3s] ease-[ease-out] delay-[0s] shadow-[0px_30px_70px_0px_rgba(0,0,0,0.15)] block invisible opacity-0 z-[9] m-0 px-0 py-[18px] rounded-none border-solid scale-x-100 scale-y-0 left-0 top-full bg-[#182029] group-hover:opacity-100 group-hover:visible group-hover:scale-100
                    lg:opacity-100 lg:visible lg:scale-100 lg:w-full lg:static lg:bg-[#0f161b] lg:border-none
                    md:opacity-100 md:visible md:scale-100 md:w-full md:static md:bg-[#0f161b] md:border-none
                    sm:opacity-100 sm:visible sm:scale-100 sm:w-full sm:static sm:bg-[#0f161b] sm:border-none
                    xsm:opacity-100 xsm:visible xsm:scale-100 xsm:w-full xsm:static xsm:bg-[#0f161b] xsm:border-none ">
    <li class=" text-left block ml-0 group/second" v-for="item in items">
      <nuxt-link-locale
          active-class="!text-[#45f882] "
          exact-active-class="!text-[#45f882] "
          :to="item.route" class="font-Barlow text-[15px] leading-[1.4] font-bold text-[#fff] uppercase tracking-[0.8px] relative flex pl-[25px] pr-[15px] py-[9px] before:content-[''] before:block before:h-[7px] before:bg-[#45f882] before:transition-[width] before:duration-[0.2s] before:ease-linear before:ml-0 before:mr-[9px] before:mt-[7px] before:mb-0 before:rounded-[0_5px_0_0] before:w-0 group-hover/second:before:w-[7px]">
        {{ item.title }}
      </nuxt-link-locale>
    </li>
  </ul>
</template>

<style scoped lang="scss">

</style>