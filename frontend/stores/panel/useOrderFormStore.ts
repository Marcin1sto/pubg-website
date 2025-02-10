import {defineStore} from "pinia";
import {getBindingIdentifiers} from "@babel/types";
import keys = getBindingIdentifiers.keys;
import usePreOrderStore from "~/stores/panel/usePreOrderStore";
import useUserStore from "~/stores/useUserStore";
import {required} from "@vuelidate/validators";

const {getApiRoute, formatApiGetRoute} = useApiRoutes();

const sectionStatuses = [
  {color: 'green', status: 'done'},
  {color: 'gray', status: 'start'},
  {color: 'blue', status: 'seen'},
  {color: 'red', status: 'error'}
]
const timeout = ref(null);

const useOrderFormV2Store = defineStore('order_form_v2', {
  state: () => ({
    form: {},
    mapUrl: '',
    paramsForValuation: {},
    paramsForFirstValuation: {
      CourierSearch: {}
    },
    createOrderData: {},
    valuationResults: [],
    sortablesData: [],
    sectionsDone: {
      sender: sectionStatuses[1],
      recipient: sectionStatuses[1],
      packages: sectionStatuses[1],
      services: sectionStatuses[1],
      courier: sectionStatuses[1],
      summary: sectionStatuses[1],
    },
    allFieldsValid: false,
    sectionStatuses: sectionStatuses,
    addToCartOrderLoading: false,
    createOrderLoading: false,
    isEdit: false,
    isEditSales: false,
    isEditingIndex: null,
    isEditingId: null,
    courierError: {},
    valuationIsLoading: false,
    firstValuationIsLoading: false,
    lastRequestBody: {},
    continue_url: '',
    showAddressBookModal: false,
    showAddressBookModalType: '',
    valuation: {
      valuationResultsToShow: [],
      valuationResultsWhole: [],
    },
    visibleSection: '',
    showRecipientMap: false,
    pickupDateOptions: [],
    previewPoint: null,
    selectedPoint: null,
  }),
  actions: {
    initializeSectionsDone() {
      this.sectionsDone = {
        sender: this.getSectionStatusByStatus('start'),
        recipient: this.getSectionStatusByStatus('start'),
        packages: this.getSectionStatusByStatus('start'),
        services: this.getSectionStatusByStatus('start'),
        courier: this.getSectionStatusByStatus('start'),
        summary: this.getSectionStatusByStatus('start'),
      };
    },
    getSectionStatusByStatus(status: string) {
      return this.sectionStatuses.find((item) => item.status === status);
    },
    fullFullFromQuickQuote(data: any) {
      if (data === null) return;

      for (const key in data) {
        if (data.hasOwnProperty(key)) {
          if (key === 'recipientCountry' || key === 'senderCountry') {
            continue;
          }
          if (data[key] === "" || data[key] === null) {
            return; // Znalazł niepuste pole
          }
        }
      }

      if (Object.values(data).some(value => value !== '') && Object.values(data).some(value => value !== null)) {
        this.form.package.type = data.deliveryType;
        this.form.package.side_x = data.width;
        this.form.package.side_y = data.height;
        this.form.package.side_z = data.length;
        this.form.package.weight = data.weight;
        this.form.recipient.delivery_type = data.delivery_type;
        this.form.recipient.taker_postal = data.recipientZipCode;
        this.form.sender.vat_postal = data.senderZipCode;
        this.form.package.country_code = data.recipientCountry.shortName;
        this.form.package.postal_sender_country = data.senderCountry.shortName;
      }
    },
    initializeForm() {
      if (this.isEdit || this.isEditSales) {
        return;
      }

      this.form = {
        search_id: null,
        // Sekcje
        package: {
          type: 'package',
          side_y: null,
          side_x: null,
          side_z: null,
          weight: null,
          country_code: 'PL',
          sortable: null,
          package_content: '',
          delivery_type: '',
          no_pickup: '',
          taker_postal: '',
        },
        sender: {
          name: '',
          country: '',
          vat_company: '',
          vat_postal: '',
          vat_city: '',
          vat_street: '',
          vat_house_no: '',
          vat_locum_no: '',
          number: '',
          email: '',
          phone: '',
        },
        recipient: {
          taker_name: '',
          taker_vat_company: '',
          country: '',
          taker_postal: '',
          taker_city: '',
          taker_street: '',
          taker_locum_no: '',
          taker_house_no: '',
          taker_phone: '',
          taker_email: '',
          marketplace_sale_id: '',
        },
        services: {
          cover: '',
          uptake: '',
          delivery_private: null,
          inpost_weekend: null,
          taker_vat_number: null,
          fragile: null,
        },
        // koniec Sekcji
        SearchParcel: [],
        taker_point: '',
        promoCode: '',
        courier: {},
        CartOrder: {},
        pickup: {},
      };
    },
    async initializeFormForOrder() {
      const countriesRequiredState = ['US', 'CA']

      this.createOrderData = {
        origin: "front",
        payment: this.form.CartOrder.payment ?? 'bank',
        Cart: [
          {
            Order: {
              name: this.form.sender.name,
              vat_company: this.form.sender.vat_company,
              street: this.form.sender.vat_street,
              house_no: this.form.sender.vat_house_no,
              locum_no: this.form.sender.vat_locum_no,
              postal: this.form.sender.vat_postal,
              city: this.form.sender.vat_city,
              email: this.form.sender.email,
              phone: this.form.sender.phone,
              taker_name: this.form.recipient.taker_name,
              taker_vat_company: this.form.recipient.taker_vat_company,
              taker_email: this.form.recipient.taker_email,
              taker_phone: this.form.recipient.taker_phone,
              taker_street: this.form.recipient.taker_street,
              taker_house_no: this.form.recipient.taker_house_no,
              taker_locum_no: this.form.recipient.taker_locum_no,
              taker_postal: this.form.recipient.taker_postal,
              taker_city: this.form.recipient.taker_city,
              package_content: this.form.package.package_content,
              taker_point: this.form.taker_point,
              pickup_date: this.form.pickup.pickup_date,
              marketplace_sale_id: this.form.recipient.marketplace_sale_id,
            },
            search_id: this.form.search_id,
            courier_id: this.form.courier?.Courier?.id,
          }
        ]
      };

      if (this.continue_url) {
        this.createOrderData.continue_url = this.continue_url;
      }

      if (countriesRequiredState.includes(this.form.package.country_code)) {
        this.createOrderData.Cart[0].Order.state = this.form.recipient.state;
      }

      if (this.form.package.no_pickup === false) {
        if (this.form.pickup.pickup_ready_time?.minutes === 0) {
          this.form.pickup.pickup_ready_time.minutes = '00';
        }

        if (this.form.pickup.pickup_close_time?.minutes === 0) {
          this.form.pickup.pickup_close_time.minutes = '00';
        }

        this.createOrderData.Cart[0].Order.pickup_ready_time = this.form.pickup?.pickup_ready_time?.hours;
        this.createOrderData.Cart[0].Order.pickup_ready_time_minute = this.form.pickup?.pickup_ready_time?.minutes;
        this.createOrderData.Cart[0].Order.pickup_close_time = this.form.pickup.pickup_close_time?.hours;
        this.createOrderData.Cart[0].Order.pickup_close_time_minute = this.form.pickup.pickup_close_time?.minutes;
      }

      if (this.form.services.taker_vat_number && this.form.services.taker_vat_number.trim() !== '') {
        this.createOrderData.Cart[0].Order.taker_vat_company = this.form.recipient.taker_vat_company + ' NIP: ' + this.form.services.taker_vat_number;
      }
    },
    selectCourierPrice(courier: any) {
      // if (this.form.courier === courier) {
      //   this.form.courier = {};
      //   this.updateStatusForSection('courier', false);
      //   return;
      // }

      this.form.courier = courier;

      if (this.form.courier?.Courier?.private_delivery_fee === true) {
        this.form.services.delivery_private = false;
      } else {
        this.form.services.taker_vat_number = null;
      }

      this.updateStatusForSection('courier', false);
      this.updateMapUrl();
    },
    updateTakerPoint(point: any) {
      this.form.taker_point = point;
    },
    initializeParamsForValuation() {
      this.paramsForValuation = {
        CourierSearch: {
          type: '',
          side_y: '',
          side_x: '',
          side_z: '',
          weight: '',
          cover: '',
          uptake: '',
          postal_sender_country: '',
          postal_sender: '',
          postal_delivery_country: '',
          country_code: 'PL',
          sortable: false,
          delivery_type: '',
          origin: 'front',
          fragile: ''
        },
        SearchParcel: [
          {
            weight: '',
            side_x: '',
            side_y: '',
            side_z: '',
            sortable: false
          },
        ],
        Cart: {
          Order: {
            name: '',
            vat_company: '',
            street: '',
            house_no: '',
            postal: '',
            city: '',
            email: '',
            phone: '',
            taker_name: '',
            taker_email: '',
            taker_phone: '',
            taker_street: '',
            taker_house_no: '',
            taker_postal: '',
            taker_city: '',
            package_content: '',
            taker_point: '',
            pickup_date: '',
            pickup_ready_time: '',
            pickup_ready_time_minute: '',
            pickup_close_time: '',
            pickup_close_time_minute: '',
            marketplace_sale_id: '',
          },
        }
      };
    },
    updateMapUrl() {
      const config = useRuntimeConfig();
      this.mapUrl = config.public.apiBaseUrl + 'pudo-map?noSideBar=1';

      if (this.form.courier.Courier?.courier_type) {
        this.mapUrl = this.mapUrl + '&api_type=' + this.form.courier.Courier?.courier_type;
      }

      if (this.form.recipient.taker_postal) {
        this.mapUrl = this.mapUrl + '&postalCode=' + this.form.recipient.taker_postal;
      }

      if (this.form.recipient.country) {
        this.mapUrl = this.mapUrl + '&country=' + this.form.recipient.country;
      }

      if (this.form.taker_point) {
        this.mapUrl = this.mapUrl + '&point_id=' + this.form.taker_point;
      }
    },
    updateStatusForSection(section: string, leave: boolean | null) {
      if (this.sectionsDone[section].status === 'start') {
        this.sectionsDone[section] = this.getSectionStatusByStatus('seen');

        const forceCheckSections = ['sender', 'summary']
        if (forceCheckSections.includes(section)) {
          this.sectionIsComplete(section, leave);
        }
        return;
      } else {
        this.sectionIsComplete(section, leave);
      }
    },
    checkPostalRegex(value: string) {
      const regex = /^[0-9]{2}-[0-9]{3}$/
      return regex.test(value);
    },
    sectionIsComplete(section: string, forceError: boolean | null) {
      if (section === 'packages') {
        if (forceError) {
          this.sectionsDone.packages = this.getSectionStatusByStatus('error')
          return;
        }

        const keysToCheck = ['type', 'side_y', 'side_x', 'side_z', 'weight', 'sortable', 'package_content', 'delivery_type'];
        const keysToCheckSender = ['vat_postal'];
        const keysToCheckRecipient = ['taker_postal'];

        let checkPackages = keysToCheck.every(key => {
          if (key === 'sortable' && ['pallet', 'not_standard'].includes(this.form.package.type)) {
            return true;
          }

          return this.form.package.hasOwnProperty(key) && this.form.package[key] !== null && this.form.package[key] !== '';
        }, {});

        let checkSender = keysToCheckSender.every(key => {
          if (this.form.sender.hasOwnProperty(key) && this.form.sender[key] !== null && this.form.sender[key] !== '') {
            if (this.checkPostalRegex(this.form.sender[key])) {
              return true;
            }
          }

          return false;
        });

        let checkRecipient = keysToCheckRecipient.every(key => {
          if (this.form.recipient.hasOwnProperty(key) && this.form.recipient[key] !== null && this.form.recipient[key] !== '') {
            // hack na to czy kraj nie jest inny niz pl
            if (this.form.recipient.country !== 'PL') {
              return true
            }

            if (this.checkPostalRegex(this.form.recipient[key])) {
              return true;
            }
          }

          return false;
        });


        if (checkPackages && checkSender && checkRecipient) {
          this.sectionsDone.packages = this.getSectionStatusByStatus('done');
        } else if (this.sectionsDone.packages.status === 'done') {
          this.sectionsDone.packages = this.getSectionStatusByStatus('error');
        }
      }

      if (section === 'services') {
        if (forceError) {
          this.sectionsDone.services = this.getSectionStatusByStatus('error')
          return;
        }

        if (this.form.services.delivery_private !== false || this.form.courier?.Courier?.private_delivery_fee === false || (this.form.services.taker_vat_number !== null && this.form.services.taker_vat_number !== '')) {
          this.sectionsDone.services = this.getSectionStatusByStatus('done');
          return;
        } else if (this.sectionsDone.packages.status === 'done') {
          this.sectionsDone.services = this.getSectionStatusByStatus('error');
          return;
        }
      }

      if (section === 'sender') {
        if (forceError) {
          this.sectionsDone.sender = this.getSectionStatusByStatus('error')
          return;
        }

        const keysToCheck = ['name', 'vat_postal', 'vat_city', 'vat_street', 'vat_house_no', 'email', 'phone'];
        let checkSender = keysToCheck.every(key => {
          return this.form.sender.hasOwnProperty(key) && this.form.sender[key] !== null && this.form.sender[key] !== '';
        }, {});

        if (checkSender) {
          this.sectionsDone.sender = this.getSectionStatusByStatus('done');
        } else if (this.sectionsDone.sender.status === 'done') {
          this.sectionsDone.sender = this.getSectionStatusByStatus('error');
        }
      }

      if (section === 'recipient') {
        if (forceError) {
          this.sectionsDone.recipient = this.getSectionStatusByStatus('error')
          return;
        }

        const keysToCheck = ['taker_name', 'taker_postal', 'taker_city', 'taker_street', 'taker_house_no', 'taker_phone', 'taker_email'];

        let checkRecipient = keysToCheck.every(key => {
          return this.form.recipient.hasOwnProperty(key) && this.form.recipient[key] !== null && this.form.recipient[key] !== '';
        }, {});

        if (checkRecipient) {
          this.sectionsDone.recipient = this.getSectionStatusByStatus('done');
        } else if (this.sectionsDone.recipient.status === 'done') {
          this.sectionsDone.recipient = this.getSectionStatusByStatus('error');
        }
      }

      if (section === 'courier') {
        if (forceError) {
          this.sectionsDone.courier = this.getSectionStatusByStatus('error')
        }

        if (this.form.courier.Courier && this.form.courier.Price) {
          this.sectionsDone.courier = this.getSectionStatusByStatus('done');
        } else {
          this.sectionsDone.courier = this.getSectionStatusByStatus('seen');
        }
      }

      if (section === 'summary') {
        if (this.sectionsDone.sender.status === 'done' && this.sectionsDone.recipient.status === 'done' && this.sectionsDone.packages.status === 'done' && this.sectionsDone.services.status === 'done' && this.sectionsDone.courier.status === 'done') {
          this.sectionsDone.summary = this.getSectionStatusByStatus('done');
        }
      }
    },
    addEmptyPackage() {
      this.form.SearchParcel.push({
        weight: this.form.package.weight,
        side_x: this.form.package.side_x,
        side_y: this.form.package.side_y,
        side_z: this.form.package.side_z,
        sortable: this.form.package.sortable,
      });

      this.parseFormForValuation();
      this.fetchValuationResults();
    },
    selectPackageDeliveryType(packageType: string) {
      if (this.form.package.type === packageType) {
        return;
      }
      this.form.package.type = packageType;

      if (packageType === 'pallet') {
        this.form.package.side_y = 80;
        this.form.package.side_x = 120;
        this.form.package.weight = '';
      }

      if (packageType === 'envelope') {
        this.form.package.side_x = 5
        this.form.package.side_y = 25
        this.form.package.side_z = 35
        this.form.package.weight = ''
      }

      if (packageType !== 'envelope' && packageType !== 'pallet') {
        this.form.package.side_x = null
        this.form.package.side_y = null
        this.form.package.side_z = null
        this.form.package.weight = null
      }
    },
    isSelectedDeliveryType(packageType: string) {
      return this.form.package?.type === packageType;
    },
    updateCourierSearchField(value: string, field: string) {
      this.form.package[field] = value;
    },
    updatePackageField(index: number | string, field: string, value: string) {
      this.form.SearchParcel[index][field] = value;
    },
    updatePickup(value: boolean) {
      this.form.package.no_pickup = value;

      if (!value) {
        this.fetchPickupDateOptions();
      }
    },
    updateSortable(value: number) {
      this.form.package.sortable = value;
    },
    deleteLastPackage() {
      if (this.form.SearchParcel.length === 0) {
        return;
      }

      this.form.SearchParcel.pop();
    },
    async fullFillSenderData(data: any) {
      if (this.isEdit) return;

      if (data.custom_pickup) {
        this.form.sender.name = data.pickup_name;
        this.form.sender.phone = data.pickup_phone;
        this.form.sender.vat_postal = data.pickup_postal;
        this.form.sender.vat_city = data.pickup_city;
        this.form.sender.vat_street = data.pickup_street;
        this.form.sender.vat_house_no = data.pickup_house_no;
        this.form.sender.vat_locum_no = data.pickup_locum_no;
        this.form.sender.email = data.email;

        return;
      }

      if (data.consumer_account) {
        this.form.sender.name = data.name;
        this.form.sender.phone = data.phone;
        this.form.sender.email = data.email;
        this.form.sender.vat_postal = data.postal;
        this.form.sender.vat_city = data.city;
        this.form.sender.vat_street = data.street;
        this.form.sender.vat_house_no = data.house_no;
        this.form.sender.vat_locum_no = data.locum_no;

        return;
      }

      Object.keys(data).forEach((key: any) => {
        if (this.form.sender[key] !== undefined) {
          this.form.sender[key] = data[key];
        }
      });
    },
    async firstValuation() {
      this.firstValuationIsLoading = true

      const firstParams = {
        deliveryType: 'package',
        height: 10,
        width: 10,
        length: 2,
        weight: 1,
        senderCountry: 'PL',
        senderZipCode: '00-714',
        recipientCountry: 'PL',
        recipientZipCode: '00-714',
        no_pickup: true
      };

      const request =  {
        type: this.form.package.type,
        side_x: this.form.package.side_x ?? firstParams.width,
        side_y: this.form.package.side_y ?? firstParams.height,
        side_z: this.form.package.side_z ?? firstParams.length,
        weight: this.form.package.weight ?? firstParams.weight,
        postal_delivery: firstParams.recipientZipCode,
        country_code: this.form.package?.country_code ?? firstParams.recipientCountry,
        no_pickup: firstParams.no_pickup,
        postal_sender: firstParams.senderZipCode,
        delivery_type: this.form.recipient.delivery_type,
      };

      const {data, pending, error}: any = await useTheFetch(getApiRoute('orderForm.getValuation'), {
        method: 'POST',
        body: {
          CourierSearch: request,
        },
      });

      if (error?.value) {
        data.value = error.value.data
      }

      this.valuationResults = data.value;

      if (data.value && data.value.success) {
        this.form.search_id = data.value.data.CourierSearch.id;
      }

      this.valuationIsLoading = false;
      this.firstValuationIsLoading = false;
    },
    parseFormForValuation() {
      this.initializeParamsForValuation();

      this.paramsForValuation.CourierSearch = {
        type: this.form.package.type,
        side_y: this.form.package.side_y,
        side_x: this.form.package.side_x,
        side_z: this.form.package.side_z,
        weight: this.form.package.weight ?? 1,
        postal_sender: this.form.sender.vat_postal,
        postal_delivery: this.form.package.taker_postal,
        no_pickup: this.form.package.no_pickup,
        country_code: this.form.package?.country_code,
        delivery_type: this.form.package.delivery_type,
        cover: this.form?.package.cover,
        uptake: this.form.services?.uptake,
        inpost_weekend: this.form.services?.inpost_weekend ?? false,
        bringing: this.form.services?.bringing ?? false,
        bringing_and_unpack: this.form.services?.bringing_and_unpack ?? false,
        return_pallet: this.form.services?.return_pallet ?? false,
        delivery_private: this.form.services?.delivery_private ?? false,
        taker_vat_number: this.form.services?.taker_vat_number || null,
        sortable: this.form?.package?.sortable,
        fragile: this.form?.package?.fragile,
        origin: 'front',
      };

      this.paramsForValuation.SearchParcel = this.form.SearchParcel.map((packageItem, index) => {
        return {
          weight: packageItem.weight,
          side_x: packageItem.side_x,
          side_y: packageItem.side_y,
          side_z: packageItem.side_z,
          sortable: this.form.package.sortable
        };
      });

      this.paramsForValuation.Cart = [
        {
          Order: {
            name: this.form.sender.name,
            vat_company: this.form.sender.vat_company,
            street: this.form.sender.vat_street,
            house_no: this.form.sender.vat_house_no,
            postal: this.form.sender.vat_postal,
            city: this.form.sender.vat_city,
            email: this.form.sender.email,
            phone: this.form.sender.phone,
            taker_name: this.form.recipient.taker_name,
            taker_vat_company: this.form.recipient.taker_vat_company,
            taker_email: this.form.recipient.taker_email,
            taker_phone: this.form.recipient.taker_phone,
            taker_street: this.form.recipient.taker_street,
            taker_house_no: this.form.recipient.taker_house_no,
            taker_postal: this.form.recipient.taker_postal,
            taker_city: this.form.recipient.taker_city,
            package_content: this.form.package.package_content,
            taker_point: this.form.taker_point,
            pickup_date: this.form.pickup.pickup_date,
            marketplace_sale_id: this.form.recipient.marketplace_sale_id,
          },
        }
      ];

      if (this.form.package.no_pickup === false) {
        if (this.form.pickup.pickup_ready_time?.minutes === 0) {
          this.form.pickup.pickup_ready_time.minutes = '00';
        }

        if (this.form.pickup.pickup_close_time?.minutes === 0) {
          this.form.pickup.pickup_close_time.minutes = '00';
        }

        this.paramsForValuation.Cart[0].Order.pickup_ready_time = this.form.pickup?.pickup_ready_time?.hours;
        this.paramsForValuation.Cart[0].Order.pickup_ready_time_minute = this.form.pickup.pickup_ready_time?.minutes;
        this.paramsForValuation.Cart[0].Order.pickup_close_time = this.form.pickup?.pickup_close_time?.hours;
        this.paramsForValuation.Cart[0].Order.pickup_close_time_minute = this.form.pickup.pickup_close_time?.minutes;
      }

      if (this.paramsForValuation.SearchParcel.length === 0) {
        delete this.paramsForValuation['SearchParcel'];
      }
    },
    async saveToCart() {
      this.addToCartOrderLoading = true
      this.initializeFormForOrder();

      const {savePreOder} = usePreOrderStore();

      await savePreOder({
        order_json: {
          CartOrder: this.createOrderData,
          fullData: this.form
        },
        search_id: this.form.search_id,
        courier_id: this.form.courier?.Courier?.id,
      });

      this.initializeForm();
      this.form.package.sortable = null;
      const {userExternalData} = storeToRefs(useUserStore());
      this.fullFillSenderData(userExternalData.value.Broker);
      this.initializeSectionsDone();
      this.addToCartOrderLoading = false
    },
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
        } else if (template[key] !== undefined) {
          formValue[key] = template[key];
        }
      }
    },
    async createOrder(readyObject = null) {
      this.createOrderLoading = true;

      if (readyObject === null) {
        this.initializeFormForOrder();
      }

      const {data, pending, error}: any = await useTheFetch(getApiRoute('orderForm.multiOrders'), {
        method: 'POST',
        body: readyObject !== null ? readyObject : this.createOrderData,
      });

      if (error?.value) {
        data.value = error.value.data
      }

      if (data.value?.success) {
        const {getUserBalance} = useUserStore();
        await getUserBalance();
      }

      if (!data.value?.success) {
        const {getUserBalance} = useUserStore();
        await getUserBalance();
        this.courierError = data.value;
      }

      return data.value;
    },
    async fetchValuationResults() {
      if (this.firstValuationIsLoading) {
        return;
      }
      while (this.valuationIsLoading) {
        await new Promise((resolve) => setTimeout(resolve, 5000));
      }

      this.valuationIsLoading = true;
      this.parseFormForValuation();
      if (JSON.stringify( this.paramsForValuation) === JSON.stringify(this.lastRequestBody)) {
        this.valuationIsLoading = false;
        return;
      }

      this.lastRequestBody = {...this.paramsForValuation};

      const {data, pending, error}: any = await useTheFetch(getApiRoute('orderForm.getValuation'), {
        method: 'POST',
        body: this.paramsForValuation,
      });

      if (error?.value) {
        data.value = error.value.data
      }

      this.valuationResults = data.value;

      if (data.value && data.value.success) {
        this.form.search_id = data.value.data.CourierSearch.id;
      }

      if (Object.keys(this.form.courier).length > 0) {
        let checkSelectedCourierExist = this.valuationResults?.results?.find((courier) => courier.id == this.form.courier.Courier.id);

        if (typeof checkSelectedCourierExist == 'undefined') {
          this.form.courier = {};
          this.sectionsDone.courier = this.getSectionStatusByStatus('error')
        }
      }

      this.valuationIsLoading = false;
    },
    async fetchSortables() {
      const {data, pending, error}: any = await useTheFetch(getApiRoute('orderForm.getSortables'), {
        method: 'GET',
      });

      if (error?.value) {
        data.value = JSON.parse(error.value.data)

      }

      if (data.value.success) {
        this.sortablesData = data.value.data;
      }
    },
    async fetchPickupDateOptions() {
      const {data, pending, error}: any = await useTheFetch(formatApiGetRoute('orderForm.getPickupDateOptions',
        {
          api_type: this.form?.courier?.Courier?.courier_type,
          postal_code: this.form?.sender?.vat_postal,
        }), {
        method: 'GET',
      });

      if (error?.value) {
        return error.value.data
      }

      if (data.value.success && data.value.data) {
        const { min_time, max_time, min_diff, min_date, start_time } = data.value.data;

        const parseTime = (timeStr) => {
          const [hours, minutes] = timeStr.split(':').map(Number);
          return { hours, minutes };
        };

        this.pickupDateOptions = {
          min_time: parseTime(min_time),
          max_time: parseTime(max_time),
          min_diff: min_diff,
          min_date,
          start_time: parseTime(start_time),
        };
      }
    },
    onDateChange(newDate) {
      this.form.pickup.pickup_date = newDate;
      this.form.pickup.pickup_ready_time = newDate === this.pickupDateOptions.min_date ? this.pickupDateOptions.start_time : this.pickupDateOptions.min_time;
      this.form.pickup.pickup_close_time = this.pickupDateOptions.max_time;
    },
    updatePickupReadyTime(newTime, minDiff) {
      this.form.pickup.pickup_ready_time = newTime;

      if (newTime) {
        const readyDate = new Date();
        readyDate.setHours(newTime.hours);
        readyDate.setMinutes(newTime.minutes);

        const minCloseDate = new Date(readyDate.getTime() + minDiff.value * 60000);

        if (this.form.pickup.pickup_close_time &&
          (this.form.pickup.pickup_close_time.hours < minCloseDate.getHours() ||
            (this.form.pickup.pickup_close_time.hours === minCloseDate.getHours() &&
              this.form.pickup.pickup_close_time.minutes < minCloseDate.getMinutes()))) {
          this.form.pickup.pickup_close_time = {
            hours: minCloseDate.getHours(),
            minutes: minCloseDate.getMinutes(),
          };
        }
      }
    },
    calculateMinCloseTime(minOrderDate, startTime, minTime, minDiff) {
      const readyTime = this.form?.pickup?.pickup_ready_time;
      if (!readyTime) {
        return this.form.pickup.pickup_date === minOrderDate ? startTime : minTime;
      }

      const readyDate = new Date();
      readyDate.setHours(readyTime.hours);
      readyDate.setMinutes(readyTime.minutes);

      const minCloseDate = new Date(readyDate.getTime() + minDiff * 60000); // Dodaj minDiff w minutach

      return {
        hours: minCloseDate.getHours(),
        minutes: minCloseDate.getMinutes(),
      };
    },
    calculateMaxReadyTime(maxTime, minDiff) {
      const maxDate = new Date();
      maxDate.setHours(maxTime.hours);
      maxDate.setMinutes(maxTime.minutes);

      const adjustedDate = new Date(maxDate.getTime() - minDiff * 60000);

      return {
        hours: adjustedDate.getHours(),
        minutes: adjustedDate.getMinutes(),
      };
    },
  },
  getters: {
    packageCount() {
      return this.form.SearchParcel.length + 1;
    },
    allFieldsValidStatus(state) {
      let check = true;

      Object.keys(state.sectionsDone).forEach((section: any) => {
        if (state.sectionsDone[section].status !== 'done') {
          check = false;
        }
      })

      return check;
    }
  },
});

export default useOrderFormV2Store;