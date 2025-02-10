import {defineStore} from "pinia";

export const useTableStore = defineStore('table', {
  state: () => ({
    useCheckbox: toRef(false),
    selectAll: toRef(false),
    countItems: toRef(0),
    tableIsLoading: toRef(false),
    limit: toRef(10), // perPage
    page: toRef(1), // for Api filtration
    countPages: toRef(0),
    showDeleteModal: toRef(false),
    items: [],
    headers: [],
    childHeaders: {},
    bodyTypes: {
      HTML: 'html',
      LINK: 'link',
      TEXT: 'text',
      ACTIONS: 'actions',
      IMG: 'img',
      DATE: 'date',
      ERRORS_MODAL: 'errorsModal',
    },
    actionsTypes: {
      LINK: 'link',
      CUSTOM_LINK: 'customLink',
      DELETE: 'delete',
      DROPDOWN: 'dropdown',
      DOWNLOAD: 'download',
      FUNCTION: 'function',
      SHOW_MORE: 'showMore',
    }
  }),
  actions: {
    previousPage() {
      if (this.page === 1) {
        return;
      }

      this.startLoadingAsyncData()
      this.page--
    },
    firstPage() {
      this.page = 1
    },
    nextPage() {
      if (this.page === this.countPages) {
        return;
      }

      this.startLoadingAsyncData()
      this.page++
    },
    lastPage() {
      this.page = this.countPages
    },
    setCountPages(countPages: number) {
      this.countPages = countPages
    },
    setCurrentPage(page: number) {
      this.page = page
    },
    setHeaders(headers: []) {
      this.headers = headers
    },
    async setItems(items: []) {
      this.selectAll = false;
      if (items.length === 0) {
        this.items = []
        return;
      }

      this.items = items.map((item: any) => {
        item.selected = false
        item.hovered = false
        return item
      });
    },
    setUseCheckbox(value: boolean) {
      this.useCheckbox = value
    },
    toggleAll() {
      this.selectAll = !this.selectAll
      this.items.map((item: any) => {
        if (item.canSelect) {
          item.selected = this.selectAll
        }
      });
    },
    getSelectedItems() {
      this.items.filter((item: any) => item.selected)
    },
    updateCountItems() {
      this.countItems = this.items.length
    },
    startLoadingAsyncData() {
      this.tableIsLoading = true
    },
    stopLoadingAsyncData() {
      this.tableIsLoading = false
    }
  },
  getters: {
    selectedItems() {
      return this.items.filter((item: any) => item.selected)
    },
    countSelectedItems() {
      return this.items.filter((item: any) => item.selected).length
    },
  }
})
