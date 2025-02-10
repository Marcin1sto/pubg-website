import {defineStore} from "pinia";

const menuItems = [
  {
    isDropdown: false,
    active: false,
    title: 'Nadaj paczkę',
    route: 'panel',
    icon: 'package',
  },
  {
    active: false,
    isDropdown: true,
    isOpened: false,
    title: 'Cenniki',
    icon: 'priceList',
    items: [
      {
        active: false,
        isForC2C: true,
        title: 'Przewoźnicy',
        route: 'panel-price-list-couriers',
      }
    ]
  },
  {
    active: false,
    isDropdown: true,
    isOpened: false,
    title: 'Zamówienia',
    icon: 'orderShoppingCart',
    items: [
      {
        active: false,
        isForC2C: true,
        title: 'Koszyk',
        route: 'panel-order-shopping-cart',
      },
      {
        active: false,
        isForC2C: true,
        title: 'Historia zamówień',
        route: 'panel-order',
      },
      {
        active: false,
        isForC2C: false,
        title: 'Import sprzedaży',
        route: 'panel-sales',
      },
      {
        active: false,
        isForC2C: true,
        title: 'Historia paczek',
        route: 'panel-order-package',
      },
      {
        active: false,
        isForC2C: true,
        title: 'Reklamacje',
        route: 'panel-order-complaints',
      },
    ]
  },
  {
    active: false,
    isDropdown: true,
    isOpened: false,
    title: 'Usprawnienia',
    icon: 'automation',
    items: [
      {
        active: false,
        isForC2C: true,
        title: 'Książka adresowa',
        route: 'panel-automations-address-book',
      },
      {
        active: false,
        isForC2C: true,
        title: 'Szablony paczek',
        route: 'panel-automations-package-templates',
      },
      {
        active: false,
        isForC2C: false,
        title: 'Integracje',
        route: 'panel-automations-plugins',
      },
    ]
  },
  {
    active: false,
    isDropdown: true,
    isOpened: false,
    title: 'Finanse',
    icon: 'finance',
    items: [
      {
        active: false,
        isForC2C: true,
        title: 'Płatności',
        route: 'panel-bank',
      },
      {
        active: false,
        isForC2C: true,
        title: 'Faktury',
        route: 'panel-invoices',
      },
      {
        active: false,
        isForC2C: true,
        title: 'Pobrania',
        route: 'panel-uptakes',
      },
      {
        active: false,
        isForC2C: true,
        title: 'Zwroty pobrań',
        route: 'panel-uptakes-refunds',
      }
    ]
  },
  {
    active: false,
    isDropdown: false,
    title: 'Kontakt',
    route: 'panel-contact',
    icon: 'envelope',
  },
];

const useLeftMenuStore = defineStore('leftMenu', {
  state: () => ({
    openedMenu: reactive(ref(true)),
    openedMobileMenu: reactive(ref(false)),
    menuItems: menuItems,
  }),
  actions: {
    toggleMenu() {
      this.openedMenu = !this.openedMenu;
    },
    clickOnAnotherRoute() {
      this.menuItems.forEach((item) => {
        if (item.isDropdown) {
          item.isOpened = false;
        }
      });
    },
    closeDropdowns() {
      this.menuItems.filter((item) => item.isDropdown).forEach((item) => {
        item.isOpened = false;
        item.active = false;
        item.items.forEach((subItem) => {
          subItem.active = false;
        });
      });
    },
    changeActiveSubItem(index, parentIndex, forceClose = false) {
      this.menuItems.forEach((item, i) => {
        item.active = false;

        if (item?.items) {
          item.items.forEach((subItem) => {
            subItem.active = false;
          });
        }
      });

      this.menuItems[parentIndex].items.forEach((item, i) => {
        item.active = false;

        if (i === index) {
          item.active = true;
          this.menuItems[parentIndex].active = true;
        }
      });

      if (forceClose) {
        this.openedMenu = false;
        this.openedMobileMenu = false;
      }
    },
    toggleDropdown(index) {
      this.menuItems.forEach((item, i) => {
        if (i === index) {
          if (this.openedMenu == false && item.isOpened) {
            this.openedMenu = true;
          } else {
            item.isOpened = !item.isOpened;
          }

          if (item.isOpened) {
            this.openedMenu = true;
          }

        } else {
          item.isOpened = false;
        }
      });
    },
    itemDropdownHasActive(index) {
      return this.menuItems[index].items.some((item) => {
        return item.active;
      });
    },
    findActiveMenu(routeToName = null) {
      let routeName = routeToName ?? useRoute().name;
      const regex = /___[a-z]{2}$/;
      routeName = routeName.replace(regex, '');

      this.menuItems.forEach((item, index) => {
        if (item.route === routeName && !item.isDropdown) {
          this.closeDropdowns();
        }

        item.items?.forEach((subItem, subIndex) => {
          if (subItem.route === routeName) {
            this.changeActiveSubItem(subIndex, index);

            item.isOpened = true;
          }
        });
      });
    }
  }
});

export default useLeftMenuStore;