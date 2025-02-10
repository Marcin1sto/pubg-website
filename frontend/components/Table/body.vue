<script setup lang="ts">
import useDownload from "~/composables/useDownload";

const { items, headers, useCheckbox, selectAll, countItems, countSelectedItems, tableIsLoading, showDeleteModal,
  childHeaders } = storeToRefs(useTableStore());
const {t} = useI18n();
const { bodyTypes, actionsTypes} = useTableStore();
const toggleCheckbox = (item) => {
  item.selected = !item.selected;

  if (!item.selected) {
    selectAll.value = false;
  }

  if (countSelectedItems.value === countItems.value) {
    selectAll.value = true;
  }
}

const showValues = ref(false);

watch(tableIsLoading, (value) => {
  if (!value) {
    setTimeout(() => {
      showValues.value = true;
    }, 1000);
  }
});

const props = defineProps({
  useStore: {
    type: Boolean as PropType<boolean>,
    default: true,
  },
  headers: {
    type: Array as PropType<any[]>,
    default: () => [],
  },
  itemsFromCache: {
    type: Array as PropType<any[]>,
    default: () => [],
  },
  useCheckbox: {
    type: Boolean as PropType<boolean>,
    default: false,
  },
});

const tableItems = ref([]);
const tableHeaders = ref([]);

if (props.useStore) {
  tableItems.value = items.value;
  tableHeaders.value = headers.value;
} else {
  tableItems.value = props.itemsFromCache;
  tableHeaders.value = props.headers;
}

const formatDate = (time) => {
  const date = new Date(time);

  // Get year, month, and day part from the date
  const year = date.toLocaleString("default", { year: "numeric" });
  const month = date.toLocaleString("default", { month: "2-digit" });
  const day = date.toLocaleString("default", { day: "2-digit" });

  return `${year}-${month}-${day}`;
}

watch(items, (newValues) => {
  tableItems.value = items.value;
});

const { download } = useDownload();
const deleteElement = async (link: string, elementId) => {
  const {data, pending, error}: any = await useTheFetch(link, {
    method: 'DELETE',
  });

  if (data.value.success) {
    items.value = items.value.filter((item) => item.id !== elementId);
    tableItems.value = tableItems.value.filter((item) => item.id !== elementId);
  }

  showDeleteModal.value = false;
}

const openErrorsModal = (errors) => {
  modalErrorsVisible.value = true;
  modalErrorValues.value = errors;
}

const actionDeleteLink = ref('');
const actionDeleteId = ref('');
const modalErrorsVisible = ref(false);
const modalErrorValues = ref([]);

const prepareHeadersForChildren = (index, event) => {
  if (!childHeaders.value) {
    return;
  }

  // Find the parent element (table body) and the clicked row
  const tableBody = document.querySelector('.table_body');

  // Find the index of the clicked row
  const clickedRow = event.target.closest('tr');
  const rowIndex = Array.from(tableBody.children).indexOf(clickedRow);

  const trHeader = document.createElement('tr');
  trHeader.classList.add('children_for_' + index);

  Object.keys(childHeaders.value).forEach((childHeader) => {
    const cell = document.createElement('td');
    cell.style.borderBottom = '1px solid #F2F2F2';
    cell.style.paddingTop = '24px';
    cell.style.paddingBottom = '24px';
    cell.style.fontWeight = 'bold';
    cell.style.fontSize = '14px';
    cell.style.lineHeight = '18px';
    cell.style.textAlign = 'center';
    // cell.style.text?
    cell.classList.add('table_bodyColumn');
    cell.textContent = childHeaders.value[childHeader].content;
    trHeader.appendChild(cell);
  });

  tableBody.insertBefore(trHeader, tableBody.children[rowIndex + 1]);
  // Set opacity to 1 after delay to create the fade-in effect
  // setTimeout(() => {
  //   trHeader.style.opacity = '1';
  // }, 100); // Delay for opacity to transition

}

