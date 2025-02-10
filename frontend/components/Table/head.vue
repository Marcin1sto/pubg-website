<script setup lang="ts">
import {useTableStore} from "~/stores/useTableStore";
import {storeToRefs} from "pinia";

const { headers, useCheckbox, selectAll } = storeToRefs(useTableStore());
const { toggleAll } = useTableStore();

const props = defineProps({
  useStore: {
    type: Boolean as PropType<boolean>,
    default: true,
  },
  headers: {
    type: Array as PropType<any[]>,
    default: () => [],
  },
});

const tableHeaders = ref([]);

if (!props.useStore) {
  tableHeaders.value = props.headers;
} else {
  tableHeaders.value = headers.value;
}

</script>

<template>
  <thead class="table_head">
  <tr>
    <th v-if="useCheckbox" class="table_headColumn table_headColumn--checkbox">
      <InputCheckbox @change="toggleAll" :selected="selectAll"/>
    </th>
    <th v-for="item in tableHeaders" class="table_headColumn">
      <span>{{ item.label }}</span>
    </th>
  </tr>
  </thead>
</template>

<style scoped>


.table_head {
  .table_headColumn {
    &--checkbox {
      display: flex;
      //padding-left: 32px;
      //text-align: left;
    }

    &:first-child {
      //padding-left :32px;
    }

    border-bottom: 1px solid #F2F2F2;
    font-weight: 700;
    font-size: 14px;
    line-height: 18px;
    padding: 24px 16px;
    //text-align: left;
    text-align: center;
  }
}
</style>