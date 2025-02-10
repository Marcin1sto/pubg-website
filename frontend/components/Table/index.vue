<template>
  <div class="table_statistics" v-if="useStatistics">
    <slot name="statistics"></slot>
  </div>
  <div class="table_paginationWrapper">
    <div class="table_paginationContainer" v-if="useAdditional">
      <slot name="additional"></slot>
    </div>
    <div class="table_paginationContainer" v-if="usePagination && countPages > 1">
      <button @click.prevent="firstPage" class="table_paginationItem" :class="page === 1 ? 'table_paginationItem--disabled' : ''">
      <NuxtImg src="icons/pagination/first.svg" height="14px"/>
      </button>
      <button @click.prevent="previousPage" class="table_paginationItem" :class="page === 1 ? 'table_paginationItem--disabled' : ''">
        <NuxtImg src="icons/pagination/prev.svg" height="14px"/>
      </button>
      <input class="table_paginationTxtPrimary" style="text-align: center;" :value="page" @change.prevent="changePageInput($event)">

      <span class="table_paginationTxtSecondary">z</span>
      <span class="table_paginationTxtSecondary">{{ countPages }}</span>
      <button @click.prevent="nextPage()" class="table_paginationItem" :class="page === countPages ? 'table_paginationItem--disabled' : ''">
        <NuxtImg src="icons/pagination/next.svg" height="14px"/>
      </button>
      <button @click.prevent="lastPage()" class="table_paginationItem" :class="page === countPages ? 'table_paginationItem--disabled' : ''">
        <NuxtImg src="icons/pagination/last.svg" height="14px"/>
      </button>
    </div>
  </div>
  <div style="padding-inline: 32px; padding-bottom: 32px;">
    <div style="overflow: auto; transform: rotateX(180deg);">
      <table class="table" id="table" style="transform: rotateX(180deg);">
        <TableHead :headers="tableHeaders" :use-checkbox="useCheckbox" :use-store="useStore"/>
        <TableBody :values="tableValueItems" :use-checkbox="useCheckbox" :use-store="useStore" :headers="tableHeaders" :items-from-cache="tableValueItems"/>
      </table>
    </div>
  </div>
  <div class="table_paginationWrapper" v-if="usePagination && countPages > 1">
    <div></div>
    <div class="table_paginationContainer">
      <button @click.prevent="firstPage" class="table_paginationItem"><NuxtImg src="icons/pagination/first.svg" height="14px"/></button>
      <button @click.prevent="previousPage" class="table_paginationItem"><NuxtImg src="icons/pagination/prev.svg" height="14px"/></button>
      <input class="table_paginationTxtPrimary" style="text-align: center;" :value="page" @change.prevent="changePageInput($event)">
      <span class="table_paginationTxtSecondary">z</span>
      <span class="table_paginationTxtSecondary">{{ countPages }}</span>
      <button @click.prevent="nextPage()" class="table_paginationItem"><NuxtImg src="icons/pagination/next.svg" height="14px"/></button>
      <button @click.prevent="lastPage()" class="table_paginationItem" :class="page === countPages ? 'table_paginationItem--disabled' : ''"><NuxtImg src="icons/pagination/last.svg" height="14px"/></button>
    </div>
  </div>
</template>

<script setup lang="ts">
import {useTableStore} from "~/stores/useTableStore";

const props = defineProps({
  useCheckbox: {
    type: Boolean as PropType<boolean>,
    default: false,
  },
  useStore: {
    type: Boolean as PropType<boolean>,
    default: true,
  },
  tableItems: {
      type: Array as PropType<any[]>,
      default: () => [],
  },
  tableHeaders: {
    type: Array as PropType<any[]>,
    default: () => [],
  },
  usePagination: {
    type: Boolean as PropType<boolean>,
    default: true,
  },
  useStatistics: {
    type: Boolean as PropType<boolean>,
    default: true,
  },
  useAdditional: {
    type: Boolean as PropType<boolean>,
    default: true,
  },
});

const { setUseCheckbox, updateCountItems, nextPage, lastPage, previousPage, firstPage } = useTableStore();
const { items, page, limit, countPages } = storeToRefs(useTableStore());

const tableValueItems = ref([]);
const tableHeaders = ref([]);

if (props.useStore) {
  setUseCheckbox(props.useCheckbox);
  updateCountItems();
  tableValueItems.value = items.value;
} else {
  setUseCheckbox(props.useCheckbox);
  items.value = props.tableItems;
  tableValueItems.value = props.tableItems;
  tableHeaders.value = props.tableHeaders;
}

watch(() => props.tableItems, (value) => {
  if (!props.useStore) {
    items.value = value;
    tableValueItems.value = value;
  }
});

const changePageInput = (event: Event) => {
    const target = event.target as HTMLInputElement;
    const value = parseInt(target.value);

    if (value > countPages.value) {
        page.value = countPages.value;
    } else if (value < 1) {
        page.value = 1;
    } else {
        page.value = value;
    }
    target.value = page.value;
}

</script>

<style scoped lang="scss">
.table {
  border-spacing: 0;
  border: 1px solid #F2F2F2;
  border-radius: 8px;
  box-shadow: 0 0 15px 0 #00000014;
  min-width: 1400px;
  width: 100%;

  @media screen and (max-width: 1400px) {
    min-width: 866px;
  }

  @media screen and (min-width: 1400px) {
    min-width: 900px;
  }
}

.table_statistics {
  display: flex;
  width: 100%;
  padding: 10px 32px;
  font-family: "Open Sans";
  font-size: 14px;
  font-weight: 400;
  line-height: 19.07px;
  text-align: left;
  color: #262B44;
}
</style>