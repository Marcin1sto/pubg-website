import {useTableStore} from "~/stores/useTableStore";

const {getApiRoute, formatApiGetRoute} = useApiRoutes();
import {defineStore} from "pinia";
import orderFormStore from "~/stores/panel/orderFormStore";
import useOrderFormStore from "~/stores/panel/orderFormStore";
import useOrderFormV2Store from "~/stores/panel/useOrderFormStore";
import useUserStore from "~/stores/useUserStore";

const useAddressBookStore = defineStore('addressBooks', {
  state: () => ({
    items: [],
    types: [],
    tableItems: [],
    searchParams: {},
    formData: {},
    formErrors: [],
    contact: {},
    showDeleteModal: false,
  }),
  actions: {
    showDeleteModalAction() {
      this.showDeleteModal = true;
    },
    submitDeleteModalAction() {
      this.showDeleteModal = false;
    },
    async getContact(id: number) {
      let route = formatApiGetRoute('addressBooks.view', {});
      route = route.replace(':id', id.toString());
      const {data, pending, error}: any = await useTheFetch(route, {
        method: 'GET',
      });

      if (error?.value) {
        if (typeof error.value === 'string') {
          data.value = JSON.parse(error.value.data)
        }

        return;
      }

      if (data.value.success) {
        this.contact = data.value.data.Contact;
      }

      return data.value;
    },
    async updateContact(postData: any) {
      const {data, pending, error}: any = await useTheFetch(formatApiGetRoute('addressBooks.update', {}), {
        method: 'POST',
        body: {
          Contact: postData
        },
      });

      if (error?.value) {
        this.formErrors = error.value.data.errors;

        return false;
      }

      return true;
    },
    async createContact(postData: any) {
      const route = formatApiGetRoute('addressBooks.create', {});
      const {data, pending, error}: any = await useTheFetch(route, {
        method: 'POST',
        body: {
          Contact: postData
        },
      });

      if (error?.value) {
        this.formErrors = error.value.data.errors;

        return false;
      }

      return true;
    },
    async getAddresses(usePagination = true) {
      const { stopLoadingAsyncData, setCountPages, setCurrentPage } = useTableStore();
      const { limit, page } = storeToRefs(useTableStore());

      if (usePagination) {
        this.searchParams.limit = limit.value;
        this.searchParams.page = page.value;
      }

      const {data, pending, error}: any = await useTheFetch(formatApiGetRoute('addressBooks.index', {
        ...this.searchParams
      }), {
        method: 'GET',
      });

      if (error?.value) {
        if (typeof error.value === 'string') {
          data.value = JSON.parse(error.value.data)
        }

        return;
      }

      if (data.value.success) {
        setCountPages(data.value.data.countPages);
        setCurrentPage(data.value.data.currentPage);
        this.items = data.value.data.contacts;
      }

      this.formatForTable();
      stopLoadingAsyncData();
    },
    async fetchTypes() {
      const { stopLoadingAsyncData } = useTableStore();

      const {data, pending, error}: any = await useTheFetch(formatApiGetRoute('addressBooks.staticTypes', this.searchParams), {
        method: 'GET',
      });

      if (error?.value) {
        if (typeof error.value === 'string') {
          data.value = JSON.parse(error.value.data)
        }

        return;
      }

      if (data.value.success) {
        this.types = data.value.data;
      }

      this.formatForTable();
      stopLoadingAsyncData();
    },
    async orderWithThisContact(key: number) {
      const { form, isEdit } = storeToRefs(useOrderFormV2Store());
      const { initializeForm, fullFillSenderData } = useOrderFormV2Store();
      const {userExternalData} = storeToRefs(useUserStore());
      let contact = this.items[key];

      initializeForm();

      if (contact) {
        if (contact.Contact.type_id === '1') {
          form.value.sender = {
            name: contact.Contact.name,
            vat_company: contact.Contact.vat_company,
            email: contact.Contact.email,
            phone: contact.Contact.phone,
            vat_street: contact.Contact.street,
            vat_postal: contact.Contact.postal,
            vat_city: contact.Contact.city,
            vat_house_no: contact.Contact.house_no,
            vat_locum_no: contact.Contact.locum_no,
          }
        } else {
          form.value.recipient = {
            taker_city: contact.Contact.city,
            taker_email: contact.Contact.email,
            taker_house_no: contact.Contact.house_no,
            taker_locum_no: contact.Contact.locum_no,
            taker_name: contact.Contact.name,
            taker_phone: contact.Contact.phone,
            taker_postal: contact.Contact.postal,
            taker_street: contact.Contact.street,
            taker_vat_company: contact.Contact.vat_company,
          }

          await fullFillSenderData(userExternalData.value.Broker);
        }
        isEdit.value = true
        const router = useRouter();
        const nuxt = useNuxtApp();

        router.push(nuxt.$localePath('panel'));
      }
    },
    formatForTable() {
      const { bodyTypes, actionsTypes } = useTableStore();

      this.tableItems = this.items.map((item: any) => {
        const Contact = item.Contact;
        let routeDelete = formatApiGetRoute('addressBooks.delete', {});
        routeDelete = routeDelete.replace(':id', Contact.id.toString());

        return {
          id: Contact.id,
          name: {type: bodyTypes.TEXT, content: Contact.name},
          type: {type: bodyTypes.TEXT, content: this.capitalizeFirstLetter(this.types[Contact.type_id] ?? '')},
          email: {type: bodyTypes.TEXT, content: Contact.email},
          phone: {type: bodyTypes.TEXT, content: Contact.phone},
          street: {type: bodyTypes.TEXT, content: Contact.street},
          postal_code: {type: bodyTypes.TEXT, content: Contact.postal},
          city: {type: bodyTypes.TEXT, content: Contact.city},
          actions: {
            type: bodyTypes.ACTIONS, content: [
              {type: actionsTypes.FUNCTION, styleClass: 'buttonSecondary', function: this.orderWithThisContact, content: 'Nadaj', id: Contact.id  },
              {type: actionsTypes.LINK, link: 'panel-automations-address-book-id', content: 'Edytuj', id: Contact.id  },
              {type: actionsTypes.DELETE, link: routeDelete, content: 'Usuń', id: Contact.id  },
            ],
          }
        }
      });
    },
    capitalizeFirstLetter(string) {
      return string.charAt(0).toUpperCase() + string.slice(1);
    }
  }
});

export default useAddressBookStore;