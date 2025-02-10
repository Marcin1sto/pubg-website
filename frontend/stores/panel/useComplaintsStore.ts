import {useTableStore} from "~/stores/useTableStore";

const {getApiRoute, formatApiGetRoute} = useApiRoutes();
import {defineStore} from "pinia";

const useComplaintsStore = defineStore('complaints', {
  state: () => ({
    items: [],
    tableItems: [],
    complaintTypes: [],
    complaintStatuses: [],
    searchParams: {}
  }),
  actions: {
    async getComplaints() {
      const { stopLoadingAsyncData, setCountPages } = useTableStore();
      const { limit } = storeToRefs(useTableStore());
      this.searchParams.limit = limit;

      const {data, pending, error}: any = await useTheFetch(formatApiGetRoute('complaints.index', this.searchParams), {
        method: 'GET',
      });

      if (error?.value) {
        data.value = JSON.parse(error.value.data)
      } else {
        if (typeof data.value === 'string') {
          data.value = JSON.parse(data.value)
        }
      }

      if (data.value.success) {
        setCountPages(data.value.data.countPages);
        this.items = data.value.data.complaints;
      }

      await this.formatForTable();
      stopLoadingAsyncData();
    },
    async fetchComplaintTypes() {
      const {data, pending, error}: any = await useTheFetch(formatApiGetRoute('complaints.types', this.searchParams), {
        method: 'GET',
      });

      if (error?.value) {
        data.value = JSON.parse(error.value.data)
      } else {
        if (typeof data.value === 'string') {
          data.value = JSON.parse(data.value)
        }
      }

      if (data.value.success) {
        this.complaintTypes = data.value.data;
      }
    },
    async fetchComplaintStatuses() {
      const {data, pending, error}: any = await useTheFetch(formatApiGetRoute('complaints.statuses', this.searchParams), {
        method: 'GET',
      });

      if (error?.value) {
        data.value = JSON.parse(error.value.data)
      } else {
        if (typeof data.value === 'string') {
          data.value = JSON.parse(data.value)
        }
      }

      if (data.value.success) {
        this.complaintStatuses = data.value.data;
      }
    },
    async formatForTable() {
      const { setItems, bodyTypes } = useTableStore();

      if (this.items.length === 0) {
        return;
      }

      this.tableItems = this.items.map((item: any) => {
        return {
          waybill_no: { type: bodyTypes.TEXT, content: item.Complaints.waybill_no},
          reason: { type: bodyTypes.TEXT, content: this.getComplaintType(item.Complaints.complaint_type) },
          status: { type: bodyTypes.TEXT, content: item.Complaints.complaint_status},
          created_at: { type: bodyTypes.DATE, content: item.Complaints.order_date },
        }
      });
    },
    async createComplaint(request: any) {
      const { data, pending, error }: any = await useTheFetch(formatApiGetRoute('complaints.create', {}), {
        method: 'POST',
        body: request,
      });

      if (error?.value) {
        data.value = error.value.data;
      }

      return data.value
    },
    getComplaintType(type) {
      const types = {
        irregularService: 'Nieregularne świadczenie usługi',
        lostOrder: 'Zagubiona przesyłka',
        damagedOrder: 'Uszkodzona przesyłka',
        lostInOrder: 'Ubytek zawartości paczki',
        surchargeComplaint: 'Reklamacja dopłaty',
      }

      if (types[type] !== undefined) {
        return types[type];
      }
    }
  },
});

export default useComplaintsStore;