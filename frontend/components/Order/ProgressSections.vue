<script setup lang="ts">
  import useOrderFormV2Store from "~/stores/panel/useOrderFormStore";

  const {
    form,
    sectionsDone,
  } = storeToRefs(useOrderFormV2Store());
</script>

<template>
  <div class="orderForm_stepper">
    <ul class="orderForm_stepperList">
      <li class="orderForm_stepperListItem">
        <a href="#przesylka" class="orderForm_stepperLink">
          <IconStatus :color="sectionsDone.packages.color" class="orderForm_stepperCheck"/>
          <span class="orderForm_stepperTxt">Przesyłka</span>
        </a>
        <NuxtImg src="icons/orderForm/arrow.png" width="30px" height="12px" class="orderForm_stepperArrow"/>
      </li>
      <li class="orderForm_stepperListItem">
        <a href="#uslugi" class="orderForm_stepperLink">
          <IconStatus :color="sectionsDone.services.color" class="orderForm_stepperCheck"/>
          <span class="orderForm_stepperTxt">Usługi</span>
        </a>
        <NuxtImg src="icons/orderForm/arrow.png" width="30px" height="12px" class="orderForm_stepperArrow"/>
      </li>
      <li class="orderForm_stepperListItem">
        <a href="#kurier" class="orderForm_stepperLink">
          <IconStatus :color="sectionsDone.courier.color" class="orderForm_stepperCheck"/>
          <span class="orderForm_stepperTxt">Kurier</span>
        </a>
        <NuxtImg src="icons/orderForm/arrow.png" width="30px" height="12px" class="orderForm_stepperArrow"/>
      </li>
      <li class="orderForm_stepperListItem">
        <a href="#nadanie" class="orderForm_stepperLink">
          <IconStatus :color="sectionsDone.sender.color" class="orderForm_stepperCheck"/>
          <span class="orderForm_stepperTxt">Nadanie</span>
        </a>
        <NuxtImg src="icons/orderForm/arrow.png" width="30px" height="12px" class="orderForm_stepperArrow"/>
      </li>
      <li class="orderForm_stepperListItem">
        <a href="#doreczenie" class="orderForm_stepperLink">
          <IconStatus :color="sectionsDone.recipient.color" class="orderForm_stepperCheck"/>
          <span class="orderForm_stepperTxt">Doręczenie</span>
        </a>
        <NuxtImg src="icons/orderForm/arrow.png" width="30px" height="12px" class="orderForm_stepperArrow"/>
      </li>
      <li class="orderForm_stepperListItem">
        <a href="#podsumowanie" class="orderForm_stepperLink">
          <IconStatus :color="sectionsDone.summary.color" class="orderForm_stepperCheck"/>
          <span class="orderForm_stepperTxt">Podsumowanie</span>
        </a>
      </li>
    </ul>
  </div>
</template>

<style scoped>

</style>