const showKidsForKey = async (index, event) => {
  await prepareHeadersForChildren(index, event);
  // Toggle the showKids property for the clicked row
  tableItems.value[index].showKids = !tableItems.value[index].showKids;
  if (!tableItems.value[index].showKids) {
    // Wyszukiwanie wszystkich elementów o klasie 'twoja-klasa'
    const elements = document.querySelectorAll('.children_for_' + index);

    // Iterowanie po każdym elemencie i jego usunięcie
    elements.forEach(element => {
      element.remove();
    });

    return;
  }

  if (!tableItems.value[index]?.childRows) {
    return;
  }

  // Find the parent element (table body) and the clicked row
  const tableBody = document.querySelector('.table_body');

  // Find the index of the clicked row
  const clickedRow = event.target.closest('tr');
  const rowIndex = Array.from(tableBody.children).indexOf(clickedRow);

  tableItems.value[index]?.childRows.forEach((childRow) => {
    // Clone the copyForKids element
    const copyForKids = document.getElementById('copyForKids');
    const copyForKidsClone = copyForKids.cloneNode(true);
    copyForKidsClone.classList.add('children_for_' + index);

    copyForKidsClone.id = 'copied';
    // Modify the clone's styles and properties
    copyForKidsClone.style.display = 'table-row';
    copyForKidsClone.style.animation = 'fadeIn 0.5s ease-in-out';
    copyForKidsClone.style.opacity = '0';
    copyForKidsClone.style.transition = 'opacity 0.3s ease-in-out';
    copyForKidsClone.style.transitionDelay = '0.1s';
    copyForKidsClone.style.animationDelay = '0.2s';
    copyForKidsClone.style.backgroundColor = 'rgba(198, 207, 225, 0.3)' // TODO: dopasować kolor
    copyForKidsClone.style.borderBottom = '3px solid rgba(198, 207, 225, 0.3)'; // TODO: dopasować kolor

    let countChildRows = Object.keys(childRow).length;
    let countHeaders = tableHeaders.value.length;

    if (countHeaders > countChildRows) {
      // Ustawiamy pierwszy cell jako pusty aby zachować odpowiednią ilość kolumn
      const cell = document.createElement('td');
      copyForKidsClone.appendChild(cell);
    }


    Object.keys(childRow).forEach((child, key) => {
      const cell = document.createElement('td');

      cell.style.borderBottom = '1px solid #F2F2F2';
      cell.style.paddingTop = '24px';
      cell.style.paddingBottom = '24px';
      cell.style.fontWeight = '400';
      cell.style.fontSize = '14px';
      cell.style.lineHeight = '18px';
      cell.style.textAlign = 'center';

      cell.classList.add('table_bodyColumn');
      cell.textContent = childRow[child]?.content;
      copyForKidsClone.appendChild(cell);
    });

    if (countHeaders > countChildRows) {
      for (let i = 0; i < countHeaders - countChildRows; i++) { // usuwamy jeden bo na poczatku dodajemy 1 pusty
        const cell = document.createElement('td');
        copyForKidsClone.appendChild(cell);
      }
    }

    // Insert the clone after the clicked row
    tableBody.insertBefore(copyForKidsClone, tableBody.children[rowIndex + 2]);

    // Set opacity to 1 after delay to create the fade-in effect
    setTimeout(() => {
      copyForKidsClone.style.opacity = '1';
    }, 100); // Delay for opacity to transition
  });

};


</script>

<template>
  <tbody class="table_body">
    <tr v-for="(item, tableItemIndex) in tableItems" :key="item.order_no"
        v-if="tableItems.length > 0 && tableHeaders.length > 0 && !tableIsLoading"
        class="table_bodyRow"
        @mouseover="item.hovered = true"
        @mouseleave="item.hovered = false"
        :style="item.hovered || item.selected ? 'background-color: #F2F5FB' : ''"
    >
<!--      {{ typeof item?.canSelect !== 'undefined'}}-->
      <td v-if="useCheckbox && (typeof item?.canSelect === 'undefined' ? useCheckbox : item?.canSelect)" class="table_bodyColumn">
<!--        <div style="width: 50px; height: 25px">-->
          <InputCheckbox :selected="item.selected" @change="toggleCheckbox(item)"/>
