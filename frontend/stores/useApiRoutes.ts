const useApiRoutes = () => {
    const apiRoutes = {
        automations: {
            packageTemplate: {
                index: '/api/packageTemplates',
                selectOptions: '/api/packageTemplates/list',
                view: '/api/packageTemplates/view/:id',
                create: '/api/packageTemplates/create',
                update: '/api/packageTemplates/edit',
                delete: '/api/packageTemplates/edit',
            }
        },
        auth: {
            login: '/api/auth/login',
            getProfile: '/api/user/profile',
            register: '/api/auth/register',
            logout: '/api/auth/logout',
            rememberPassword: '/api/auth/user/remind/password',
            checkLogin: '/api/check_login',
            sendNewPassword: '/api/auth/user/reset/password',
        },
        banners: '/api/banners',
        user: {
            profile: '/api/user/profile',
            update: '/api/user/update',
            updateSemiUser: '/api/semi_user/update',
            getProfileSemiUser: '/api/semi_user/get_profile',
            delete: '/api/user/delete',
            uploadImage: '/api/user/upload-image',
            balance: '/api/user/balance',
            sendSmsApi: '/api/auth/sms/verification',
            saveApiKey: '/api/user/saveApiKey',
            gus: '/api/gus',
            gusUpdate: '/api/gus-update-profile',
            paymentOptions: '/api/get/payment-options',
            offer: '/api/individual-offers/send',
            resetUserPassword: '/api/user/password',
        },
        cartOrder: {
            index: '/api/cart_order',
            view: '/api/cart_order/:id',
            paymentTypes: '/api/static/cart_order/payment',
            report: '/api/cart_order/print/report/xlsx',
            waybills: 'api/downloadWaybillsMerged',
            printList: 'api/print/cart_order',
        },
        order: {
            index: '/api/order',
            view: '/api/order/:id',
            cancel: '/api/cancel/order/:id',
            staticCouriers: '/api/static/order/courier',
        },
        sales: {
            index: '/api/sales',
            view: '/api/sales/:id',
        },
        allegro: {
            view: '/api/allegro/profile',
            login: '/api/allegro/oauthUrl',
            unlink: '/api/allegro/unlink',
            getToken: '/api/allegro/receiveToken/:code',
        },
        ebay: {
            view: '/api/ebay/profile',
            login: '/api/ebay/oauthUrl',
            unlink: '/api/ebay/unlink',
            getToken: '/api/ebay/receiveToken/:code',
        },
        idosell: {
            view: '/api/idosell/profile',
            unlink: '/api/idosell/unlink',
            save: '/api/idosell/saveKey',
        },
        orderForm: {
            getValuation: '/api/brokers/get/valuation',
            getSortables: '/api/search/sortables',
            createOrderV2: '/api/createOrderV2.json',
            multiOrders: '/api/createMultiOrders',
            getPickupDateOptions: '/api/get/pickup-date-options',
        },
        complaints: {
            index: '/api/complaint',
            types: '/api/static/complaint/type',
            statuses: '/api/static/complaint/status',
            create: '/api/complaint/create',
        },
        brokers: {
          quickSearch: '/api/courier/brokers/search',
        },
        bank: {
            index: '/api/bank',
            recharge: '/api/bank_recharge',
            rechargeInfo: '/api/bank_recharge/return',
        },
        notifications: {
            index: '/api/notifications',
            count: '/api/notifications/count',
            show: '/api/notifications/view/:id',
        },
        articles: {
            index: '/api/articles',
            show: '/api/articles/view/:id',
            categories: '/api/static/articles/category'
        },
        news: {
            index: '/api/news',
            show: '/api/news/view/:id',
        },
        invoice: {
            index: '/api/invoice',
            view: '/api/invoice/:unique_id',
            types: '/api/static/invoice/type'
        },
        uptake: {
            index: '/api/uptakes',
            statuses: '/api/static/uptakes/status',
            download: '/api/uptakes/download',
        },
        uptakeRefund: {
            index: '/api/refund',
            download: '/api/uptakes/download',
        },
        countries: '/api/get/countries-options',
        contact: {
            send: '/api/contact/send',
            staticTypes: '/api/static/contact/type',
        },
        addressBooks: {
            index: '/api/contacts',
            view: '/api/contacts/view/:id',
            delete: '/api/contacts/delete/:id',
            update: '/api/contacts/edit',
            staticTypes: '/api/static/contacts/type',
            create: '/api/contacts/create',
            import: '/api/contacts/import'
        },
        preOrder: {
            index: '/api/preOrder',
            create: '/api/preOrder/add',
            delete: '/api/preOrder/delete/:id',
            update: '/api/preOrder/edit',
            getSession: '/api/session/getSession',
        }
    }

    const getApiRoute = (route: string) => {
        const keys = route.split('.');
        let result = apiRoutes;

        for (let key of keys) {
            if (result[key] !== undefined) {
                result = result[key];
            } else {
                console.error(`Ścieżka '${route}' jest niepoprawna lub nie jest zdefiniowana.`);
            }
        }

        return result;
    }

    /**
     * Formatuje ścieżkę API dla metody GET z parametrami
     * @param route
     * @param params
     */
    const formatApiGetRoute = (route: string, params: object) => {
        const routeName= getApiRoute(route);

        if (Object.keys(params).length === 0) {
            return routeName;
        }

        let formattedRoute = routeName + '?';
        for (let key in params) {
            if (params[key] !== null && params[key] !== undefined && params[key] !== '') {
                formattedRoute += `${key}=${params[key]}&`;
            }
        }

        return formattedRoute.slice(0, -1);
    }

    return {
        apiRoutes,
        getApiRoute,
        formatApiGetRoute
    };
}

export default useApiRoutes;