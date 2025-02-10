import {useTableStore} from "~/stores/useTableStore";

const {getApiRoute, formatApiGetRoute} = useApiRoutes();
import {defineStore} from "pinia";

const useNotificationsStore = defineStore('notifications', {
  state: () => ({
    notifications: [],
    notificationsTableItems: [],
    notificationsCount: 0,
    singleNotification: {},
  }),
  actions: {
    async getNotifications() {
      const {data, pending, error}: any = await useTheFetch(formatApiGetRoute('notifications.index', {}), {
        method: 'GET',
      });

      if (data.value.success) {
        this.notifications = data.value.data.notifications;
      }

      this.formatForTable();
    },
    async getNotificationsCount() {
      const {data, pending, error}: any = await useTheFetch(formatApiGetRoute('notifications.count', {}), {
        method: 'GET',
      });

      if (data.value.success) {
        this.notificationsCount = data.value.data.unread_count;
      }
    },
    async getNotificationView(id: string) {
      let route = formatApiGetRoute('notifications.show', {});
      route = route.replace(':id', id.toString());
      const {data, pending, error}: any = await useTheFetch(route, {
        method: 'GET',
      });

      if (data.value.success) {
        this.singleNotification = data.value.data.Notification;
      }
    },
    async formatForTable() {
      const { actionsTypes, bodyTypes } = useTableStore();

      this.notificationsTableItems = this.notifications.map((notification: any) => {
        notification = notification.Notification;

        return {
          id: notification.id,
          is_read: { type: bodyTypes.TEXT, content: notification.is_read },
          title: { type: bodyTypes.TEXT, content: notification.title },
          publication_date	: { type: bodyTypes.TEXT, content: notification.publication_date },
          actions: { type: bodyTypes.ACTIONS, content: [
              { type: actionsTypes.LINK, link: 'panel-user-notifications-id', content: 'Czytaj więcej...', id: notification.id  },
            ]
          },

        }
      });
    }
  }
})

export default useNotificationsStore