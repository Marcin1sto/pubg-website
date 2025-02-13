import {defineStore} from 'pinia';

const usePagesStore = defineStore('pages', {
  state: () => ({
    joinDiscordUrl: 'https://discord.gg/8hZAt7DXdA',
    selectedGame: '',
    menuItems: [
      {
        isDropdown: false,
        route: '/',
        title: 'Strona Główna'
      },
      {
        isDropdown: true,
        route: null,
        title: 'Gry',
        items: [
          {
            title: 'PUBG Battlegrounds',
            route: 'games-pubg'
          },
          {
            title: 'Fortnite',
            route: 'games-fortnite'
          },
        ]
      },
      {
        isDropdown: false,
        route: 'players',
        title: 'Gracze',
      },
      {
        isDropdown: false,
        route: 'aboutUs',
        title: 'O nas',
        subTitle: 'Informacje'
      },
    ]
  }),
  actions: {
    // TODO: Enum
    setSelectedGame(game: string)  {
      this.selectedGame = game;
    },
    getPageSubTitle() {
      const router = useRouter();
      let clearRouteName = String(router.currentRoute.value.name).split('_')[0]

      let itemMenu = this.menuItems.find((item) => item.route == clearRouteName)

      if (itemMenu) {
        return itemMenu?.subTitle;
      }

    },
    getSelectedGame(currentRoute) {
      const splitPath = currentRoute.split('/');

      if (splitPath[1] == 'games') {
        this.selectedGame = splitPath[2];
      } else {
        this.selectedGame = ''
      }
    }
  },
  getters: {
  }
});

export default usePagesStore;