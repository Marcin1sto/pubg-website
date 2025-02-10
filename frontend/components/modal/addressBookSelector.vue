<script setup lang="ts">
import useOrderFormStore from "~/stores/panel/orderFormStore";
import {useTableStore} from "~/stores/useTableStore";
import useAddressBookStore from "~/stores/panel/useAddressBookStore";
import {ref} from "vue";

const {form} = storeToRefs(useOrderFormStore());
const {updateCourierSearchField} = useOrderFormStore();
const addressBooks = ref([]);
const search_string = ref('');
const {t} = useI18n();

const props = defineProps({
  isShow: {
    type: Boolean,
    default: false
  },
  addressBookType: {
    type: String,
    default: ''
  },
  modalAction: {
    type: Function,
    required: false,
    default: false
  },
  formToChange: {
    type: Object,
    required: false,
    default: () => {
      return {};
    }
  }
});

const importAddressBookContact = () => {
  const id = props.addressBookType === 'sender' ? '1' : '2';
  addressBooks.value = items.value.filter(item => item.Contact.type_id == id);
}

const fullFillFromAddressBook = (data) => {
  if (!data) return;

  data = items.value.find(item => item.Contact.id == data).Contact;

  if (props.addressBookType == 'recipient') {
    FormToChange.value.recipient.taker_name = data.name;
    FormToChange.value.recipient.taker_vat_company = data.vat_company;
    FormToChange.value.recipient.taker_street = data.street;
    FormToChange.value.recipient.taker_house_no = data.house_no;
    FormToChange.value.recipient.taker_locum_no = data.locum_no;
    FormToChange.value.recipient.taker_postal = data.postal;
    FormToChange.value.recipient.taker_city = data.city;
    FormToChange.value.recipient.taker_email = data.email;
    FormToChange.value.recipient.taker_phone = data.phone;
    FormToChange.value.recipient.postal_delivery = data.country_code;
  } else {
    FormToChange.value.sender.name = data.name;
    FormToChange.value.sender.vat_company = data.vat_company;
    FormToChange.value.sender.vat_street = data.street;
    FormToChange.value.sender.vat_house_no = data.house_no;
    FormToChange.value.sender.vat_locum_no = data.locum_no;
    FormToChange.value.sender.vat_postal = data.postal;
    FormToChange.value.sender.vat_city = data.city;
    FormToChange.value.sender.email = data.email;
    FormToChange.value.sender.phone = data.phone;
  }

  closeShowAddressBookModal();
}

const emit = defineEmits(['close'])
const closeShowAddressBookModal = () => {
  search_string.value = '';
  emit('close', true);
}

const tableHeaders = [
  {key: 'name', label: t('address-book.table.name'), sortable: true},
  {key: 'contact', label: t('address-book.table.contact'), sortable: true},
  // {key: 'email', label: t('address-book.table.email'), sortable: true},
  // {key: 'phone', label: t('address-book.table.phone'), sortable: true},
  {key: 'address', label: t('address-book.table.address'), sortable: true},
  // {key: 'street', label: t('address-book.table.street'), sortable: true},
  // {key: 'postal_code', label: t('address-book.table.postal_code'), sortable: true},
  // {key: 'city', label: t('address-book.table.city'), sortable: true},
  {key: 'actions', label: t('address-book.table.actions'), sortable: true},
];
const {setItems, setHeaders, startLoadingAsyncData} = useTableStore();
const {page} = storeToRefs(useTableStore());
setHeaders(tableHeaders);

const itemsForTable = ref([]);
const storeItemsForTable = ref([]);
const {getAddresses, capitalizeFirstLetter, fetchTypes} = useAddressBookStore();
const {items, types } = storeToRefs(useAddressBookStore());

watch(() => props.isShow, async () => {
  await formatForTable();
});
const FormToChange = ref(props.formToChange);
onMounted(async () => {
  if (Object.keys(FormToChange.value).length == 0) {
    FormToChange.value = form.value;
  }

  await fetchTypes();
  await getAddresses(false);
});

const selectItem = (index) => {
  let element = itemsForTable.value.find((item, itemIndex) => itemIndex == index);
  fullFillFromAddressBook(element.id);
}

const formatForTable = async () => {
  importAddressBookContact();
  const {bodyTypes, actionsTypes} = useTableStore();

  itemsForTable.value = addressBooks.value.map((item: any) => {
    const Contact = item.Contact;

    let address = Contact.city + ' ' + Contact.postal + '<br> ' + Contact.street;
    if (Contact.locum_no) {
      address += ' ' + Contact.house_no + '/' + Contact.locum_no;
    } else {
      address += ' ' + Contact.house_no;
    }

    return {
      id: Contact.id,
      name: {type: bodyTypes.TEXT, content: Contact.name},
      type: {type: bodyTypes.TEXT, content: capitalizeFirstLetter(types[Contact.type_id] ?? '')},
      contact: {type: bodyTypes.HTML, content: Contact.email + '<br>' + Contact.phone},
      // email: {type: bodyTypes.TEXT, content: Contact.email},
      // phone: {type: bodyTypes.TEXT, content: Contact.phone},
      address: {type: bodyTypes.HTML, content: address},
      // street: {type: bodyTypes.TEXT, content: Contact.street},
      // postal_code: {type: bodyTypes.TEXT, content: Contact.postal},
      // city: {type: bodyTypes.TEXT, content: Contact.city},
      actions: {
        type: bodyTypes.ACTIONS, content: [
          {type: actionsTypes.FUNCTION, function: props.modalAction ? props.modalAction :selectItem, content: 'Wybierz', styleClass: 'buttonSecondary', useId: !!props.modalAction, id: Contact.id},
        ],
      }
    }
  });

  if (storeItemsForTable.value.length == 0) {
    storeItemsForTable.value = itemsForTable.value;
  }

  await setItems(itemsForTable.value);
}

watch(() => search_string.value, async () => {
  itemsForTable.value = storeItemsForTable.value.filter(item => {
    return item.name.content.toLowerCase().includes(search_string.value.toLowerCase()) ||
      item.contact.content.toLowerCase().includes(search_string.value.toLowerCase()) ||
      item.address.content.toLowerCase().includes(search_string.value.toLowerCase());
  });

});
</script>

<template>
  <Teleport to="body">
    <Modal :show="isShow" @close="closeShowAddressBookModal(); isShow = false" :style-max-content="true">
      <template #header>
        <h1 class="modal_title">Wybierz kontakt do uzupełnienia formularza</h1>
      </template>
      <template #body>
        <div class="form_filters">
          <div class="filters_container">
            <div class="filters_row">
              <span class="filters_searchInputContainer">
                <input type="text" placeholder="Wpisz dowolną treść kontaktu" :value="search_string"
                       class="filters_searchInput" @change="search_string = $event.target.value">
                <button><NuxtImg src="icons/orderDetails/search.png" width="21px" height="21px"
                                 class="filters_searchButton"/></button>
              </span>
            </div>
          </div>
        </div>
        <Table :use-checkbox="false" :table-items="itemsForTable" :table-headers="tableHeaders"
               :use-pagination="false" :use-store="false"
               :use-statistics="false"
        />
      </template>
    </Modal>
  </Teleport>
</template>

<style scoped>

</style>