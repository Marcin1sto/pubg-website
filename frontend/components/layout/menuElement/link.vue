<script setup lang="ts">
const props = defineProps<{
  href: string;
  text: string;
}>();
</script>

<template>
  <nuxt-link-locale
      active-class="!text-[#45f882] before:content-[''] before:absolute before:w-[42px] before:h-px before:transition-all before:duration-[0.3s] before:ease-[ease-out] before:delay-[0s] before:mx-auto before:my-0 before:top-2/4 before:inset-x-0 before:bg-[#45f882] before:opacity-100 before:-translate-y-2/4 before:rotate-[-40deg]"
      exact-active-class="!text-[#45f882] "
      :to="href"
      class="text-[#fff] text-[15px] font-bold uppercase block leading-none relative tracking-[0.8px] z-[1] px-[23px] py-[38px] font-Barlow before:content-[''] before:absolute before:w-[42px] before:h-px before:-translate-y-2/4 before:rotate-0 before:opacity-0 before:transition-all before:duration-[0.3s] before:ease-[ease-out] before:delay-[0s] before:mx-auto before:my-0 before:top-2/4 before:inset-x-0 before:bg-[#45f882] group-hover:text-[#45f882]  group-hover:before:opacity-100 group-hover:before:-translate-y-2/4 group-hover:before:rotate-[-40deg]">
    {{ text }}
  </nuxt-link-locale>
</template>

<style scoped lang="scss">

</style>