import {defineStore} from "pinia";
import {useTableStore} from "~/stores/useTableStore";
import useOrderFormStore from "~/stores/panel/orderFormStore";
import useAddressBookStore from "~/stores/panel/useAddressBookStore";

const {formatApiGetRoute, getApiRoute} = useApiRoutes();

const usePackageTemplateStore = defineStore('packageTemplates', {
  state: () => ({
    packageTemplatesSelectOptions: [],
    items: [],
    tableItems: [],
    searchParams: {},
    formErrors: [],
    showDeleteModal: false,
    formValuesTemplate: {
      "template_name": "",
      "type": "package",
      "country_code": "PL",
      "weight": "",
      "side_x": "",
      "side_y": "",
      "side_z": "",
      "sortable_id": "",
      "cover": "",
      "uptake": "",
      "postal_sender": "",
      "postal_delivery": "",
      "sortable": "",
      "delivery_private": false,
      "send_private": false,
      "return_docs": false,
      "no_pickup": false,
      "inpost_weekend": false,
      "return_pallet": false,
      "bringing": false,
      "bringing_and_unpack": false,
      "delivery_type": "",
      "city": "",
      "email": "",
      "house_no": "",
      "locum_no": "",
      "name": "",
      "phone": "",
      "vat_company": "",
      "postal": "",
      "street": "",
      "taker_city": "",
      "taker_email": "",
      "taker_house_no": "",
      "taker_locum_no": "",
      "taker_name": "",
      "taker_phone": "",
      "taker_postal": "",
      "taker_street": "",
      "taker_vat_company": "",
      "taker_point": "",
      "package_content": ""
    },
    form: {},
    packageFields: [
      "type",
      "weight",
      "side_x",
      "side_y",
      "side_z",
      "sortable_id",
      "sortable",
      "cover",
      "uptake",
      "package_content"
    ],
    senderFields: [
      "country_code",
      "postal_sender",
      "city",
      "email",
      "house_no",
      "locum_no",
      "name",
      "phone",
      "vat_company",
      "postal",
      "street"
    ],
    recipientFields: [
      "postal_delivery",
      "taker_city",
      "taker_email",
      "taker_house_no",
      "taker_locum_no",
      "taker_name",
      "taker_phone",
      "taker_postal",
      "taker_street",
      "taker_vat_company",
      "taker_point"
    ],
    servicesFields: [
      "send_private",
      "delivery_private",
      "return_docs",
      "no_pickup",
      "inpost_weekend",
      "return_pallet",
      "bringing",
      "bringing_and_unpack",
      "delivery_type"
    ],
    showSenderDetails: false,
    showRecipientDetails: false,
    showServicesDetails: false,
    showPackageDetails: false,
    showInfoModalType: '',
    showInfoModal: false,
    templateId: null,
  }),
  actions: {
    async getPackageTemplates() {
      const {stopLoadingAsyncData, setCountPages, setCurrentPage} = useTableStore();
      const {limit, page} = storeToRefs(useTableStore());

      const {data, pending, error}: any = await useTheFetch(formatApiGetRoute('automations.packageTemplate.index', {
        ...this.searchParams,
        limit: limit.value,
        page: page.value,
      }), {
        method: 'GET',
      });

      if (data.value.success) {
        setCountPages(data.value.data.countPages);
        setCurrentPage(data.value.data.currentPage);
        this.items = data.value.data.packageTemplates;
      }

      this.formatForTable()
    },
    async fetchPackageTemplate(id) {
      let route = getApiRoute('automations.packageTemplate.view');
      route = route.replace(':id', id);
      const {data, pending, error}: any = await useTheFetch(route)

      if (data.value.success) {
        return data.value.data;
      }
    },
    async updatePackageTemplate() {
      let requestValues = this.form;
      for (let key in requestValues) {
        if (requestValues[key] === '' || requestValues[key] === null || requestValues[key] === undefined) {
          requestValues[key] = null;
        }
      }

      //
      requestValues['sortable_id'] = null;

      const {data, pending, error}: any = await useTheFetch(getApiRoute('automations.packageTemplate.update'), {
        method: 'POST',
        body: {PackageTemplate: requestValues}
      });

      if (data.value?.success) {
        return data.value;
      } else {
        this.formErrors = error.value.data;
      }
    },
    async fullFillSendersData() {
      const { userExternalData } = storeToRefs(useUserStore());
      let data = userExternalData.value.Broker
      if (data.custom_pickup) {
        this.form.name = data.pickup_name;
        this.form.vat_company = data.vat_company;
        this.form.phone = data.pickup_phone;
        this.form.postal_sender = data.pickup_postal;
        this.form.city = data.pickup_city;
        this.form.street = data.pickup_street;
        this.form.house_no = data.pickup_house_no;
        this.form.locum_no = data.pickup_locum_no;
        this.form.email = data.email;

        return;
      }

      this.form.name = data.name;
      this.form.vat_company = data.vat_company;
      this.form.phone = data.phone;
      this.form.postal_sender = data.postal;
      this.form.city = data.city;
      this.form.street = data.street;
      this.form.house_no = data.house_no;
      this.form.locum_no = data.locum_no;
      this.form.email = data.email;
    },
    formatForTable() {
      const {bodyTypes, actionsTypes} = useTableStore();
      const {stopLoadingAsyncData} = useTableStore();

      this.tableItems = this.items.map((item: any) => {
        const Template = item.PackageTemplate;

        return {
          canSelect: false,
          id: {type: bodyTypes.TEXT, content: Template.id},
          created: {type: bodyTypes.DATE, content: Template.created},
          name: {type: bodyTypes.TEXT, content: Template.template_name},
          weight: {type: bodyTypes.TEXT, content: Template.weight},
          dimensions: {type: bodyTypes.TEXT, content: `${Template.side_x}x${Template.side_y}x${Template.side_z}`},
          sender_address: {type: bodyTypes.TEXT, content: `${Template.street} ${Template.house_no}, ${Template.postal} ${Template.city}`},
          actions: { type: bodyTypes.ACTIONS, content: [
            { type: actionsTypes.LINK, link: 'panel-automations-package-templates-id', content: 'Edytuj', id: Template?.id  },
            { type: actionsTypes.FUNCTION, styleClass: 'buttonSecondary', function: this.useTemplateToOrder, content: 'Nadaj', id: Template.id, useId: true },
          ]}
        }
      });

      stopLoadingAsyncData();
    },
    async useTemplateToOrder(elementId) {
      const Template = this.items.find((item) => item.PackageTemplate.id === elementId);
      const { initializeForm } = useOrderFormStore();
      const {form, isEdit} = storeToRefs(useOrderFormStore());
      await initializeForm();
      isEdit.value = true;
      this.templateId = elementId;

      this.updateFormValues(form.value, Template.PackageTemplate);

      const router = useRouter();
      const nuxt = useNuxtApp();

      router.push(nuxt.$localePath({name: 'panel'}))
    },
    /**
     * Aktualizuje wartości formularza na podstawie szablonu
     * musi wystepować pewna zgodność między nadawaniem paczki a szablonami
     * @param formValue
     * @param template
     */
    updateFormValues(formValue: any, template: any) {
      const keyMapping = {
        city: 'vat_city',
        house_no: 'vat_house_no',
        locum_no: 'vat_locum_no',
        postal_sender	: 'vat_postal',
        street: 'vat_street',
        sortable_id: 'sortable'
      };

      template = Object.keys(template).reduce((acc, key) => {
        const newKey = keyMapping[key] || key; // Podmienia klucz, jeśli jest w mapowaniu, w przeciwnym razie zostawia oryginalny
        acc[newKey] = template[key];
        return acc;
      }, {});

      for (let key in formValue) {
        if (formValue[key] !== null && typeof formValue[key] === 'object') {
          this.updateFormValues(formValue[key], template);
        } else if (template[key] !== undefined && template[key] !== '') {
          formValue[key] = template[key];
        }
      }
    },
    async storePackageTemplate() {
      let requestValues = this.form;
      for (let key in requestValues) {
        if (requestValues[key] === '' || requestValues[key] === null || requestValues[key] === undefined) {
          delete requestValues[key];
        }
      }

      const {data, pending, error}: any = await useTheFetch(getApiRoute('automations.packageTemplate.create'), {
        method: 'POST',
        body: {PackageTemplate: requestValues}
      });

      if (data.value?.success) {
        return data.value;
      } else {
        this.formErrors = error.value.data;
      }
    },
    async fetchSelectOptions() {
      const {data, pending, error}: any = await useTheFetch(formatApiGetRoute('automations.packageTemplate.selectOptions', {
        limit: 1000,
        page: 1,
      }), {
        method: 'GET',
      });

      if (data.value.success) {
        this.packageTemplatesSelectOptions = data.value.data;
      }
    },
    selectPackageDeliveryType(value) {
      this.form.type = value;
    },
    isSelectedDeliveryType(value) {
      return this.form.type === value;
    }
  },

});

export default usePackageTemplateStore;