<!--        </div>-->
      </td>
      <td v-else-if="useCheckbox && !item?.canSelect" class="table_bodyColumn"></td>

      <td v-for="(header, tableItemHeaderIndex) in tableHeaders" :key="tableItemHeaderIndex" class="table_bodyColumn" :style="item[header.key]?.short ? 'max-width: 150px' : ''">
        <nuxt-link-locale v-if="typeof item[header.key] !== 'undefined' &&
           item[header.key].type === bodyTypes.LINK"
           :to="{name: item[header.key].link,
           params: { id: item[header.key].content}}" class="link">
          {{ item[header.key].content }}
        </nuxt-link-locale>
        <div v-if="typeof item[header.key] !== 'undefined' && item[header.key].type === bodyTypes.HTML" v-html="item[header.key].content" class="table_bodyColumnContent"></div>
        <span v-if="typeof item[header.key] !== 'undefined' && item[header.key].type === bodyTypes.TEXT">{{ item[header.key].content}}</span>
        <span v-if="typeof item[header.key] !== 'undefined' && item[header.key].type === bodyTypes.DATE">{{ formatDate(item[header.key].content) }}</span>
        <span v-if="typeof item[header.key] !== 'undefined' && item[header.key].type === bodyTypes.IMG"><NuxtImg :src="item[header.key].content" /></span>
        <span v-if="typeof item[header.key] !== 'undefined' && item[header.key].type === bodyTypes.ERRORS_MODAL">
          <IconStatus v-if="Object.keys(item[header.key].content).length > 0" style="cursor: pointer" :color="'red'" @click="openErrorsModal(item[header.key].content)"/>
        </span>
        <div v-if="typeof item[header.key] !== 'undefined' && item[header.key].type === bodyTypes.ACTIONS" class="table_bodyColumnActions">
          <div v-for="(action, index) in item[header.key].content" :key="index">
            <nuxt-link-locale v-if="action.type === actionsTypes.LINK"
                              :to="{ name: action.link, params: { id: action.id }, query: action.searchParams }" class="buttonSecondary">
              {{ action.content }}
            </nuxt-link-locale>
            <span class="buttonSecondary" v-if="action.type === actionsTypes.DOWNLOAD" @click.prevent="download(action.link, action.fileName)">
              {{ action.content }}
            </span>
            <div v-if="action.type === actionsTypes.DROPDOWN">
              DROPDOWN HERE
            </div>
            <div v-if="action.type === actionsTypes.CUSTOM_LINK">
              <a :href="action.link" class="buttonSecondary">{{ action.content }}</a>
            </div>
            <div v-if="action.type === actionsTypes.DELETE">
              <span class="buttonDelete" @click.prevent="showDeleteModal = true; actionDeleteLink = action.link; actionDeleteId = action.id">{{ action.content }}</span>
            </div>
            <div v-if="action.type === actionsTypes.FUNCTION">
              <span v-if="action.disabled" :class="[action.styleClass, action.styleClass+'--disabled']">{{ action.content }}</span>
              <span v-else :class="action.styleClass" @click.prevent="(action.function)(action.useId ? action.id : tableItemIndex)">{{ action.content }}</span>
            </div>
            <div v-if="action.type === actionsTypes.SHOW_MORE" @click="showKidsForKey(tableItemIndex, $event)" >
              <NuxtImg :src="!showFilters ? 'icons/orderDetails/arrowDown.png' : 'icons/orderDetails/arrowUp.png'"
                       width="37px" height="37px" class="filters_backButtonImg"/>
            </div>
          </div>
        </div>
      </td>
    </tr>
    <tr style="display: none" id="copyForKids" class="table_bodyRow">
    </tr>
    <tr v-if="tableIsLoading">
        <td colspan="50"  style="text-align: center;  vertical-align: middle;">
          <div style="display: flex; justify-content: center; align-items: center; gap: 10px; padding: 10px">
            <img src="https://www.adstone.pl/blpaczka/animation-02.gif">
            Wczytywanie...
          </div>
        </td>
    </tr>
    <tr v-if="!tableIsLoading && tableItems.length <= 0">
      <td colspan="50"  style="text-align: center;  vertical-align: middle;">
        <div style="display: flex; justify-content: center; align-items: center; gap: 10px; padding: 10px">
          Brak wpisów do wyświetlenia
        </div>
      </td>
    </tr>
  </tbody>

  <Teleport to="body">
    <Modal :show="showDeleteModal" @close="showDeleteModal = false">
      <template #header>
        <h1 class="modal_title">Czy napewno chcesz usunąć?</h1>
      </template>
      <template #body>
        <div class="orderForm_summaryModalButtonsContainer">
          <button class="orderForm_buttonGhost" @click.prevent="showDeleteModal = false">Nie</button>
          <button class="orderForm_buttonPrimary" @click.prevent="deleteElement(actionDeleteLink, actionDeleteId)">Tak</button>
        </div>
      </template>
    </Modal>
  </Teleport>

  <Teleport to="body">
    <Modal :show="modalErrorsVisible" @close="modalErrorsVisible = false">
      <template #header>
        <div class="form_errorMessageAlert--title"><NuxtImg src="icons/orderForm/checkError.png"/>Dla wybranego zamówienia wystąpiły następujące błedy:</div>
      </template>
      <template #body>
        <div class="form_errorMessageAlert" id="errorMessageAlert">
          <ul v-for="(generated, key) in modalErrorValues">
            <li class="form_errorMessageAlert--text" v-for="(message) in generated">{{ t('formFields.' +key)}} - {{message}}</li>
          </ul>
        </div>
      </template>
    </Modal>
  </Teleport>
