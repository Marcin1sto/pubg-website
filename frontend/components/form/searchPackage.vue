<script setup lang="ts">
  import useCartOrderStore from "~/stores/panel/useCartOrderStore";

  const searchValue = ref('');
  const { searchParams } = storeToRefs(useCartOrderStore());
  const { getCartOrders } = useCartOrderStore();
  const router = useRouter();
  const nuxt = useNuxtApp();

  const search = async () => {
    searchParams.value = {
      'CartOrder[numer]': searchValue.value,
    };
    if (searchValue.value !== '') {
      await getCartOrders();

      router.push(nuxt.$localePath('panel-order'));
    }
  }

  const timeout = ref(null);
  const loading = ref(false);
  const startTimer = () => {
    loading.value = true;
    if (timeout.value) {
      clearTimeout(timeout.value);
    }

    timeout.value = setTimeout(() => {
      loading.value = false;
      search();
    }, 1000);
  }
</script>

<template>
  <div class="orderDetails_searchContainer">
    <span class="orderDetails_searchInputContainer">
      <input type="text" placeholder="Szukaj numeru zamówienia" class="orderDetails_searchInput" v-model="searchValue" @keyup.enter="search()" @input="startTimer">
      <button>
        <NuxtImg v-if="!loading" src="icons/orderDetails/search.png" width="21px" height="21px" class="orderDetails_searchButton"/>
        <NuxtImg v-if="loading" src="gif/animation-02.gif" width="28px" height="28px" class="orderDetails_searchButton"/>
      </button>
    </span>
    <slot name="rightAction"></slot>
  </div>
</template>