</template>

<style scoped lang="scss">
tr {
  transition: opacity 0.3s ease-in-out;
  transition-delay: 0.1s; /* Opóźnienie dla każdego wiersza */
}

tr:nth-child(2n) {
  transition-delay: 0.2s; /* Inne opóźnienie dla nieparzystych wierszy */
}

@keyframes fadeIn {
  0% { opacity: 0; }
  100% { opacity: 1; }
}

@for $i from 1 through 100 {
  .table_bodyRow:nth-child(#{$i}) {
    animation-delay: $i * 0.2s;
  }
}

.table_body {
  .table_bodyRow {
    animation: fadeIn 0.5s ease-in-out;
    animation-fill-mode: forwards;
    opacity: 0; /* Ukryj element początkowo */
  }

  .link {
    color: rgb(66, 133, 244);
    text-decoration: none;
  }

  .table_bodyColumn {
    border-bottom: 1px solid #F2F2F2;
    padding: 24px 16px;
    font-weight: 400;
    font-size: 14px;
    line-height: 18px;
    text-align: center;
  }
}

.table_bodyColumnActions {
  display: flex;
  //flex-wrap: ;
  gap: 5px;
  justify-content: center;
  flex-direction: row;
}

.buttonDelete {
  font-size: 12px;
  font-weight: 700;
  line-height: 22px;
  color: #ff0000;
  padding: 4px 10px;
  border: 2px solid #ff0000;
  border-radius: 100px;
  max-height: 54px;
  text-decoration: none;
  margin-right: 16px;
  cursor: pointer;

  &--disabled {
    color: #B0B0B0;
    border: 2px solid #B0B0B0;
    cursor: not-allowed;
  }

  &:hover {
    color: #ffffff;
    background-color: #ff0000;
    border: 2px solid #ff0000;
  }
}

.buttonSecondary {
  font-size: 12px;
  font-weight: 700;
  line-height: 22px;
  color: #4285F4;
  padding: 4px 10px;
  border: 2px solid #4285F4;
  border-radius: 100px;
  max-height: 54px;
  text-decoration: none;
  margin-right: 16px;
  cursor: pointer;

  &--disabled {
    color: #B0B0B0;
    border: 2px solid #B0B0B0;
    cursor: not-allowed;
  }

  &:hover {
    color: #ffffff;
    background-color: #4285F4;
    border: 2px solid #4285F4;
  }
}
</style>